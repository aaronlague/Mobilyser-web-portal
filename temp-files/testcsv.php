<?php
include '../protected/config/db_config.php';


    function query_to_csv($connect, $query, $filename, $attachment = true, $headers = false) {
	
	$db = new db_config();
	$connect = $db->connect();
        
        if($attachment) {
            // send response headers to the browser
            header( 'Content-Type: text/csv' );
            header( 'Content-Disposition: attachment;filename='.$filename);
            $fp = fopen('php://output', 'w');
        } else {
            $fp = fopen($filename, 'w');
        }
        
		$query = "SELECT * FROM call";
		
        $result = $db->mquery($query, $connect);
        
        if($headers) {
            // output header row (if at least one row exists)
            $row = $db->fetcharray($result);
			//echo "this is a test";
            
			if($row) {
                fputcsv($fp, array_keys($row));
                // reset pointer back to beginning
                //mysql_data_seek($result, 0);
			}
        }
        
        while($row = $db->fetcharray($result)) {
            fputcsv($fp, $row);
        }
        
        fclose($fp);
    }

    // Using the function
    //$sql = "SELECT * FROM table";
    // $db_conn should be a valid db handle

    // output as an attachment
    query_to_csv($connect, $query, "test.csv", true);

    // output to file system
    query_to_csv($connect, $query, "test.csv", false);
?>
