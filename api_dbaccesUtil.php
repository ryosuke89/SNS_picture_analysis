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

//画像のURLと投稿日時をDBに取得する関数
function insert_photo($photoURL, $postedDatetime, $snsID){

    $insert_db = connect_MySQL();

    $insert_sql = "INSERT INTO photo(photoURL,postedDatetime,snsID)"
            . "VALUES(:photoURL,:postedDatetime,:snsID)";

    $insert_query = $insert_db->prepare($insert_sql);

    $insert_query->bindValue(':photoURL',$photoURL);
    $insert_query->bindValue(':postedDatetime',$postedDatetime);
    $insert_query->bindValue(':snsID',$snsID);

    try{
        $insert_query->execute();
    } catch (PDOException $e) {
        $insert_db=null;
        return $e->getMessage();
    }

    $insert_db=null;
    return null;
}

//画像のURLと投稿日時を表示する関数
function select_photo(){

    $select_db = connect_MySQL();
    $select_sql = "SELECT * FROM photo";
    $select_query = $select_db->prepare($select_sql);

    try{
        $select_query->execute();
    } catch (PDOException $e) {
        $select_query=null;
        return $e->getMessage();
    }

    //該当するレコードを連想配列として返却
    return $select_query->fetchAll(PDO::FETCH_ASSOC);
}
