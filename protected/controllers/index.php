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
					//$_SESSION['isTerm']        = 0;
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
    				header("Location: accounts.php");
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
			
			$data = "http://mobilyser.net/createpassword.php?reset=false&email=".urlencode($email)."&verification=".urlencode($activation_key)."";
		}
		
		return $data;
	
	}
	
    public function updateTermsPage($checkEmail, $connect) {

        $db = new db_config();
		
		$db->mquery("EXEC dbo.terms_update @email = '".$checkEmail."'", $connect);
		
		session_start();
    	session_regenerate_id();
		//$_SESSION['isTerm'] = 1;
		session_write_close();
		header("Location: accounts.php?terms=true");
	}
	
	public function createUserPassword($emailParam, $activationParam, $userPassword, $connect) {
	
		$db = new db_config();
		$dbCheck = new db_config();
		
		$sqlCheck = $dbCheck->mquery("SELECT * FROM users WHERE email = '" . $emailParam . "'", $connect);
		
		$num = $dbCheck->numhasrows($sqlCheck);
		$row = $dbCheck->fetchobject($sqlCheck);
		$pass = $dbCheck->strip($row->password);
		
		if(strlen($pass) == 0){
		
			$db->mquery("EXEC dbo.createUserPassword @email = '".$emailParam."', @activation_key = '".$activationParam."', @password ='".$userPassword."'", $connect);
			
			header("Location: index.php?createpasswordsuccess=true");
		
		} else {
		
		}
	}
	
	public function createForgotPasswordLink($email, $connect) {
	
		$db = new db_config();
		
		$userQuery = $db->mquery("SELECT * FROM users WHERE email = '".$email."'", $connect);
		
		$num = $db->numhasrows($userQuery);
		$row = $db->fetchobject($userQuery);
		
		if ($num == 0) {
				
			header("Location: forgotpassword.php?success=false");
		
		} else {
			
			$userEmail = $db->strip($row->email);
			$activation_key = $db->strip($row->activation_key);
			$firstname = $db->strip($row->firstname);
			$lastname = $db->strip($row->lastname);
			
			session_start();
    		session_regenerate_id();
			$_SESSION['userinfo'] = $firstname . ' ' . $lastname;
			session_write_close();
			$data = "http://mobilyser.net/createpassword.php?reset=true&email=".urlencode($userEmail)."&verification=".urlencode($activation_key)."";
			header("Location: forgotpassword.php?success=true");
		
		}
		
		return $data;

	}
	
	public function resetUserPassword($emailParam, $activationParam, $userPassword, $connect) {
	
		$db = new db_config();
		$dbCheck = new db_config();
		
		$sqlCheck = $dbCheck->mquery("SELECT * FROM users WHERE email = '" . $emailParam . "'", $connect);
		
		$num = $dbCheck->numhasrows($sqlCheck);
		$row = $dbCheck->fetchobject($sqlCheck);
		$pass = $dbCheck->strip($row->password);
		
		if(strlen($pass) != 0){
		
			$db->mquery("EXEC dbo.createUserPassword @email = '".$emailParam."', @activation_key = '".$activationParam."', @password ='".$userPassword."'", $connect);
			
			header("Location: index.php?resetpassword=true");
		
		} else {
		
		}
		
	}
	
}

?>