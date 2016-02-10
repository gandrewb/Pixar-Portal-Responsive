<?php
include '../../db/db.php';
$db = new Database();
$rows = $db->dq('SELECT * FROM blog WHERE status="published" ORDER BY timestamp DESC LIMIT 30');

$filecontent = '<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0">
  <channel>
    <title>Pixar Portal</title>
    <link>http://www.pixarportal.com</link>
    <description>News, rumors, community and information about your favorite animated movies from Pixar Animation Studios.</description>
    <language>en-us</language>
    <ttl>30</ttl>
';

foreach($rows as $row){
	
	$filecontent .= '
		<item>
			<title>' . stripslashes($row['title']) . '</title>
			<link>http://www.pixarportal.com/blog.php?id=' . $row['url'] . '</link>
			<description>' . $db->websafe($row['article']) . '</description>
			<pubDate>' . date('D, d M Y H:i:s O', $row['timestamp']) . '</pubDate>
		</item>
	';
}

$filecontent .= '
	</channel>
</rss>
';

$rssFile = fopen("../../feed.rss", "w");
$success = fwrite($rssFile, $filecontent);

if(!$success){
	echo 'Could not write to file.';
}

fclose($rssFile);

header('Location: ../index.php');
exit;
?>