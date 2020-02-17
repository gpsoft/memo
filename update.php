<?php
if(!empty($_REQUEST)){
    if(is_int($_REQUEST['id'])){
        header('Location: index.php');
        exit();
    }
    if($_REQUEST['title'] == ''){
        $error['title'] = 'blank';
    }
    if(strlen($_REQUEST['title']) >= 255){
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
    // header("Location: edit.php?title=".$error['title']."&content=".$error['content']."&request_t=".$_REQUEST['title']."&request_c=".$_REQUEST['content']."&id=".$_REQUEST['id']);
    // exit();
    require_once 'views/edit.tpl.php';
}
if(empty($error)){
    if(isset($_REQUEST['submit'])){
        $id =$_REQUEST['id'];
        $title = $_REQUEST['title'];
        $content = $_REQUEST['content'];
    }else{
        //$idに数値以外の文字列が入っても表示されてしまいリダイレクトしない。
        header('Location: show.php?id='.$id);
        exit();
    }

require_once ('config.php');
$pdo = connectDB();

$sql = 'UPDATE notes SET title = :title, content =:content WHERE id = :id' ;
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->bindValue(':title', $title, PDO::PARAM_STR);
$stmt->bindValue(':content', $content, PDO::PARAM_STR);
$stmt->execute();

$sql = 'SELECT * FROM notes';
$stmt = $pdo->prepare($sql);
$stmt->execute();

$notes = $stmt->fetch(PDO::FETCH_ASSOC);


$pdo = null;
$stmt = null;

//require_once('views/edit.tpl.php');

header('Location: show.php?id='.$id);
}