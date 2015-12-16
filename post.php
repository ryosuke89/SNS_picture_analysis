<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
</head>
  <body>
    <?php
    $data = array(
        'username' => 'da6f5e0b-334d-4889-92b4-bcf4e013658a',
        'password' => 'YzXGqvlZJ83d',
    );
    $opt = array('http' => array(
        'method' => 'POST',
        'content' => http_build_query($data),
    ));
    $contents = file_get_contents('https://gateway.watsonplatform.net/visual-recognition-beta/api/v1/tag/recognize', false, stream_context_create($opt));
    ?>
  </body>
</html>
