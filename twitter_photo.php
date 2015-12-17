<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
</head>
  <body>
    <?php
    //TwitterOAuthを使う
    //https://github.com/abraham/twitteroauth
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

    //検索結果の取得($stringはJSONの検索結果が入る）
    $string = $connection->OAuthRequest(
        'https://api.twitter.com/1.1/search/tweets.json',
        'GET',
        array(
              "q"=>"犬 filter:images", //検索キーワード
              "lang"=>"ja", //言語コード
              "result_type"=>"recent", //新着順に取得
              "count"=>1, //取得件数（100件が上限）
              "include_entities"=>true //trueにすると添付URLについての情報を追加で取得できる
              )
            );

    // リクエスト回数
    $request_number = 1;

    $tweet_texts = array();
    for ($i = 0; $i < $request_number; $i++) {

        if($string){
            //検索結果をjson_decodeで配列にしてforeach
            $obj = json_decode($string, true);

            $next_results = preg_replace('/^\?/', '', $obj['search_metadata']['next_results']);

            foreach ($obj['statuses'] as $statuses) {
                if(isset($statuses['entities']['media'][0]['media_url'])){
                    $img = $statuses['entities']['media'][0]['media_url'];
                    echo $img . "　";
                    echo $next_results;
                }
            }
        }
    }
    ?>
  </body>
</html>
