<?php
class HistoryModel {

	public function getHistory($phoneNum, $accountNum, $connect){
	
		$db = new db_config();
		$data = '';
		
		$sql = $db->mquery("EXEC dbo.getcallhistory @phone_number = '" . $phoneNum . "', @account_number = '" . $accountNum . "'", $connect);
		$num = $db->numrows($sql);
		
		while($row = $db->fetchobject($sql)){
			
			$call_date = $db->strip($row->call_date);
			$call_date_format = date('d M', strtotime($call_date));
			$time = $db->strip($row->time);
			$call_id = $db->strip($row->call_id);
			$contact_name = $db->strip($row->contact_name);
			$phone_number = $db->strip($row->phone_number);
			$date = new DateTime('2000-01-01');
			$date->add(new DateInterval('P0Y0M0DT0H0M'.$row->duration.'S'));
			//$duration = $date->format('H:i:s');
			$duration = $date->format('i\m s\s');
			$estimated_cost = $db->strip($row->estimated_cost);
			$actual_cost = $db->strip($row->actual_cost);
			$caller_tag = $db->strip($row->caller_tag);
			$bill_issued = $db->strip($row->bill_issued);
			
			
			$data .= "<tr>";			
			$data .= "<td>" . $call_date_format . "</td>";
			$data .= "<td>" . $time . "</td>";
			$data .= "<td>" . $duration . "</td>";
			$data .= "<td>" . "$" .  number_format($estimated_cost, 2) . "</td>";
			$data .= "<td>" . "$" .  number_format($actual_cost, 2) . "</td>";
			$data .= "<td>" . $bill_issued . "</td>";
			$data .= "</tr>";
		}
		
		return $data;
	}
	
	public function getHistoryTotals ($phoneNum, $connect) {
		
		$db = new db_config();
		$data = '';
		
		$sql = $db->mquery("SELECT COUNT (*) AS 'total_calls' FROM call WHERE REPLACE(REPLACE(phone_number, ' ', ''),'+','') = '" . $phoneNum . "'", $connect);
		$num = $db->numrows($sql);
		$row = $db->fetchobject($sql);
		
		$totalCalls = $db->strip($row->total_calls);
		
		$data = $totalCalls;
		
		return $data;
		
	
	}
	
	public function getDurationTotals ($phoneNum, $connect) {
		
		$db = new db_config();
		$data = '';
		
		$sql = $db->mquery("SELECT SUM (CAST (duration AS int)) AS 'total_call_duration' FROM Call WHERE REPLACE(REPLACE(phone_number, ' ', ''),'+','') = '" . $phoneNum . "'", $connect);
		$num = $db->numrows($sql);
		
		while($row = $db->fetchobject($sql)) {
		
		$date = new DateTime('2000-01-01');
		$date->add(new DateInterval('P0Y0M0DT0H0M'.$row->total_call_duration.'S'));
		$totalCallDuration = $date->format('H\h' . ' | ' . 'i\m' . ' | ' . 's\s');
		$data = $totalCallDuration;
		
		}
		
		return $data;
		
	
	}
	
	public function getTotalCost ($phoneNum, $connect) {
	
		$db = new db_config();
		$data = '';
		
		$sql = $db->mquery("SELECT SUM (actual_cost) AS 'total_actual' FROM Call WHERE REPLACE(REPLACE(phone_number, ' ', ''),'+','') = '" . $phoneNum . "'", $connect);
		$num = $db->numrows($sql);
		
		while($row = $db->fetchobject($sql)) {
		
		$totalActualCost = $db->strip($row->total_actual);
		
		
		$data = "$" .  number_format($totalActualCost, 2);
		
		}
		
		return $data;

	
	}

}
?>