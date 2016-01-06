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

//画像のURLをDBに取得する関数
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

//画像認識の結果をDBに取得する関数
function insert_recognition($result1, $result2, $result3, $result4, $result5,
            $result6, $result7, $result8, $result9, $result10,
            $result11, $result12, $result13, $result14, $result15,
            $result16, $result17, $result18, $result19, $result20, $snsID, $photoID){

    $insert_db = connect_MySQL();
    $insert_sql = "INSERT INTO recognition(result1,result2,result3,
            result4,result5,result6,result7,result8,result9,result10,
            result11,result12,result13,result14,result15,
            result16,result17,result18,result19,result20,snsID,photoID)"
            . "VALUES(:result1,:result2,:result3,:result4,:result5,
            :result6,:result7,:result8,:result9,:result10,
            :result11,:result12,:result13,:result14,:result15,
            :result16,:result17,:result18,:result19,:result20,:snsID,:photoID)";
    $insert_query = $insert_db->prepare($insert_sql);

    $insert_query->bindValue(':result1',$result1);
    $insert_query->bindValue(':result2',$result2);
    $insert_query->bindValue(':result3',$result3);
    $insert_query->bindValue(':result4',$result4);
    $insert_query->bindValue(':result5',$result5);
    $insert_query->bindValue(':result6',$result6);
    $insert_query->bindValue(':result7',$result7);
    $insert_query->bindValue(':result8',$result8);
    $insert_query->bindValue(':result9',$result9);
    $insert_query->bindValue(':result10',$result10);
    $insert_query->bindValue(':result11',$result11);
    $insert_query->bindValue(':result12',$result12);
    $insert_query->bindValue(':result13',$result13);
    $insert_query->bindValue(':result14',$result14);
    $insert_query->bindValue(':result15',$result15);
    $insert_query->bindValue(':result16',$result16);
    $insert_query->bindValue(':result17',$result17);
    $insert_query->bindValue(':result18',$result18);
    $insert_query->bindValue(':result19',$result19);
    $insert_query->bindValue(':result20',$result20);
    $insert_query->bindValue(':snsID',$snsID);
    $insert_query->bindValue(':photoID',$photoID);

    try{
        $insert_query->execute();
    } catch (PDOException $e) {
        $insert_db=null;
        return $e->getMessage();
    }

    $insert_db=null;
    return null;
}

//リストをDBに追加する関数
function insert_list($listName, $listKind, $listCategory){

    $insert_db = connect_MySQL();
    $insert_sql = "INSERT INTO list(listName,listKind,listCategory)"
                      . "VALUES(:listName,:listKind,:listCategory)";
    $insert_query = $insert_db->prepare($insert_sql);

    $insert_query->bindValue(':listName',$listName);
    $insert_query->bindValue(':listKind',$listKind);
    $insert_query->bindValue(':listCategory',$listCategory);

    try{
        $insert_query->execute();
    } catch (PDOException $e) {
        $insert_db=null;
        return $e->getMessage();
    }

    $insert_db=null;
    return null;
}

//認識結果1を種類名に変換してDBに追加する関数
function insert_calc($calcKind, $calcCategory, $snsID, $photoID){

    $insert_db = connect_MySQL();
    $insert_sql = "INSERT INTO calc(calcKind,calcCategory,snsID,photoID)"
                      . "VALUES(:calcKind,:calcCategory,:snsID,:photoID)";
    $insert_query = $insert_db->prepare($insert_sql);

    $insert_query->bindValue(':calcKind',$calcKind);
    $insert_query->bindValue(':calcCategory',$calcCategory);
    $insert_query->bindValue(':snsID',$snsID);
    $insert_query->bindValue(':photoID',$photoID);

    try{
        $insert_query->execute();
    } catch (PDOException $e) {
        $insert_db=null;
        return $e->getMessage();
    }

    $insert_db=null;
    return null;
}

