<?php
require_once __DIR__ . '/vendor/autoload.php';

//new.phpからpostされてくる
if(!empty($_REQUEST)){
    logD($_REQUEST, '$_REQUEST');
    if(is_int($_REQUEST['id'])){
        header('Location: index.php');
        exit();
    }
    if($_REQUEST['title'] == ''){
        $error['title'] = 'blank';
    }
    if(mb_strlen($_REQUEST['title']) > 255){
        $error['title'] = 'length';
    }
    if($_REQUEST['content'] == ''){
        $error['content'] = 'blank';
    }
    $note['submit'] = $_REQUEST['submit'];
    $note['title'] = $_REQUEST['title'];
    $note['content'] = $_REQUEST['content'];

}
if(!empty($error)){
    logD($error, 'error');
    require_once 'views/new.tpl.php';
    exit();
}
if(isset($note['submit'])){
    $title = $note['title'];
    $content = $note['content'];

}else{
    header('Location: index.php');
    exit();
}

$pdo = connectDB();

//postされてきた中身をDBに挿入する
//idはAIに設定してあれば自動採番するのでここでidを指定する必要はない。
$sql = 'INSERT INTO notes (title, content) VALUES (:title, :content)' ;
logD($sql, 'SQL');
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':title', $title, PDO::PARAM_STR);
$stmt->bindValue(':content', $content, PDO::PARAM_STR);
$stmt->execute();
$id = $pdo->lastInsertId();
//MySQLが決めたidの値を調べている これがないとエラーになる Locationできない

//デバッグ用に、SELECTしてみる(本来は不要)。
$sql = 'SELECT * FROM notes WHERE id = :id ';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$note = $stmt->fetch(PDO::FETCH_ASSOC);//この場合は１行しかレコードが帰ってこないのでWHEREでidを指定しておく。
//$notes = $stmt->fetchAll();//でも良い。全レコードを取得している。show.phpで表示するのは投稿したidの内容になるのは$idを指定したからのはず。
//print_r($notes);
//header()する前にprint_rはだめ。headerはHTTPレスポンスのヘッダ部、print_rはボディ部になるから。
//ヘッダ部→ボディ部　の順番に出力する必要がある。
logD($note);

$pdo = null;
$stmt = null;

logD('Redirecting to: show.php?id='.$id);
header('Location: show.php?id='.$id);

