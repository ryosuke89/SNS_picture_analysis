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

//categoryテーブルの値を割合が高い順に取得する関数
function select_all_category(){
    //dbを確立
    $select_db = connect_MySQL();
    //SQL文
    $select_sql = "SELECT * FROM category ORDER BY categoryPercentage DESC";
    //クエリとして用意
    $select_query = $select_db->prepare($select_sql);

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

//SNSの番号を指定してcategoryテーブルの値を割合が高い順に取得する関数
function select_sns_category($snsID){

    $select_db = connect_MySQL();
    $select_sql = "SELECT * FROM category WHERE snsID=:snsID ORDER BY categoryPercentage DESC";
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

//SNSの番号を指定してkindテーブルの値を割合が高い順に取得する関数
function select_sns_kind($snsID){

    $select_db = connect_MySQL();
    $select_sql = "SELECT * FROM kind WHERE snsID=:snsID ORDER BY kindPercentage DESC";
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

//カテゴリー名を指定してcategoryテーブルの値を取得する関数
function select_detail_category($categoryName){

    $select_db = connect_MySQL();
    $select_sql = "SELECT * FROM category WHERE categoryName=:categoryName";
    $select_query = $select_db->prepare($select_sql);

    $select_query->bindValue(':categoryName',$categoryName);

    try{
        $select_query->execute();
    }catch(PDOException $e){
        $select_query=null;
        return $e->getMessage();
    }

    return $select_query->fetchAll(PDO::FETCH_ASSOC);
}

//カテゴリーの番号を指定してkindテーブルの値を割合が高い順に取得する関数
function select_detail_kind($categoryID){

    $select_db = connect_MySQL();
    $select_sql = "SELECT * FROM kind WHERE categoryID=:categoryID ORDER BY kindPercentage DESC";
    $select_query = $select_db->prepare($select_sql);

    $select_query->bindValue(':categoryID',$categoryID);

    try{
        $select_query->execute();
    }catch(PDOException $e){
        $select_query=null;
        return $e->getMessage();
    }

    return $select_query->fetchAll(PDO::FETCH_ASSOC);
}

//カテゴリーごとの画像の番号を取得する関数
function photoID_calc($snsID, $calcCategory){

    $select_db = connect_MySQL();
    $select_sql = "SELECT photoID FROM calc WHERE calcCategory=:calcCategory";
    if($snsID != null){
        $select_sql .= " AND snsID=:snsID";
    }
    $select_query = $select_db->prepare($select_sql);

    if($snsID != null){
        $select_query->bindValue(':snsID',$snsID);
    }
    $select_query->bindValue(':calcCategory',$calcCategory);

    try{
        $select_query->execute();
    } catch (PDOException $e) {
        $select_query=null;
        return $e->getMessage();
    }

    return $select_query->fetchAll(PDO::FETCH_ASSOC);
}

//カテゴリーごとの画像のURLを取得する関数
function url_photo($photoID){

    $select_db = connect_MySQL();
    $select_sql = "SELECT photoURL FROM photo WHERE photoID=:photoID";
    $select_query = $select_db->prepare($select_sql);

    $select_query->bindValue(':photoID',$photoID);

    try{
        $select_query->execute();
    } catch (PDOException $e) {
        $select_query=null;
        return $e->getMessage();
    }

    return $select_query->fetchAll(PDO::FETCH_ASSOC);
}