//カテゴリーの集計結果をDBに追加する関数
function insert_category($categoryName, $categoryPercentage, $snsID){

    $insert_db = connect_MySQL();
    $insert_sql = "INSERT INTO category(categoryName,categoryPercentage,snsID)"
                      . "VALUES(:categoryName,:categoryPercentage,:snsID)";
    $insert_query = $insert_db->prepare($insert_sql);

    $insert_query->bindValue(':categoryName',$categoryName);
    $insert_query->bindValue(':categoryPercentage',$categoryPercentage);
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

//種類の集計結果をDBに追加する関数
function insert_kind($kindName, $kindPercentage, $snsID, $categoryID){

    $insert_db = connect_MySQL();
    $insert_sql = "INSERT INTO kind(kindName,kindPercentage,snsID,categoryID)"
                      . "VALUES(:kindName,:kindPercentage,:snsID,:categoryID)";
    $insert_query = $insert_db->prepare($insert_sql);

    $insert_query->bindValue(':kindName',$kindName);
    $insert_query->bindValue(':kindPercentage',$kindPercentage);
    $insert_query->bindValue(':snsID',$snsID);
    $insert_query->bindValue(':categoryID',$categoryID);

    try{
        $insert_query->execute();
    } catch (PDOException $e) {
        $insert_db=null;
        return $e->getMessage();
    }

    $insert_db=null;
    return null;
}

//画像のURLを表示する関数
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

    return $select_query->fetchAll(PDO::FETCH_ASSOC);
}

//リストを表示する関数
function select_list(){

    $select_db = connect_MySQL();
    $select_sql = "SELECT * FROM list";
    $select_query = $select_db->prepare($select_sql);

    try{
        $select_query->execute();
    } catch (PDOException $e) {
        $select_query=null;
        return $e->getMessage();
    }

    return $select_query->fetchAll(PDO::FETCH_ASSOC);
}

//認識結果1を変換した種類名、カテゴリー名を表示する関数
function select_calc(){

    $select_db = connect_MySQL();
    $select_sql = "SELECT * FROM calc";
    $select_query = $select_db->prepare($select_sql);

    try{
        $select_query->execute();
    } catch (PDOException $e) {
        $select_query=null;
        return $e->getMessage();
    }

    return $select_query->fetchAll(PDO::FETCH_ASSOC);
}

//カテゴリーの集計結果を表示する関数
function select_category(){

    $select_db = connect_MySQL();
    $select_sql = "SELECT * FROM category";
    $select_query = $select_db->prepare($select_sql);

    try{
        $select_query->execute();
    } catch (PDOException $e) {
        $select_query=null;
        return $e->getMessage();
    }

    return $select_query->fetchAll(PDO::FETCH_ASSOC);
}

//種類の集計結果を表示する関数
function select_kind(){

    $select_db = connect_MySQL();
    $select_sql = "SELECT * FROM kind";
    $select_query = $select_db->prepare($select_sql);

    try{
        $select_query->execute();
    } catch (PDOException $e) {
        $select_query=null;
        return $e->getMessage();
    }

    return $select_query->fetchAll(PDO::FETCH_ASSOC);
}

//画像認識の結果を重複を除いて表示する関数
function group_by_recognition(){

    $select_db = connect_MySQL();
    $select_sql = "SELECT * FROM recognition GROUP BY result1";
    $select_query = $select_db->prepare($select_sql);

    try{
        $select_query->execute();
    } catch (PDOException $e) {
        $select_query=null;
        return $e->getMessage();
    }

    return $select_query->fetchAll(PDO::FETCH_ASSOC);
}

//カテゴリーごとの件数を取得する関数
function category_calc($snsID){

    $select_db = connect_MySQL();
    $select_sql = "SELECT calcCategory, count(calcCategory), snsID FROM calc";
    //snsIDを指定した場合、SQL文に追加
    if($snsID != 0){
        $select_sql .= " WHERE snsID=:snsID";
    }
    $select_sql .= " GROUP BY calcCategory";
    $select_query = $select_db->prepare($select_sql);

    $select_query->bindValue(':snsID',$snsID);

    try{
        $select_query->execute();
    } catch (PDOException $e) {
        $select_query=null;
        return $e->getMessage();
    }

    return $select_query->fetchAll(PDO::FETCH_ASSOC);
}

