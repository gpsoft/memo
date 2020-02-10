<?php
//new.phpからpostされてくる
$message = '作成が完了しました！';
if(isset($_REQUEST['submit'])){
    $id =$_REQUEST['id'];
    $title = $_REQUEST['title'];
    $content = $_REQUEST['content'];
}else{
    header('Location: index.php');
    exit();
}
require_once ('config.php');
//postされてきた中身をDBに挿入する
//idはAIに設定してあれば自動採番するのでここでidを指定する必要はない。
$sql = 'INSERT INTO notes (title, content) VALUES (:title, :content)' ;
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':title', $title, PDO::PARAM_STR);
$stmt->bindValue(':content', $content, PDO::PARAM_STR);
$stmt->execute();
$id = $pdo->lastInsertId();
//MySQLが決めたidの値を調べている これがないとエラーになる Locationできない


$sql = 'SELECT * FROM notes WHERE id = :id ';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();

$notes = $stmt->fetch(PDO::FETCH_ASSOC);//この場合は１行しかレコードが帰ってこないのでWHEREでidを指定しておく。
//$notes = $stmt->fetchAll();//でも良い。全レコードを取得している。show.phpで表示するのは投稿したidの内容になるのは$idを指定したからのはず。
//print_r($notes);
//header()する前にprint_rはだめ。headerはHTTPレスポンスのヘッダ部、print_rはボディ部になるから。
//ヘッダ部→ボディ部　の順番に出力する必要がある。

$pdo = null;
$stmt = null;

//require_once('views/create.tpl.php');
header('Location: show.php?id='.$id);