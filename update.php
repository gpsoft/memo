<?php
require_once __DIR__ . '/vendor/autoload.php';

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
    $notes['submit'] = $_REQUEST['submit'];
    $notes['id'] = $_REQUEST['id'];
    $notes['title'] = $_REQUEST['title'];
    $notes['content'] = $_REQUEST['content'];
}
if(!empty($error)){
    logD($error, 'error');
    require_once 'views/edit.tpl.php';
    exit();
}
if(isset($_REQUEST['submit'])){
    $id =$_REQUEST['id'];
    $title = $_REQUEST['title'];
    $content = $_REQUEST['content'];
}else{
    //$idに数値以外の文字列が入っても表示されてしまいリダイレクトしない。
    header('Location: show.php?id='.$id);
    exit();
}

$pdo = connectDB();

$sql = 'UPDATE notes SET title = :title, content =:content WHERE id = :id' ;
logD($sql, 'SQL');
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->bindValue(':title', $title, PDO::PARAM_STR);
$stmt->bindValue(':content', $content, PDO::PARAM_STR);
$stmt->execute();

//デバッグ用に、SELECTしてみる(本来は不要)。
$sql = 'SELECT * FROM notes';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$notes = $stmt->fetch(PDO::FETCH_ASSOC);
logD($note);

$pdo = null;
$stmt = null;

logD('Redirecting to: show.php?id='.$id);
header('Location: show.php?id='.$id);

