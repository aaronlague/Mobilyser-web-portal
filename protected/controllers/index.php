<?php
class IndexController {

    public function indexPage($email, $password, $activationcode, $connect) {

        $db = new db_config();
        
        if(strlen($activationcode) == 0){

            $sql = $db->mquery("EXEC dbo.login
                    @email = '".$email."',
                    @Password = '".$password."'",$connect);
 		}else{

            // with activation 
			$sql = $db->mquery("EXEC dbo.codeUpdate 
					@userid = '".$email."', 
					@code = '".$activationcode."', 
					@newpwd = '".$password."'",$connect);			
        }
		
		    $num = $db->numhasrows($sql);
            $row = $db->fetchobject($sql);

            if($num == 0){
                $data = '<span class="error">Incorrect username or password</span>';
            }else{
				$data = '';
                $idxRec = $db->strip($row->ID);
                $firstnameRec = $db->strip($row->firstname);
                $lastnameRec = $db->strip($row->lastname);
                $typeRec = $db->strip($row->type);
				$emailRec = $db->strip($row->email);
                $accountNumRec = $db->strip($row->acct_no);
				$userID = $db->strip($row->ID);
                $terms_flag = $db->strip($row->terms_flag);
				
                if($terms_flag != 1){
                    session_start();
    				session_regenerate_id();
                    $_SESSION['sess_user_id']  = $db->random_value();
                    $_SESSION['idx']           = $idxRec;
                    $_SESSION['first_name']    = $firstnameRec;
                    $_SESSION['last_name']     = $lastnameRec;
                    $_SESSION['full_name']     = $firstnameRec.' '.$lastnameRec;
    				$_SESSION['email']         = $emailRec;
                    $_SESSION['account_num']   = $accountNumRec;
					$_SESSION['terms_flag']	   = $terms_flag;
    				session_write_close();
                    echo '<script>showModalTerms();</script>';
                }else{
                    session_start();
    				session_regenerate_id();
                    $_SESSION['sess_user_id']  = $db->random_value();
                    $_SESSION['idx']           = $idxRec;
                    $_SESSION['first_name']    = $firstnameRec;
                    $_SESSION['last_name']     = $lastnameRec;
                    $_SESSION['full_name']     = $firstnameRec.' '.$lastnameRec;
    				$_SESSION['email']         = $emailRec;
                    $_SESSION['account_num']   = $accountNumRec;
    				session_write_close();
    				header("Location: accounts");
                }
            }

        return $data;
        
    }
	
	public function createConfirmationLink($userName, $connect) {
	
		$db = new db_config();
		
		$data = '';
	
		$sql = $db->mquery("SELECT * FROM users WHERE email = '" . $userName . "'", $connect);

		while($row = $db->fetchobject($sql)){
		
			$activation_key = $db->strip($row->activation_key);
			$email = $db->strip($row->email);
			$token = $db->strip($row->token);
			
			$data = "http://mobilyser.net/createpassword?reset=false&email=".urlencode($email)."&verification=".urlencode($activation_key)."&token=".$token."";
		}
		
		return $data;	
	}
	
    public function updateTermsPage($checkEmail, $connect) {

        $db = new db_config();
		
		$db->mquery("EXEC dbo.terms_update @email = '".$checkEmail."'", $connect);
		
		session_start();
    	session_regenerate_id();
		session_write_close();
		header("Location: accounts?terms=true");
	}
	
	public function createUserPassword($emailParam, $activationParam, $userPassword, $connect) {
	
		$db = new db_config();
		$dbCheck = new db_config();
		$dbRemoveToken = new db_config();
		
		$sqlCheck = $dbCheck->mquery("SELECT * FROM users WHERE email = '" . $emailParam . "'", $connect);
		
		$num = $dbCheck->numhasrows($sqlCheck);
		$row = $dbCheck->fetchobject($sqlCheck);
		
		$username = $dbCheck->strip($row->username);
		$pass = $dbCheck->strip($row->password);
		$token = $dbCheck->strip($row->token);
		$time_token = $dbCheck->strip($row->token);
		
		if(strlen($pass) == 0){
		
			$db->mquery("EXEC dbo.createUserPassword @email = '".$emailParam."', @activation_key = '".$activationParam."', @password ='".$userPassword."'", $connect);
			
			$sqlRemoveToken = $dbRemoveToken->mquery("UPDATE users SET token = NULL, time_token = NULL WHERE username='".$username."' AND token='".$token."'", $connect);
			
			header("Location: index.php?createpasswordsuccess=true");
		
		} else {
		
			//this means we already have a password
			
		}
	}
	
	public function createForgotPasswordLink($email, $connect) {
	
		$db = new db_config();
		$dbCreateToken = new db_config();
		
		$userQuery = $db->mquery("SELECT * FROM users WHERE email = '".$email."'", $connect);
		
		$num = $db->numhasrows($userQuery);
		$row = $db->fetchobject($userQuery);
		
		if ($num == 0) {
				
			$data = NULL;
		
		} else {
					
			$userEmail = $db->strip($row->email);
			$activation_key = $db->strip($row->activation_key);
			$firstname = $db->strip($row->firstname);
			$lastname = $db->strip($row->lastname);
			
			$token = sha1(uniqid($username, true));
			$time_token = $_SERVER['REQUEST_TIME'];
			
			$sqlCreateToken = $dbCreateToken->mquery("UPDATE users SET token = '".$token."', time_token = '".$time_token."' WHERE username = '".$userEmail."' AND activation_key = '".$activation_key."'", $connect);
			
			session_start();
    		session_regenerate_id();
			$_SESSION['userinfo'] = $firstname . ' ' . $lastname;
			session_write_close();
			
			$data = "http://mobilyser.net/createpassword?reset=true&email=".urlencode($userEmail)."&verification=".urlencode($activation_key)."&token=".$token."";
			header("Location: index.php?emailvalid=true");
		
		}
		
		return $data;

	}
	
	public function resetUserPassword($emailParam, $activationParam, $userPassword, $connect) {
	
		$db = new db_config();
		$dbCheck = new db_config();
		$dbRemoveToken = new db_config();
		
		$sqlCheck = $dbCheck->mquery("SELECT * FROM users WHERE email = '" . $emailParam . "'", $connect);
		
		$num = $dbCheck->numhasrows($sqlCheck);
		$row = $dbCheck->fetchobject($sqlCheck);
		
		$username = $dbCheck->strip($row->username);
		$pass = $dbCheck->strip($row->password);
		$token = $dbCheck->strip($row->token);
		$time_token = $dbCheck->strip($row->token);
		
		if(strlen($pass) != 0){
		
			$db->mquery("EXEC dbo.createUserPassword @email = '".$emailParam."', @activation_key = '".$activationParam."', @password ='".$userPassword."'", $connect);
			
			$sqlRemoveToken = $dbRemoveToken->mquery("UPDATE users SET token = NULL, time_token = NULL WHERE username='".$username."' AND token='".$token."'", $connect);
			
			header("Location: index.php?resetpassword=true");
		
		} else {
		
			//this means we still don't have a password
		
		}
		
	}
	
	public function checkLinkExpiry($emailParam, $tokenValue, $connect) {
		
		$db = new db_config();
		$sql = $db->mquery("SELECT * FROM users WHERE email = '" . $emailParam . "' AND token ='" . $tokenValue . "'", $connect);
		
		$num = $db->numhasrows($sql);
		$row = $db->fetchobject($sql);
		$token = $db->strip($row->token); //sha1 chars
		$time_token = $db->strip($row->time_token); //UNIX timestamp used for expiry - generated during signup
		$datetime = $row->timestamp; //date time object generated during signup
		
		//$time_token and $datetime has different formats but has equal values
		//use:
		//date('Y-m-d H:i:s', $time_token) - to convert the unix time format to date time format
		//strtotime($datetime->format("Y-m-d H:i:s")); - the date time format to unix time format
		
		if ($num == 0) {
		
			$data = '';
		
		} else {
			
			$expiry_date = $time_token;
			$data = '';
			$data = $expiry_date;
		}
		
		return $data;

	}
	
	public function registerInterest ($data, $connect) {
	
		$db = new db_config();
		$dbCheck = new db_config();
		$email_data = $data['@email'];
		
		$sqlCheck = $dbCheck->mquery("SELECT * FROM register_interest WHERE email = '" . $email_data . "'", $connect);
		$num = $dbCheck->numhasrows($sqlCheck);
		$row = $dbCheck->fetchobject($sqlCheck);
		
		if ($num == 0) {
		
			$sql = $db->mquery_insert("dbo.registerInterest", $data, $connect);
			header ("location: confirmation?register_success=true");
		
		} else {
			
			
			$sql = $db->mquery_insert("dbo.registerInterest", $data, $connect);
			header ("location: confirmation?register_success=true");
			
			//note: for the meantime duplicates are okay
			//header ("location: index.php?emailcheck=true");
		
		}
	
	}
	
}

?>