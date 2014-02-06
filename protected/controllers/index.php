<?php
class IndexController {

    public function indexPage($email, $password, $activationcode, $connect) {

        $db = new db_config();

        if($activationcode == 0){

            $sql = $db->mquery("EXEC dbo.login
                    @email = '".$email."',
                    @Password = '".$password."'",$connect);

            $num = $db->numhasrows($sql);
            $row = $db->fetchobject($sql);


            if($num == 0){
                $data = '<span class="error">No Record Found.</span>';
            }else{
                $idxRec = $db->strip($row->ID);
                $firstnameRec = $db->strip($row->firstname);
                $lastnameRec = $db->strip($row->lastname);
                $typeRec = $db->strip($row->type);
				$emailRec = $db->strip($row->email);
                $accountNumRec = $db->strip($row->acct_no);
				$userID = $db->strip($row->ID);

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
				header("Location: ../mobilyser-beta/accounts.php");
            }

        }else{
            // with activation 
        }

        return $data;
    }
 
}

?>