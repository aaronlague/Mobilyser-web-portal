<?php
//define('DB_SERVER', 'FLEXIADMIN');
define('DB_SERVER', 'FLEXISOURCEIT\SQLEXPRESS');
//define('DB_USERNAME', 'sa');
define('DB_USERNAME', 'myodadmin');
define('DB_PASSWORD', 'Pass1234');
define('DB_DATABASE', 'MYOD');

class db_config {

	/*** SQL Server Settings Start ***/
	public function connect() {  
		$serverName = DB_SERVER; 
	 	$connectionInfo = array( "Database"=>DB_DATABASE, "UID"=>DB_USERNAME, "PWD"=>DB_PASSWORD);
	 	$link = sqlsrv_connect( $serverName, $connectionInfo);
	 	if($link){
	  		//echo "Connection established.<br />";
	 	}else{
	  		echo "Connection could not be established.<br />";
	  		die( print_r( sqlsrv_errors(), true));
	 	}
	 	return $link;
	}
	public function mquery($query, $link){
		$query.= "; SELECT SCOPE_IDENTITY() AS IDENTITY_COLUMN_NAME"; 
		$result =sqlsrv_query($link, $query);
		if( $result === false ){
			echo "Error in executing query.</br>";
	     	die( print_r( sqlsrv_errors(), true));
		}else{
			return $result;
		}
	}
	public function numrows($query){
		return @sqlsrv_num_rows($query);
	}
	public function numhasrows($query){
		return @sqlsrv_has_rows($query);
	}
	public function fetchobject($query){
		return @sqlsrv_fetch_object($query);
	}
	public function fetcharray($query){
		return @sqlsrv_fetch_array($query);
	}
	public function mquery_insert($table, $data, $connect){
		$q="EXEC ".$table." ";
	
		foreach($data as $key=>$val) {
			if(strtolower($val)=='null') $q.= "$key = NULL, ";
			elseif(strtolower($val)=='now()') $q.= "$key = NOW(), ";
			else $q.= "$key='".$this->escape($val)."', ";
		}
	
		$q = rtrim($q, ', ') . ' ;';
		return $this->mquery($q, $connect);
	}
	public function mquery_update($table, $data, $where='1'){
		$q="UPDATE ".$table." SET ";
	
		foreach($data as $key=>$val) {
			if(strtolower($val)=='null') $q.= "$key = NULL, ";
			elseif(strtolower($val)=='now()') $q.= "$key = NOW(), ";
			else $q.= "$key='".$this->escape($val)."', ";
		}
	
		$q = rtrim($q, ', ') . ' WHERE '.$where.';';
		return $this->mquery($q);
	}
	public function query_delete($table, $where) {
		return $this->mquery("DELETE FROM ".$table." WHERE ".$where."");
	}
	public function field_search($data, $operation){	

		$q=" ";
		$v=''; $n='';
		
		foreach($data as $key=>$val) {
			if($operation == 0){
				$n.="$key = '".$val."', ";
			}elseif($operation == 1){
				$n.="$key LIKE '%".$val."%' and ";
			}elseif($operation == 2){
				$n.="$key = '".$val."' or ";
			}elseif($operation == 3){
				$n.="$key >= '".$val."' and ";
			}elseif($operation == 4){
				$n.="$key <= '".$val."' and ";
			}
			
			if(strtolower($val)=='null') $v.="NULL, ";
			elseif(strtolower($val)=='now()') $v.="NOW(), ";
			else $v.= "'".$this->escape($val)."', ";
		}

		$q .= $n;		
		return $q;
	}
	/*** SQL Server Settings End ***/

	/*** Encryption Function ***/
	public function codecrypt($string){
		return crypt($string, 'myowndevice');
	}
	
	/*** Random Value Function ***/
	public function random_value(){
		$ipbits = explode(".", $_SERVER["REMOTE_ADDR"]); 
		list($usec, $sec) = explode(" ",microtime()); 
		$usec = (integer) ($usec * 65536); 
		$sec = ((integer) $sec) & 0xFFFF; 
		return sprintf("%08x%04x%04x",($ipbits[0] << 24)|($ipbits[1] << 16) | ($ipbits[2] << 8) | $ipbits[3], $sec, $usec); 	
	}
	public function escape($string){
		return addslashes($string);
	}	
	public function strip($string){
		return stripslashes($string);
	}
}
?>