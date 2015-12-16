<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
</head>
  <body>
    <?php
    //TwitterOAuthを使う
    //https://github.com/abraham/twitteroauth

    require_once "twitteroauth/autoload.php";
    use Abraham\TwitterOAuth\TwitterOAuth;

    //設定
    $consumerKey = "consumerKey";
    $consumerSecret = "consumerSecret";
    $accessToken = "accessToken";
    $accessTokenSecret = "accessTokenSecret";


    //認証
    $connection = new TwitterOAuth($consumerKey,$consumerSecret,$accessToken,$accessTokenSecret);

    //検索結果の取得($stringはJSONの検索結果が入る）
    $string = $connection->OAuthRequest(
        'https://api.twitter.com/1.1/search/tweets.json',
        'GET',
        array(
                "q"=>"filter:images", //検索キーワード
                "lang"=>"ja", //言語コード
                "result_type"=>"recent", //新着順に取得
                "count"=>20, //取得件数（100件が上限）
                "include_entities"=>true //trueにすると添付URLについての情報を追加で取得できる
            )
        );

    if($string){
        //検索結果をjson_decodeで配列にしてforeach
        $obj = json_decode($string);

        foreach ($obj->statuses as $statuses) {
            if(isset($statuses->entities->media[0]->media_url)){
                $img = $statuses->entities->media[0]->media_url;
                echo $img . "<br>";
            }
        }
    }
    ?>
  </body>
</html>
