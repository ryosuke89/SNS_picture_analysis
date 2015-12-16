<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
</head>
  <body>
    <?php
    $url = 'https://gateway.watsonplatform.net/visual-recognition-beta/api/v1/tag/recognize';
$data = array(
	'username' => 'da6f5e0b-334d-4889-92b4-bcf4e013658a',
	'password' => 'YzXGqvlZJ83d'
);
$header = Array(
	"Content-Type: application/x-www-form-urlencoded"
);
$options = array('http' => array(
	'method' => 'POST',
	'header'  => implode("\r\n", $header),
	'content' => http_build_query($data),
));
$contents = file_get_contents($url, false, stream_context_create($options));
echo $contents;
    ?>
  </body>
</html>
