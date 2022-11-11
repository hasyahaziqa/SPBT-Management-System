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
			'DOMAIN' =>'http://localhost/E-Borrow/',
			'DB_HOSTNAME' => 'localhost',
			'DB_USERNAME' => 'root',
			'DB_PASSWORD' => '',
			'DB_NAME' => 'eborrow',
		];
	}
}

$env = new Environment();

?>