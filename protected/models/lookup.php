<?php
class LookupModel {

    public function getCountry($connect){
    	
    	$db = new db_config();

		$data = '';

		$sql = $db->mquery("SELECT * FROM  countries", $connect);
		$num = $db->numhasrows($sql);
		while($row = $db->fetchobject($sql)){
			$country_id = $db->strip($row->Country_ID);
			$name = $db->strip($row->Name);

			$data[] .= $name;

		}
		return $data;

    }
	
	//public function getTelecoms($type, $connect){
	public function getTelecoms($connect){
    	
    	$db = new db_config();

		$data = '';

		$sql = $db->mquery("SELECT * FROM  telecoms", $connect);
		$num = $db->numhasrows($sql);
		//$telecoms = array();
		while($row = $db->fetchobject($sql)){
			$telecom_id = $db->strip($row->telecom_id);
			$data[] .= $db->strip($row->name);
			//$name = $db->strip($row->name);
			//$option = array("id" => $telecom_id, "value" => "".$name."");
			//$telecoms[] = $option;

		}
		//$data = json_encode($telecoms);
		//$response = isset($_GET['callback'])?$_GET['callback']."(".$data.")":$data;
		return $data;

    }

	public function getPlanName($telecomId, $type, $connect){
    	
    	$db = new db_config();

		$data = '';

		$sql = $db->mquery("SELECT * FROM  telecom_plan WHERE telecom_id = '".$telecomId."'", $connect);
		$num = $db->numhasrows($sql);
		$planname = array();
		while($row = $db->fetchobject($sql)){
			$plan_id = $db->strip($row->plan_id);
			$telecom_id = $db->strip($row->telecom_id);
			$name = $db->strip($row->name);
			$option = array("id" => $plan_id, "value" => "".$name."");
			$planname[] = $option;

		}
		$data = json_encode($planname);
		$response = isset($_GET['callback'])?$_GET['callback']."(".$data.")":$data;
		return $response; 

    }

	public function getPlanType($planId, $type, $connect){
    	
    	$db = new db_config();

		$data = '';

		$sql = $db->mquery("SELECT * FROM  plan_type WHERE plan_id = '".$planId."'", $connect);
		$num = $db->numhasrows($sql);
		$plantype = array();
		while($row = $db->fetchobject($sql)){
			$plan_id = $db->strip($row->plan_id);
			$type_name = $db->strip($row->type_name);
			$option = array("id" => $plan_id, "value" => "".$type_name."");
			$plantype[] = $option;

		}
		$data = json_encode($plantype);
		$response = isset($_GET['callback'])?$_GET['callback']."(".$data.")":$data;
		return $response; 

    }

	public function getUsers($connect){
    	
    	$db = new db_config();

		$data = '';

		$sql = $db->mquery("SELECT * FROM  users", $connect);
		$num = $db->numhasrows($sql);

		while($row = $db->fetchobject($sql)){
			$email = $db->strip($row->email);
			$pass = $db->strip($row->password);
			$data[] .= $email;

		}
		return $data;

    }
	
	public function getBills($accountNum, $connect){
		
    	
    	$db = new db_config();

		$data = '';

		$sql = $db->mquery("EXEC dbo.getbill_upload @account_number = '" . $accountNum . "'", $connect);
		$num = $db->numhasrows($sql);
		$uploadedbills = array();
		$i = 0;
		while($row = $db->fetchobject($sql)){
			
			$ctr = $i++;

			$bill_id = $db->strip($row->id);
			$bill_date = $db->strip($row->bill_date);
			
			$data .= '<li id="btype_'.$ctr.'" onclick="btype_data(\''.$ctr.'\', \''.$bill_date.'\');" rel="'.$ctr.'" class="btype">';
			$data .= '<a tabindex="-1" href="#" class="opt"><span class="pull-left">'.$bill_date.'</span></a>';
			$data .= '</li>';

		}
		return $data; 

    }
	
}
?>