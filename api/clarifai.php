<?php require_once '../common/api_dbaccesUtil.php'; ?>
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

    //処理の確認
    $token = false;  //trueの場合：アクセストークンを取得、falseの場合：画像認識を実行
    $db = false;     //DBに追加する場合true

    //画像認識する範囲のphotoIDを入力
    $first = 1;
    $last = 10;

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
        //画像のURLをDBから取得
        $photo_array = select_all('photo');

        //photoIDと配列番号を同じにする処理
        $first_array = $first - 1;
        $last_array = $last - 1;

        $url = 'https://api.clarifai.com/v1/tag/';
        $curl = curl_init();
        $header = array('Authorization: Bearer ' . TOKEN);

        $connect_url = null;

        //入力した範囲の画像のURLを連結
        for($i = $first_array; $i <= $last_array; $i++){
            $photo_url = 'url=' . $photo_array[$i]['photoURL'] . '&';
            $connect_url = $connect_url . $photo_url;
        }

        $params = $connect_url . 'language=ja&model=general-v1.3';

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

        $number = $last - $first;

        for($j = 0; $j <= $number; $j++){
            $id = $first_array + $j;
            //snsID、photoIDをDBから取得
            $snsID = $photo_array[$id]['snsID'];
            $photoID = $photo_array[$id]['photoID'];

            //DBに画像認識の結果を追加
            if($db == true && !empty($result_array['results'][$j]['result']['tag']['classes'][0])){
                $insert_result = insert_recognition(
                                                    $result_array['results'][$j]['result']['tag']['classes'][0],
                                                    $result_array['results'][$j]['result']['tag']['classes'][1],
                                                    $result_array['results'][$j]['result']['tag']['classes'][2],
                                                    $result_array['results'][$j]['result']['tag']['classes'][3],
                                                    $result_array['results'][$j]['result']['tag']['classes'][4],
                                                    $result_array['results'][$j]['result']['tag']['classes'][5],
                                                    $result_array['results'][$j]['result']['tag']['classes'][6],
                                                    $result_array['results'][$j]['result']['tag']['classes'][7],
                                                    $result_array['results'][$j]['result']['tag']['classes'][8],
                                                    $result_array['results'][$j]['result']['tag']['classes'][9],
                                                    $result_array['results'][$j]['result']['tag']['classes'][10],
                                                    $result_array['results'][$j]['result']['tag']['classes'][11],
                                                    $result_array['results'][$j]['result']['tag']['classes'][12],
                                                    $result_array['results'][$j]['result']['tag']['classes'][13],
                                                    $result_array['results'][$j]['result']['tag']['classes'][14],
                                                    $result_array['results'][$j]['result']['tag']['classes'][15],
                                                    $result_array['results'][$j]['result']['tag']['classes'][16],
                                                    $result_array['results'][$j]['result']['tag']['classes'][17],
                                                    $result_array['results'][$j]['result']['tag']['classes'][18],
                                                    $result_array['results'][$j]['result']['tag']['classes'][19],
                                                    $snsID,
                                                    $photoID
                );
            }

            //エラーが発生しなければ画像認識の結果を表示
            if(!isset($insert_result)){
                if($db == true){
                    echo 'photoID=' . $photoID . 'の結果を取得しました。<br>';
                }else{
                    echo 'photoID=' . $photoID . 'の結果<br>';
                }
                var_dump($result_array['results'][$j]['result']['tag']['classes']);
                var_dump($result_array['results'][$j]['result']['tag']['probs']);
                echo "<br>" . "<br>";
            }
        }
    }
    ?>
  </body>
</html>
