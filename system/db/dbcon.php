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
		$link = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWD, DB_DATABASE);
		if($link){
			@mysqli_close($link);
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
		$link = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWD, DB_DATABASE);

		if(!$link){

			print "could not find the database";

		}



		$result = @mysqli_query($link, $query);

		if(!$result){

			print "Query error ".mysqli_error($link);

		}

		while($row = @mysqli_fetch_assoc($result)){

			array_push($collection, $row);


		}



		mysqli_close($link);



		return $collection;

	}

}