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
					$caller_tag_image = "images/personal.png";
				} elseif ($caller_tag == 'W') {
					$caller_tag_image = "images/work.png";
				} else {
					$caller_tag_image = "images/untagged.png";
				}
			
			$call_date = $db->strip($row->call_date);
			$time = $db->strip($row->time);
			$phone_number = $db->strip($row->phone_number);
			$duration = $db->strip($row->duration);
			$estimated_cost = $db->strip($row->estimated_cost);
			$actual_cost = $db->strip($row->actual_cost);
			$bill_issued = $db->strip($row->bill_issued);

	        $data .= "<tr>";
			//$data .= "<td class='callTag'>" . $caller_tag . "</td>";
			$data .= '<td class="callTag"><img src="' . $caller_tag_image . '"></td>';
			$data .= "<td class='callDate'>" . $call_date . "</td>";
			$data .= "<td>" . $time . "</td>";
			$data .= "<td class='phoneNo'><a href='#'>" . $phone_number . "</a></td>";
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
 
}
?>