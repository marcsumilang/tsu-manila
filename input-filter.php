<?php
	error_reporting(E_ALL ^ E_WARNING); 
	require_once 'htmlpurifier/HTMLPurifier.standalone.php';
    $purifier = new HTMLPurifier();
    
    function purifyArray($data){
		global $purifier;
		foreach ($data as $key => $value){
			$data[$key] = $purifier->purify($data[$key]);
		}
		return $data;
	}

?>