<?php require_once 'api_dbaccesUtil.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
</head>
  <body>
    <?php
    const CID = 'クライアントID';
    const CKey = 'クライアントシークレット';
    const TOKEN = 'アクセストークン';

    //アクセストークンの取得確認
    $token = true;  //trueの場合、アクセストークンを取得

    if($token == true){
        //アクセストークンの取得処理
        $url = 'https://api.clarifai.com/v1/token/';
        $curl = curl_init();
        $params = array(
                        'grant_type'=>'client_credentials',
                        'client_id'=>CID,
                        'client_secret'=>CKey
        );

        //APIにClient IdとClient SecretをPOSTする処理
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SAFE_UPLOAD, false);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $params);

        $result = curl_exec($curl);

        $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        //アクセストークンの表示
        echo $result;
    }else{
        //画像認識の処理
        $photo_array = select_photo();

        //画像認識する範囲のphotoIDを入力
        $first = 101;
        $last = 105;

        //photoIDと配列番号を同じにする処理
        $first_array = $first - 1;
        $last_array = $last - 1;

        //入力した範囲の画像のURLを配列に格納
        for($i = $first_array; $i <= $last_array; $i++){
            $url = 'https://api.clarifai.com/v1/tag/';
            $curl = curl_init();
            $header = array('Authorization: Bearer ' . TOKEN);

            $photo_url = $photo_array[$i]['photoURL'];
            $params = array(
                            'url'=>$photo_url,
                            'language'=>'ja',
                            'model'=>'general-v1.3'
            );

            //APIに画像をPOSTする処理
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
            curl_setopt($curl, CURLOPT_SAFE_UPLOAD, false);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $params);

            $result = curl_exec($curl);

            curl_close($curl);
            $result_array = (json_decode($result, true));

            echo "<br>" . "<br>";
            $j = $i + 1;

            //結果の表示
            echo 'photoID=' . $j . 'の結果<br>';
            var_dump($result_array['results'][0]['result']['tag']['classes']);
            var_dump($result_array['results'][0]['result']['tag']['probs']);
        }
    }
    ?>
  </body>
</html>