//レコード件数を取得する関数
function count_all_calc($snsID){

    $select_db = connect_MySQL();
    $select_sql = "SELECT count(*) FROM calc";
    //snsIDを指定した場合、SQL文に追加
    if($snsID != 0){
        $select_sql .= " WHERE snsID=:snsID";
    }
    $select_query = $select_db->prepare($select_sql);

    $select_query->bindValue(':snsID',$snsID);

    try{
        $select_query->execute();
    } catch (PDOException $e) {
        $select_query=null;
        return $e->getMessage();
    }

    return $select_query->fetchAll(PDO::FETCH_ASSOC);
}

//種類ごとの件数を取得する関数
function kind_calc($snsID, $calcCategory){

    $select_db = connect_MySQL();
    $select_sql = "SELECT calcKind, count(calcKind), snsID, calcCategory FROM calc WHERE calcCategory=:calcCategory";
    //snsIDを指定した場合、SQL文に追加
    if($snsID != 0){
        $select_sql .= " AND snsID=:snsID";
    }
    $select_sql .= " GROUP BY calcKind";
    $select_query = $select_db->prepare($select_sql);

    if($snsID != 0){
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

//カテゴリーごとのレコード件数を取得する関数
function count_category_calc($snsID, $calcCategory){

    $select_db = connect_MySQL();
    $select_sql = "SELECT count(*) FROM calc WHERE calcCategory=:calcCategory";
    //snsIDを指定した場合、SQL文に追加
    if($snsID != 0){
        $select_sql .= " AND snsID=:snsID";
    }
    $select_sql .= " GROUP BY calcCategory";
    $select_query = $select_db->prepare($select_sql);

    if($snsID != 0){
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

//画像のURLを削除する関数
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

//画像認識の結果を削除する関数
function delete_recognition($recognitionID){

    $delete_db = connect_MySQL();
    $delete_sql = "DELETE FROM recognition WHERE recognitionID=:recognitionID";
    $delete_query = $delete_db->prepare($delete_sql);

    $delete_query->bindValue(':recognitionID',$recognitionID);

    try{
        $delete_query->execute();
    } catch (PDOException $e) {
        $delete_query=null;
        return $e->getMessage();
    }
    return null;
}

//リストを削除する関数
function delete_list($listID){

    $delete_db = connect_MySQL();
    $delete_sql = "DELETE FROM list WHERE listID=:listID";
    $delete_query = $delete_db->prepare($delete_sql);

    $delete_query->bindValue(':listID',$listID);

    try{
        $delete_query->execute();
    } catch (PDOException $e) {
        $delete_query=null;
        return $e->getMessage();
    }
    return null;
}

//認識結果1を変換した種類名、カテゴリー名を削除する関数
function delete_calc($calcID){

    $delete_db = connect_MySQL();
    $delete_sql = "DELETE FROM calc WHERE calcID=:calcID";
    $delete_query = $delete_db->prepare($delete_sql);

    $delete_query->bindValue(':calcID',$calcID);

    try{
        $delete_query->execute();
    } catch (PDOException $e) {
        $delete_query=null;
        return $e->getMessage();
    }
    return null;
}

//カテゴリーの集計結果を削除する関数
function delete_category($categoryID){

    $delete_db = connect_MySQL();
    $delete_sql = "DELETE FROM category WHERE categoryID=:categoryID";
    $delete_query = $delete_db->prepare($delete_sql);

    $delete_query->bindValue(':categoryID',$categoryID);

    try{
        $delete_query->execute();
    } catch (PDOException $e) {
        $delete_query=null;
        return $e->getMessage();
    }
    return null;
}

//種類の集計結果を削除する関数
function delete_kind($kindID){

    $delete_db = connect_MySQL();
    $delete_sql = "DELETE FROM kind WHERE kindID=:kindID";
    $delete_query = $delete_db->prepare($delete_sql);

    $delete_query->bindValue(':kindID',$kindID);

    try{
        $delete_query->execute();
    } catch (PDOException $e) {
        $delete_query=null;
        return $e->getMessage();
    }
    return null;
}
