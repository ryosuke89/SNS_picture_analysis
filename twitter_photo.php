﻿<?php
require_once 'twitteroauth/autoload.php';
require_once 'api_dbaccesUtil.php';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
</head>
  <body>
    <?php
    //TwitterOAuthを使う
    //https://github.com/abraham/twitteroauth
    //twitteroauthフォルダと同じ階層に置く
    //TwitterOAuth.phpの「private function oAuthRequest(url,method, $parameters)」のprivateを削除
    use Abraham\TwitterOAuth\TwitterOAuth;

    //設定
    $consumerKey = "カスタマーキー";
    $consumerSecret = "カスタマーシークレット";
    $accessToken = "アクセストークン";
    $accessTokenSecret = "アクセストークンシークレット";

    //認証
    $connection = new TwitterOAuth($consumerKey,$consumerSecret,$accessToken,$accessTokenSecret);

    //$next_resultsの初期化
    $next_results = null;
    //DB格納用にTwitterのsnsIDを設定
    $snsID = 1;

    //処理の確認
    $db = false;        //DBに追加する場合true
    $confirm = true;    //ツイートIDの確認の場合true
    $tweet_id = 676914; //確認したツイートIDを入力(上6桁)

    //確認の場合と取得の場合の条件分岐
    if($confirm == true){
        $repeat = 1;
    }else{
        $repeat = 24;
    }

    //初回のツイートID
    $tweet_id = $tweet_id + 15;

    //約1時間ごとに取得を繰り返す
    for($i = 0; $i < $repeat; $i++){
        //ツイート検索パラメータの設定
        $params = array(
                        "q"=>"filter:images since:2015-12-15 until:2015-12-16", //検索キーワード
                        "lang"=>"ja",             //言語コード
                        "count"=>50,              //取得件数（100件が上限）
                        "include_entities"=>true, //trueにすると添付URLについての情報を追加で取得できる
                        "result_type"=>"recent",  //新着順に取得
        );

        //2回目以降は約1時間前のツイートIDにする
        $tweet_id = $tweet_id - 15;
        if($confirm == false){
            $params += array("max_id"=>$tweet_id . "100000000000");
        }

        //リクエスト回数
        $request_number = 1;

        for($j = 0; $j < $request_number; $j++){

            //検索結果の取得($tweets_objはJSONの検索結果が入る）
            $tweets_obj = $connection->OAuthRequest(
                                                    'https://api.twitter.com/1.1/search/tweets.json',
                                                    'GET',
                                                    $params
            );

            if($tweets_obj){
                //検索結果をjson_decodeで連想配列に変換
                $tweets_arr = json_decode($tweets_obj, true);
                //画像のURLを取得
                foreach($tweets_arr['statuses'] as $statuses){
                    if(isset($statuses['entities']['media'][0]['media_url'])){
                        $photoURL = $statuses['entities']['media'][0]['media_url'];
                        //APIの日時に合わせる
                        date_default_timezone_set('Europe/London');
                        //投稿日時を取得
                        $postedDate = date('Y-m-d H:i:s', strtotime($tweets_arr['statuses'][0]['created_at']));
                        //DBに画像のURLと投稿日時を追加
                        if($db == true){
                            $result = insert_photo($photoURL, $postedDate, $snsID);
                        }
                    }
                }
            }

            //先頭の「?」を除去
            $next_results = preg_replace('/^\?/', '', $tweets_arr['search_metadata']['next_results']);

            //$next_resultsが無ければ処理を終了
            if(empty($next_results)){
                break;
            }

            //パラメータに変換
            parse_str($next_results, $params);
        }

        //エラーが発生しなければ表示
        if(!isset($result)){
            if($db == true){
                echo '画像のURLを' . $params['count'] * $request_number . '件取得しました。<br>';
            }else{
                echo $params['count'] * $request_number . '件検索しました。<br>';
            }
            echo '投稿日時：' . $postedDate . "<br>";
            echo '次ページのツイートID：' . $params['max_id'] . "<br>" . "<br>";
        }
    }
    ?>
  </body>
</html>
