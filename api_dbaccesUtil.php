<?php

//DBへの接続
function connect_MySQL(){
    try{
        $pdo = new PDO('mysql:host=localhost;dbname=spa_db;charset=utf8','kato','kr890122');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die('DB接続に失敗しました。次記のエラーにより処理を中断します:'.$e->getMessage());
    }
}

//画像のURLと投稿日をDBに取得する関数
function insert_photo($photoURL, $postedDate, $snsID){

    $insert_db = connect_MySQL();

    $insert_sql = "INSERT INTO photo(photoURL,postedDate,snsID)"
            . "VALUES(:photoURL,:postedDate,:snsID)";

    $insert_query = $insert_db->prepare($insert_sql);

    $insert_query->bindValue(':photoURL',$photoURL);
    $insert_query->bindValue(':postedDate',$postedDate);
    $insert_query->bindValue(':snsID',$snsID);

    try{
        $insert_query->execute();
    } catch (PDOException $e) {
        //接続オブジェクトを初期化することでDB接続を切断
        $insert_db=null;
        return $e->getMessage();
    }

    $insert_db=null;
    return null;
}
