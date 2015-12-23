<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
</head>
  <body>
    <?php
    const TOKEN = 'アクセストークン';

    //処理の確認
    $type = false; //URLの場合：true、ファイル名の場合：false
    $photo_url = ''; //trueの場合入力
    $file_name = 'photo/0001.jpg'; //falseの場合入力

    $url = 'https://api.clarifai.com/v1/tag/';
    $curl = curl_init();
    $header = array('Authorization: Bearer ' . TOKEN);
    $params = array(
                    'language'=>'ja',
                    'model'=>'general-v1.3'
    );

    //URLまたはファイル名を配列に追加
    if($type == true){
        $params += array('url'=>$photo_url);
    }else{
        $path = pathinfo($file_name);
        $extension = $path['extension'];
        $params += array('encoded_data'=>'@'.realpath($file_name).";filename=$file_name;type=image/$extension");
    }

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

    //結果の表示
    var_dump($result_array['results'][0]['result']['tag']['classes']);
    var_dump($result_array['results'][0]['result']['tag']['probs']);
    ?>
  </body>
</html>
