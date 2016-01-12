<?php require_once '../common/api_dbaccesUtil.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
</head>
  <body>
    <?php
    //list_insert.phpに空欄がないことを確認する
    $db = true; //trueの場合：DBに追加

    //変換する範囲のrecognitionIDを入力
    $first = 1;
    $last = 10;

    //recognitionIDと配列番号を同じにする処理
    $first_array = $first - 1;
    $last_array = $last - 1;

    //画像認識の結果を取得
    $select_recognition = select_all('recognition');
    //リストの取得
    $select_list = select_all('list');

    //リストを利用して認識結果1を種類名、カテゴリー名に変換し、DBに追加
    if($db == true){
        for($i = $first_array; $i <= $last_array; $i++){
            foreach($select_list as $value_list){
                if($select_recognition[$i]['result1'] == $value_list['listName']){
                    $result = insert_calc($value_list['listKind'], $value_list['listCategory'], $select_recognition[$i]['snsID'], $select_recognition[$i]['photoID']);
                }
                //エラーが発生しなければ表示
                if(!isset($result) && $select_recognition[$i]['result1'] == $value_list['listName']){
                    echo 'recognitionID=' . $select_recognition[$i]['recognitionID'] . 'をDBに追加しました。<br> . <br>';
                }
            }
        }
    }
    ?>
  </body>
</html>
