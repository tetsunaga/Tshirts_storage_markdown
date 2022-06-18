<?php
//1. POSTデータ取得
$name   = $_POST['name'];
$address  = $_POST['address'];
$naiyou = $_POST['naiyou'];
$size    = $_POST['size']; //追加されています

//2. DB接続します
require_once('funcs.php');
$pdo = db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare('INSERT INTO gs_an_table(name,address,size,naiyou,indate)VALUES(:name,:address,:size,:naiyou,sysdate())');
$stmt->bindValue(':name', $name, PDO::PARAM_STR);      //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':address', $address, PDO::PARAM_STR);    //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':size', $size, PDO::PARAM_INT);        //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':naiyou', $naiyou, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行

//４．データ登録処理後

if ($status == false) {
    sql_error($stmt);
} else {
    redirect('index.php');
}