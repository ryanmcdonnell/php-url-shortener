<?php
require('config.php');

$url = isset($_GET['url']) ? urldecode(trim($_GET['url'])) : '';
if(empty($url))
	die('Enter a valid URL.');

$parsed_url = parse_url($url);
if($parsed_url['host'] != LIMIT_TO_DOMAIN)
  die('This shortener can only be used with '.LIMIT_TO_DOMAIN);

$db = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
$db->set_charset('utf8');
$url = $db->real_escape_string($url);

// Check for existing URL
$result = $db->query("SELECT id FROM redirect WHERE url = '$url' LIMIT 1");
if($result && $result->num_rows > 0):
	$id = base_convert($result->fetch_object()->id, 10, 36);
else:
	$result = $db->query('INSERT INTO redirect (url, date) VALUES ("' . $url . '", NOW())');
	if($result):
		$id = base_convert($db->insert_id, 10, 36);
	else:
		die('A database error occured: '.$db->error);
	endif;
endif;
?>
<p>
	<input type="text" size="150" value="<?php echo SHORT_URL.$id; ?>" onFocus="this.select()" />
</p>