<?php
class HistoryModel {

	public function getHistory($phoneNum, $accountNum, $connect){
	
		$db = new db_config();
		$data = '';
		
		$sql = $db->mquery("EXEC dbo.getcallhistory @phone_number = '" . $phoneNum . "', @account_number = '" . $accountNum . "'", $connect);
		$num = $db->numrows($sql);
		
		while($row = $db->fetchobject($sql)){
			
			$call_date = $db->strip($row->call_date);
			$time = $db->strip($row->time);
			$call_id = $db->strip($row->call_id);
			$contact_name = $db->strip($row->contact_name);
			$phone_number = $db->strip($row->phone_number);
			$duration = $db->strip($row->duration);
			$estimated_cost = $db->strip($row->estimated_cost);
			$actual_cost = $db->strip($row->actual_cost);
			$caller_tag = $db->strip($row->caller_tag);
			$bill_issued = $db->strip($row->bill_issued);
			
			if ($contact_name == '') {
				$_SESSION['storedata'] = $phone_number;
			} else {
				$_SESSION['storedata'] = $contact_name;
			}
			
			$data .= "<tr>";
			//$data .= "<td>" . $call_id . "</td>";
			//$data .= "<td>" . $contact_name . "</td>";
			$data .= "<td>" . $call_date . "</td>";
			$data .= "<td>" . $time . "</td>";
			$data .= "<td>" . $duration . "</td>";
			$data .= "<td>" . "$" .  number_format($estimated_cost, 2) . "</td>";
			$data .= "<td>" . "$" .  number_format($actual_cost, 2) . "</td>";
			$data .= "<td>" . $bill_issued . "</td>";
			$data .= "</tr>";
		}
		
		return $data;
	}

}
?>