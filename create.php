<?php
//new.phpからpostされてくる
if(!empty($_REQUEST)){
    if(is_int($_REQUEST['id'])){
        header('Location: index.php');
        exit();
    }
    if($_REQUEST['title'] == ''){
        $error['title'] = 'brank';
    }
    if(strlen($_REQUEST['title']) >= 255){
        $error['title'] = 'length';
    }
    if($_REQUEST['content'] == ''){
        $error['content'] = 'brank';
    }
    $notes['submit'] = $_REQUEST['submit'];
    $notes['id'] = $_REQUEST['id'];
    $notes['title'] = $_REQUEST['title'];
    $notes['content'] = $_REQUEST['content'];
    
}
if(!empty($error)){
    // header("Location: new.php?title=".$error['title']."&content=".$error['content']."&request_t=".$_REQUEST['title']."&request_c=".$_REQUEST['content']);
    // exit();
    // $_GET['id'] = $_REQUEST['id'];
    // $_GET['title'] = $_REQUEST['title'];
    // $_GET['content'] = $_REQUEST['content'];
    // $_GET['submit'] = $_REQUEST['submit'];


    require_once 'views/new.tpl.php';
}
if(empty($error)){
    if(isset($notes['submit'])){
        $id = $notes['id'];
        $title = $notes['title'];
        $content = $notes['content'];

    }else{
        header('Location: index.php');
        exit();
    }

require_once ('config.php');
$pdo = connectDB();

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
}