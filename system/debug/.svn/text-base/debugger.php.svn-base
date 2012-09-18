<?php

function debug($message,$location=""){



	if(DEBUG_ON){

		print "<br>";
		if(!empty($location)){

			print '<p style="'.'color'.'=red;">'.$location.'</p>';

		}

		if(is_object($message)){

			var_dump($message);
			print "<br>";
			print "Methods: ";
			print_r(get_class_methods($message));
		}
		elseif(is_array($message)){
				
			print_r($message);

		}else{

			print $message;

		}

		print "<br>";
	}


}