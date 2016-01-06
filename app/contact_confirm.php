<?php
require_once '../common/defineUtil.php';
require_once '../common/scriptUtil.php';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>SNS Photos</title>
</head>
  <body>
    <h1><a href="<?php echo ROOT_URL; ?>">SNS Photos</a></h1>
    <h4>SNSに投稿されている画像の傾向分析サイト</h4><br>

    <?php
    //URLで直接アクセスした場合のエラー処理
    if(empty($_POST['mode'])){
        echo 'アクセスルートが不正です。最初からやり直してください。<br>';
    }elseif($_POST['mode'] == 'CONFIRM'){
        session_start();
        //POSTの値をセッションに格納し、連想配列に値を格納
        $confirm_array = array(
                                'name' => confirm_session('name'),
                                'mail_address' => confirm_session('mail_address'),
                                'contact_kind' => confirm_session('contact_kind'),
                                'contact_contents' => confirm_session('contact_contents'));

        //未入力項目がある場合非表示
        if(!in_array(null,$confirm_array, true)){
            ?>
            <h3>確認画面</h3><br>
            <?php
            echo 'お名前：' . $confirm_array['name'] . "<br>";
            echo 'メールアドレス：' . $confirm_array['mail_address'] . "<br>";
            echo 'お問い合わせの種類：' . $confirm_array['contact_kind'] . "<br>";
            echo 'お問い合わせ内容：' . $confirm_array['contact_contents'] . "<br>" . "<br>";
            echo '上記の内容で送信します。よろしいですか？' . "<br>" . "<br>";
            ?>
            <form action="<?php echo CONTACT_RESULT; ?>" method="POST">
              <!--アクセスルートの確認用-->
              <input type="hidden" name="mode" value="RESULT">
              <input type="submit" name="yes" style="width:110px" value="送信する"><br>
            </form>
            <?php
        }else{
            ?>
            <h3>入力項目が不完全です。<br>
            再度入力を行ってください。</h3>
            不完全な項目<br><br>
            <?php
            //不完全な項目の表示
            foreach($confirm_array as $key => $value){
                if($value == null){
                    if($key == 'name'){
                        echo '・名前<br>';
                    }
                    if($key == 'mail_address'){
                        echo '・メールアドレス<br>';
                    }
                    if($key == 'contact_kind'){
                        echo '・お問い合わせの種類<br>';
                    }
                    if($key == 'contact_contents'){
                        echo '・お問い合わせ内容<br>';
                    }
                }
            }
        }
    }
    ?>
    <form action="<?php echo CONTACT; ?>" method="POST">
      <!--再入力時用-->
      <input type="hidden" name="mode" value="REINPUT">
      <input type="submit" name="no" style="width:110px" value="入力画面に戻る"><br>
    </form>

    <?php echo return_top(); ?><br>
    <a href="<?php echo CONTACT; ?>">お問い合わせ</a>
  </body>
</html>
