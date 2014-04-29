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
				$caller_tag_image = '<span><img class="workLabel" src="images/work-grayscale.png" width="33"></span><input type=hidden id="tagContainer" value="'.$caller_tag.'"><input type="checkbox" name="callerToggle" data-toggle="switch" checked/><span><img class="personalLabel" src="images/personal.png" width="33"></span>';
			} else if ($caller_tag == 'W') {
				$caller_tag_image = '<span><img class="workLabel" src="images/work.png" width="33"><span><input type=hidden id="tagContainer" value="'.$caller_tag.'"><input type="checkbox" name="callerToggle" data-toggle="switch"/><span><img class="personalLabel" src="images/personal-grayscale.png" width="33"></span>';
			} else {
				$caller_tag_image = '<span><img class="workLabel" src="images/work.png" width="33"><span><input type=hidden id="tagContainer" value="'.$caller_tag.'"><input type="checkbox" name="callerToggle" data-toggle="switch"/><span><img class="personalLabel" src="images/personal-grayscale.png" width="33"></span>';
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