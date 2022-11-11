<?php 
namespace Database;

include 'ENV.php';

$DOMAIN = $env->env()['DOMAIN'];

$db_host		= $env->env()['DB_HOSTNAME'];
$db_username	= $env->env()['DB_USERNAME'];
$db_password	= $env->env()['DB_PASSWORD'];
$db_database	= $env->env()['DB_NAME'];

class Connect
{
	public function query($sql) {
		global $db_host;
		global $db_username;
		global $db_password;
		global $db_database;

		$connect = mysqli_connect($db_host, $db_username, $db_password, $db_database) or die('No Database!');

		$data = mysqli_query($connect, $sql) or die("Query Problem!\n".mysqli_error($connect));

        return $data;
	}
	
}

$db = new Connect();

if (isset($_SESSION['AUTHENTIFICATION'])) {
	if ($_SESSION['AUTHENTIFICATION'] != '-----') {
		$_USER = array();
		$vv = $db->query("SELECT * FROM user WHERE id = '".$_SESSION['USER_ID']."'");
		$cc = mysqli_fetch_array($vv);
		foreach ($cc as $key => $value) {
			$_USER[$key] = $value;
		}
	}
}
