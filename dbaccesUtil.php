<?php

//データベースに接続する関数
function connect_MySQL(){
    try{
        $pdo = new PDO('mysql:host=localhost;dbname=spa_db;charset=UTF8','kato','kr890122');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die('DB接続に失敗しました。次記のエラーにより処理を中断します:'.$e->getMessage());
    }
}

//categoryテーブルの値を取得する関数
function select_category($snsID){
    //dbを確立
    $select_db = connect_MySQL();
    //SQL文
    $select_sql = "SELECT * FROM category WHERE snsID=:snsID";
    //クエリとして用意
    $select_query = $select_db->prepare($select_sql);

    $select_query->bindValue(':snsID',$snsID);
    //SQLを実行
    try{
        $select_query->execute();
    }catch(PDOException $e){
        $select_query=null;
        return $e->getMessage();
    }
    //レコードを連想配列として返却
    return $select_query->fetchAll(PDO::FETCH_ASSOC);
}

//kindテーブルの値を取得する関数
function select_kind($snsID){

    $select_db = connect_MySQL();

    $select_sql = "SELECT * FROM kind WHERE snsID=:snsID";

    $select_query = $select_db->prepare($select_sql);

    $select_query->bindValue(':snsID',$snsID);

    try{
        $select_query->execute();
    }catch(PDOException $e){
        $select_query=null;
        return $e->getMessage();
    }

    return $select_query->fetchAll(PDO::FETCH_ASSOC);
}
