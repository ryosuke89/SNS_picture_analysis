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
    require_once "twitteroauth/autoload.php";
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
          "q"=>"filter:images", //検索キーワード
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
            //画像のURLを表示
            foreach($tweets_arr['statuses'] as $statuses){
                if(isset($statuses['entities']['media'][0]['media_url'])){
                    $img = $statuses['entities']['media'][0]['media_url'];
                    echo $img . "<br>";
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
    ?>
  </body>
</html>
