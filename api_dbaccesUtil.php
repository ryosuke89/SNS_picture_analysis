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

//種類の確認用に画像認識の結果を取得する関数
function insert_kind_s($kind_s, $category_s){

    $sample_db = connect_MySQL();
    $sample_sql = "INSERT INTO recognition(kind_s, category_s)"
                      . "VALUES(:kind_s,:category_s)";
    $sample_query = $sample_db->prepare($sample_sql);

    $sample_query->bindValue(':kind_s',$kind_s);
    $sample_query->bindValue(':category_s',$category_s);

    try{
        $sample_query->execute();
    } catch (PDOException $e) {
        $sample_db=null;
        return $e->getMessage();
    }

    $sample_db=null;
    return null;
}

//画像認識の結果を取得する関数
function insert_recognition($result1, $result2, $result3, $result4, $result5,
            $result6, $result7, $result8, $result9, $result10,
            $result11, $result12, $result13, $result14, $result15,
            $result16, $result17, $result18, $result19, $result20, $snsID, $photoID){

    $insert_recognition_db = connect_MySQL();
    $insert_recognition_sql = "INSERT INTO recognition(result1,result2,result3,
            result4,result5,result6,result7,result8,result9,result10,
            result11,result12,result13,result14,result15,
            result16,result17,result18,result19,result20,snsID,photoID)"
            . "VALUES(:result1,:result2,:result3,:result4,:result5,
            :result6,:result7,:result8,:result9,:result10,
            :result11,:result12,:result13,:result14,:result15,
            :result16,:result17,:result18,:result19,:result20,:snsID,:photoID)";
    $insert_recognition_query = $insert_recognition_db->prepare($insert_recognition_sql);

    $insert_recognition_query->bindValue(':result1',$result1);
    $insert_recognition_query->bindValue(':result2',$result2);
    $insert_recognition_query->bindValue(':result3',$result3);
    $insert_recognition_query->bindValue(':result4',$result4);
    $insert_recognition_query->bindValue(':result5',$result5);
    $insert_recognition_query->bindValue(':result6',$result6);
    $insert_recognition_query->bindValue(':result7',$result7);
    $insert_recognition_query->bindValue(':result8',$result8);
    $insert_recognition_query->bindValue(':result9',$result9);
    $insert_recognition_query->bindValue(':result10',$result10);
    $insert_recognition_query->bindValue(':result11',$result11);
    $insert_recognition_query->bindValue(':result12',$result12);
    $insert_recognition_query->bindValue(':result13',$result13);
    $insert_recognition_query->bindValue(':result14',$result14);
    $insert_recognition_query->bindValue(':result15',$result15);
    $insert_recognition_query->bindValue(':result16',$result16);
    $insert_recognition_query->bindValue(':result17',$result17);
    $insert_recognition_query->bindValue(':result18',$result18);
    $insert_recognition_query->bindValue(':result19',$result19);
    $insert_recognition_query->bindValue(':result20',$result20);
    $insert_recognition_query->bindValue(':snsID',$snsID);
    $insert_recognition_query->bindValue(':photoID',$photoID);

    try{
        $insert_recognition_query->execute();
    } catch (PDOException $e) {
        $insert_recognition_db=null;
        return $e->getMessage();
    }

    $insert_recognition_db=null;
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

//画像認識の結果を表示する関数
function select_recognition(){

    $select_db = connect_MySQL();
    $select_sql = "SELECT * FROM recognition";
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

//不要な画像のURLと投稿日時を削除する関数
function delete_photo($photoID){

    $delete_db = connect_MySQL();
    $delete_sql = "DELETE FROM photo WHERE photoID=:photoID";
    $delete_query = $delete_db->prepare($delete_sql);

    $delete_query->bindValue(':photoID',$photoID);

    try{
        $delete_query->execute();
    } catch (PDOException $e) {
        $delete_query=null;
        return $e->getMessage();
    }
    return null;
}
