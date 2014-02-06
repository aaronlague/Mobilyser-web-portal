<?php
class ReportsModel {
	public function getReports($accountNum, $connect){
	
		$db = new db_config();

		$data = '';	

		$sql = $db->mquery("EXEC callchart @acct_no = '" . $accountNum . "'" , $connect);
		$num = $db->numrows($sql);
		$callers = array();
		while($row = $db->fetcharray($sql)){
			$fields[0] = $row[caller_tag];
			$fields[1] = $row[No_of_Calls];
			
			array_push($callers, $fields);

		}
		print json_encode($callers, JSON_NUMERIC_CHECK);
		//return $data;
	}
}
?>