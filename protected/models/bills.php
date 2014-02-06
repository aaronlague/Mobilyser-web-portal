<?php
class BillsModel {

	public function getBills($accountNum, $isNumRows, $connect){
    	
    	$dbCon = new db_config();

		$data = '';	

		$sqlQ = $dbCon->mquery("EXEC dbo.getbill_upload @account_number = '" . $accountNum . "'",
     			$connect);
		$num = $dbCon->numrows($sqlQ); 
		$counter = 1;
		while($row = $dbCon->fetcharray($sqlQ, SQLSRV_FETCH_ASSOC)){ //use fetcharray function here not object
		
			$upload_date = date_format($row['upload_date'], 'd M Y');
			$bill_name = $dbCon->strip($row['bill_name']);
			$bill_date = $dbCon->strip($row['bill_date']);
			
			$data .= "<tr>";
			$data .= "<td>" . $upload_date . "</td>";
			$data .= "<td>" . $bill_name . "</td>";
			$data .= "<td>" . $bill_date . "</td>";
			$data .= "</tr>";
			
			//$totalContacts = $counter++;
		}
		
		if($isNumRows == 'y'){
			//return $totalContacts;
		}else{
			return $data;
		}

    }
 
}
?>
