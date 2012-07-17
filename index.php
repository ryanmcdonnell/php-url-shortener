<?php
require('config.php');

$url = DEFAULT_URL.'/';

if(isset($_GET['id'])):

	$id = intval($_GET['id'], 36);
	
	if(!empty($id)):
		$db = new MySQLi(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
		$db->set_charset('utf8');
		$result = $db->query("SELECT url FROM redirect WHERE id = $id");
		if($result && $result->num_rows > 0)
			$url = $result->fetch_object()->url;
		$db->close();
	endif;
	
endif;	

header('Location: '.$url, null, 302);
exit;