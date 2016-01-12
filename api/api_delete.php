<?php require_once '../common/api_dbaccesUtil.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
</head>
  <body>
    <?php
    //削除するテーブルの確認
    $photo = false;       //trueの場合：photoテーブルを削除
    $recognition = false; //trueの場合：recognitionテーブルを削除
    $list = false;        //trueの場合：listテーブルを削除
    $calc = false;        //trueの場合：calcテーブルを削除
    $kind = false;        //trueの場合：kindテーブルを削除
    $category = false;    //trueの場合：categoryテーブルを削除(kindテーブル削除後)

    //削除する範囲のphotoIDを入力
    $first_photo = 0;
    $last_photo = 0;

    //削除する範囲のrecognitionIDを入力
    $first_recognition = 0;
    $last_recognition = 0;

    //削除する範囲のlistIDを入力
    $first_list = 0;
    $last_list = 0;

    //削除する範囲のcalcIDを入力
    $first_calc = 0;
    $last_calc = 0;

    //削除する範囲のkindIDを入力
    $first_kind = 0;
    $last_kind = 0;

    //削除する範囲のcategoryIDを入力
    $first_category = 0;
    $last_category = 0;

    //画像のURLを削除
    if($photo == true){
        for($i = $first_photo; $i <= $last_photo; $i++){
            $result_photo = delete_all('photo', $first_photo);
            $first_photo = $first_photo + 1;
        }
        if(!isset($result_photo)){
            echo '画像のURLを削除しました。<br>';
        }
    }

    //画像認識の結果を削除
    if($recognition == true){
        for($i = $first_recognition; $i <= $last_recognition; $i++){
            $result_recognition = delete_all('recognition', $first_recognition);
            $first_recognition = $first_recognition + 1;
        }
        if(!isset($result_recognition)){
            echo '画像認識の結果を削除しました。<br>';
        }
    }

    //リストの削除
    if($list == true){
        for($i = $first_list; $i <= $last_list; $i++){
            $result_list = delete_all('list', $first_list);
            $first_list = $first_list + 1;
        }
        if(!isset($result_list)){
            echo 'リストを削除しました。<br>';
        }
    }

    //認識結果1を変換した種類名、カテゴリー名の削除
    if($calc == true){
        for($i = $first_calc; $i <= $last_calc; $i++){
            $result_calc = delete_all('calc', $first_calc);
            $first_calc = $first_calc + 1;
        }
        if(!isset($result_calc)){
            echo '種類名、カテゴリー名を削除しました。<br>';
        }
    }

    //種類の集計結果を削除
    if($kind == true){
        for($i = $first_kind; $i <= $last_kind; $i++){
            $result_kind = delete_all('kind', $first_kind);
            $first_kind = $first_kind + 1;
        }
        if(!isset($result_kind)){
            echo '種類の集計結果を削除しました。<br>';
        }
    }

    //カテゴリーの集計結果を削除
    if($category == true){
        for($i = $first_category; $i <= $last_category; $i++){
            $result_category = delete_all('category', $first_category);
            $first_category = $first_category + 1;
        }
        if(!isset($result_category)){
            echo 'カテゴリーの集計結果を削除しました。';
        }
    }
    ?>
    </table>
  </body>
</html>
