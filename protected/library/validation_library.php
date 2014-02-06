<?php
class validationLibrary {

	# if empty
	public function isEmpty($string, $message, $numlength){
		if ($string == NULL){
			$flag['message'] = '<br /><span class="error">'.$message.' * required.</span>';
			$flag['class'] = 'error';
		} else {
			$isResult = $this->isLength($string, $message, $numlength);
			$flag['message'] = $isResult['message'];
			$flag['class'] = '';
		}	
		return $flag;
	}
	
	# check string lenght
	public function isLength($string, $message, $numlength){
		if (strlen($string) < $numlength){
			$flag['message'] = '<br /><span class="error">Must have '.$numlength.' character.</span>';
			$flag['class'] = 'error';
		} else {
			$flag['message'] = '';
			$flag['class'] = '';
		}	
		return $flag;
	}

	# check email
	public function isEmail($string, $message, $numlength, $isdatabase){

		// check if the email is Empty.
		$isResult = $this->isEmpty($string, $message, $numlength);
		$flag['message'] = $isResult['message'];
		$flag['class'] = $isResult['class'];
		// everything pass in the Empty and Lenght validation
		if($isResult['message'] == ""){
			// start the validation for email validity.
			if(!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/', $string)){
				$flag['message'] = '<br /><span class="error">'.$message.' * invalid.</span>';
				$flag['class'] = 'error';
			}else{
				if($isdatabase == 'y'){
					 //check the email if already register
					//$sql = $db->mquery("SELECT * FROM dbo.createAccount WHERE email LIKE '".$string."%'", $connect);
//					$num = $db->numrows($sql);
//					if($num >= 1){
//						$flag['message'] = '<br /><span class="error">'.$message.' * already register.</span>';
//						$flag['class'] = 'error';
//					}else{
//						$flag['message'] = '';
//						$flag['class'] = '';
//					}				
				}else{
					// if you don't need to check it to the database.
					$flag['message'] = '';
					$flag['class'] = '';
				}
			}		
		}
		
		return $flag;
	}

	# compare password
	public function isCompare($password, $cpassword, $message, $numlength) {

		$trimPassword = trim($password);
		$trimCPassword = trim($cpassword);

		// check if the email is Empty.
		$isCheck = $this->isEmpty($trimPassword, $message, $numlength);
		// everything pass in the Empty and Lenght validation
		if($isCheck['message'] == NULL){
			// start to compare password
			if($trimPassword == $trimCPassword){
				$flag['message'] = '';
				$flag['class'] = '';
			}else{
				$flag['message'] = '<span class="error">'.$message.' not match.</span>';
				$flag['class'] = 'error';
			}
		}
		
		return $flag;
	
	}
}
?>