<?php
class ContactHistoryModel {

	public function getContactHistory($phoneNum, $returnTag, $connect){
	
		$db = new db_config();
		$data = '';
		
		$sql = $db->mquery("EXEC dbo.show_ContactName @phone_number = '" . $phoneNum . "'", $connect);
		$num = $db->numrows($sql);
		
		while($row = $db->fetchobject($sql)){
			
			$name = $db->strip($row->Name);
			$caller_tag = $db->strip($row->Caller_Tag);
			
			if ($caller_tag == 'P') {
				$caller_tag_image = 'images/image-personal-tag-hp.png';
			} else if ($caller_tag == 'W') {
				$caller_tag_image = 'images/image-work-tag-hp.png';
			} else {
				$caller_tag_image = 'images/image-untagged-tag-hp.png';
			}
			
			$data = $name;
			$data_tag = $caller_tag_image;
			
		}
		
		if ($returnTag == 'y') {
			return $data_tag;
			
		} else {
			return $data;
		}
		
		
	}

}
?>