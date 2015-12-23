<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
</head>
  <body>
    <?php
    const USER = 'ユーザーネーム';
    const PASS = 'パスワード';

    $url = 'https://gateway.watsonplatform.net/visual-recognition-beta/api/v1/tag/recognize';
    $curl = curl_init();
    $params = array('images_file'=>'@'.realpath('0001.jpg').';filename=0001.jpg;type=image/jpg');

    //APIに画像をPOSTする処理
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl, CURLOPT_USERPWD, USER.':'.PASS);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SAFE_UPLOAD, false);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $params);

    $result = curl_exec($curl);

    $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);

    //結果の表示
    echo $result;
    ?>
  </body>
</html>
