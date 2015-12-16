<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
</head>
  <body>
    <?php
    $username = 'da6f5e0b-334d-4889-92b4-bcf4e013658a';
$password = 'YzXGqvlZJ83d';

$data = array(
    "username" => $username,
    "password" => $password,
);

$data['sig'] = sha1($data['username'] . $data['password']);
unset($data['password']);

$data = http_build_query($data, "", "&");

//header
$header = array(
    "Content-Type: application/x-www-form-urlencoded",
    "Content-Length: ".strlen($data)
);

$context = array(
    "http" => array(
        "method"  => "POST",
        "header"  => implode("rn", $header),
        "content" => $data
    )
);

$url = "https://gateway.watsonplatform.net/visual-recognition-beta/api/v1/tag/recognize";
echo file_get_contents($url, false, stream_context_create($context));
    ?>
  </body>
</html>
