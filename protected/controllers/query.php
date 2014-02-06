<?php
class queryController {
	public function queryCheck($email, $activationcode, $connect) {
		$db = new db_config();
		
		if($activationcode == 0){
		
			$sql = $db->mquery("SELECT * FROM users", $connect);
			$row = $db->fetchobject($sql);
			
			print_r ($row);
		
		} else {
		
		}
		
		
	}
}
?>