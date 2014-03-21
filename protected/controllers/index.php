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
                if($terms_flag == null){
                    session_start();
    				session_regenerate_id();
                    $_SESSION['sess_user_id']  = $db->random_value();
                    $_SESSION['idx']           = $idxRec;
                    $_SESSION['first_name']    = $firstnameRec;
                    $_SESSION['last_name']     = $lastnameRec;
                    $_SESSION['full_name']     = $firstnameRec.' '.$lastnameRec;
    				$_SESSION['email']         = $emailRec;
                    $_SESSION['account_num']   = $accountNumRec;
					$_SESSION['isTerm']        = 0;
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
    public function updateTermsPage($checkEmail, $connect) {

        $dbNew = new db_config();
		
		$dbNew->mquery("EXEC dbo.terms_update @email = '".$checkEmail."'", $connect);
		
		session_start();
    	session_regenerate_id();
		$_SESSION['isTerm'] = 1;
		session_write_close();
		header("Location: accounts.php");
	}
}

?>