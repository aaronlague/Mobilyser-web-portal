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
			
			if ($caller_tag == 'P') {
			
				$caller_tag_image = '<span><img class="workLabel" src="images/work-grayscale.png" width="33"></span><input type="checkbox" name="callerToggle" data-toggle="switch" checked/><span><img class="personalLabel" src="images/personal.png" width="33"></span>';
			
			} else if ($caller_tag == 'W') {
			
				$caller_tag_image = '<span><img class="workLabel" src="images/work.png" width="33"></span><input type="checkbox" name="callerToggle" data-toggle="switch"/><span><img class="personalLabel" src="images/personal-grayscale.png" width="33"></span>';
			
			} else {
			
				$caller_tag_image = '<span><img class="workLabel" src="images/work.png" width="33"></span><input type="checkbox" name="callerToggle" data-toggle="switch"/><span><img class="personalLabel" src="images/personal-grayscale.png" width="33"></span>';
			
			}
			
			$data .= "<tr>";
			$data .= "<td class='contactTag'>" . $caller_tag_image . "</td>";
			//$data .= "<td>" . $caller_tag . "</td>";
			$data .= "<td>" . $name . "</td>";
			$data .= "<td class='phoneNumber'>" . $phone_number . "</td>";
			$data .= "<td class='contactOrigin'>" .''. "</td>";
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
