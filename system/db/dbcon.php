<?php
require_once 'dbengine.php';

class MySQLDBConnection implements DBEngine {

	/**
	 * Check Database Connection
	 * Check the database location
	 */
	function checkDB(){

		// Fix logon error
		$result = false;
		$link = @mysql_connect(DB_HOST,DB_USER,DB_PASSWD);
		$db = @mysql_select_db(DB_DATABASE,$link);
		if($link && $db){
			@mysql_close($link); 
			$result = true;
		}
		return $result;

	}

	/**
	 * 
	 * Before doing some query check first DB Link
	 * @param $query
	 */
	function doQuery($query=""){


		$collection = array();
		$link = @mysql_connect(DB_HOST,DB_USER,DB_PASSWD);

		if(!@mysql_select_db(DB_DATABASE,$link)){

			print "could not find the database";

		}

		
		
		$result = @mysql_query($query,$link);
		
		if(!$result){
		
			print "Query error ".mysql_error();
		
		}

		while($row = @mysql_fetch_assoc($result)){

			array_push($collection, $row);


		}
                
                


		mysql_close($link);
		
		

		return $collection;

	}













}