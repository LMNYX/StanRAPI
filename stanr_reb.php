<?php

class Rebalance
{
	const BASE_URL = "https://newpp.stanr.info";
	function GetResults($username)
	{
		$data = array('jsonUsername' => $username, 'calc' => false);
		$options = array(
	    		'http' => array(
	       		 'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
	       		 'method'  => 'POST',
	       		 'content' => http_build_query($data)
	   		 )
			);
		$c = stream_context_create($options);
		$result = file_get_contents(self::BASE_URL."/GetResults/",false, $c);
		json_decode($result);
		if(json_last_error()== JSON_ERROR_NONE)
		{
			return false;
		}
		return json_decode($result, true);
	}
	function GetQueue()
	{
		return json_decode(file_get_contents(self::BASE_URL."/GetQueue"), true);
	}
	function AddQueue($username)
	{
		$data = array('jsonUsername' => $username);
		$options = array(
	    		'http' => array(
	       		 'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
	       		 'method'  => 'POST',
	       		 'content' => http_build_query($data),
	       		 'ignore_errors' => true
	   		 )
			);
		$c = stream_context_create($options);
		$result = file_get_contents(self::BASE_URL."/AddToQueue/",false, $c);
		return json_decode($result,true);
	}
}

?>