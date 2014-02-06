<?php
class ContactsModel {

	public function getContacts($accountNum, $isNumRows, $connect){
    	
    	$db = new db_config();

		$data = '';	

		$sql = $db->mquery("EXEC dbo.getContacts @account_number = '" . $accountNum . "'",
     			$connect);
		$num = $db->numrows($sql); 
		$counter = 1;
		while($row = $db->fetchobject($sql)){
		
			$phone_number = $db->strip($row->Phonenumber);
			$name = $db->strip($row->Name);
			$caller_tag = $db->strip($row->Caller_tag);
			
			$data .= "<tr>";
			$data .= "<td>" . $phone_number . "</td>";
			$data .= "<td>" . $name . "</td>";
			$data .= "<td>" . $caller_tag . "</td>";
			$data .= "</tr>";
			
			$totalContacts = $counter++;
		}
		
		if($isNumRows == 'y'){
			return $totalContacts;
		}else{
			return $data;
		}

    }
 
}
?>
