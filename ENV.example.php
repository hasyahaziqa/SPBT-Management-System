<?php 
namespace Environment;
/**
 * 
 */
class Environment
{
	
	function env()
	{
		return [
			'DOMAIN' =>'',
			'DB_HOSTNAME' => '',
			'DB_USERNAME' => '',
			'DB_PASSWORD' => '',
			'DB_NAME' => '',
		];
	}
}

$env = new Environment();

?>