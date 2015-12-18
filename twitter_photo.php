<?php
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

    //ツイート検索パラメータの設定
    $params = array(
          "q"=>"犬 filter:images since:2015-12-16 until:2015-12-17", //検索キーワード
          "lang"=>"ja", //言語コード
          "count"=>2, //取得件数（100件が上限）
          "include_entities"=>true, //trueにすると添付URLについての情報を追加で取得できる
          "result_type"=>"recent" //新着順に取得
    );
    //$next_resultsの初期化
    $next_results = null;
    //リクエスト回数
    $request_number = 2;

    for ($i = 0; $i < $request_number; $i++){

        //検索結果の取得($objはJSONの検索結果が入る）
        $tweets_obj = $connection->OAuthRequest(
                                            'https://api.twitter.com/1.1/search/tweets.json',
                                            'GET',
                                            $params
        );

        if($tweets_obj){
            //検索結果をjson_decodeで連想配列にしてforeach
            $tweets_arr = json_decode($tweets_obj, true);
            //画像のURLを取得
            foreach($tweets_arr['statuses'] as $statuses){
                if(isset($statuses['entities']['media'][0]['media_url'])){
                    $img = $statuses['entities']['media'][0]['media_url'];
                    //投稿日を取得
                    $year = substr($tweets_arr['statuses'][0]['created_at'], 26, 4);
                    $month = substr($tweets_arr['statuses'][0]['created_at'], 4, 3);
                    $day = substr($tweets_arr['statuses'][0]['created_at'], 8, 2);
                    $date = date('Y-m-d', strtotime($year . '-' . $month . '-' . $day));
                    //DBに画像のURLと投稿日を取得
                    $result = insert_photo($img, $date, 1);
                }
            }
        }

        //先頭の「?」を除去
        $next_results = preg_replace('/^\?/', '', $tweets_arr['search_metadata']['next_results']);

        //next_resultsが無ければ処理を終了
        if(empty($next_results)){
            break;
        }

        //パラメータに変換
        parse_str($next_results, $params);
    }
    echo '画像のURLを取得しました。';
    ?>
  </body>
</html>
