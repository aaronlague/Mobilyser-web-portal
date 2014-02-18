<?php
class CallsModel {

	public function getCalls($accountNum, $filterFields, $isNumRows, $connect){
    	
    	$db = new db_config();

		$data = '';	

		$sql = $db->mquery("EXEC dbo.getCalls  
				".$filterFields."
				@account_number = '" . $accountNum . "'" ,
     			$connect);
		$num = $db->numrows($sql);
		
		$counter = 1;
		while($row = $db->fetchobject($sql)){

			$caller_tag = $db->strip($row->caller_tag);
			
				if ($caller_tag == 'P') {
					$caller_tag_image = 'images/personal.png';
				} elseif ($caller_tag == 'W') {
					$caller_tag_image = 'images/work.png';
				} else {
					$caller_tag_image = 'images/untagged.png';
				}
			
			$call_date = $db->strip($row->call_date);
			$time = $db->strip($row->time);
			$contact_name = $db->strip($row->contact_name);
			$phone_number = $db->strip($row->phone_number);
			$date = new DateTime('2000-01-01');
			$date->add(new DateInterval('P0Y0M0DT0H0M'.$row->duration.'S'));
			$duration = $date->format('H:i:s');	
			$estimated_cost = $db->strip($row->estimated_cost);
			$actual_cost = $db->strip($row->actual_cost);
			$bill_issued = $db->strip($row->bill_issued);
			
			if ($contact_name == " "){
				$procContactName = '<input type=hidden id="valueContainer" value="'.$phone_number.'">' .$phone_number;
			} else {
				$procContactName = '<input type=hidden id="valueContainer" value="'.$phone_number.'">' .$contact_name ;
			}

	        $data .= "<tr>";
			$data .= '<td class="callTag"><img src="' . $caller_tag_image . '">' .$caller_tag_text. '</td>';
			$data .= "<td class='callDate'>" . $call_date . "</td>";
			$data .= "<td>" . $time . "</td>";
			$data .= "<td class='phoneNo'><a href='#'>" . $procContactName . "</a></td>";
			$data .= "<td>" . $duration . "</td>";
			$data .= "<td>" . "$" . number_format($estimated_cost, 2) . "</td>";
			$data .= "<td>". "$" .  number_format($actual_cost, 2) . "</td>";
			$data .= "<td>" . $bill_issued ."</td>";
			$data .= "</tr>";
			
			$totalCount = $counter++;
			
		}
		if($isNumRows == 'y'){
			return $totalCount;
		}else{
			return $data;
		}

    }
	
	public function generateCSVData($accountNum, $connect)
    {
    	
    	$db = new db_config();
		$data = '';	
    	
    	$sql = $db->mquery("EXEC dbo.getCalls @caller_tag = 'A', @account_number = '". $accountNum ."'" ,$connect);
		$num = $db->numrows($sql);
		
		$HeadingsArray = array('id', 'Date', 'Time', 'Phone number', 'Duration', 'Estimated cost', 'Actual cost', 'Caller tag', 'Bill issued', 'Contact name');
		$csvContent	   = implode(",",$HeadingsArray)."\n";
				
		while($row = $db->fetchobject($sql))
		{
			
			foreach($row as $name => $value){
				$valuesArray[]=$value;
			}
			
			$csvContent .= implode(",", $valuesArray) ."\r\n";
			unset($valuesArray);
						
		}
		
		$fileName = date("Y-m-d") ."_export.csv";
		
		header('Content-Type: text/csv');
		header("Content-length: " . filesize($fileName));
		header('Content-Disposition: inline; filename="' . $fileName . '"');
		
		echo $csvContent;
		
    }
 
}