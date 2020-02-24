<?php
require_once __DIR__ . '/vendor/autoload.php';

if(isset($_REQUEST['id'])){
    $id = $_REQUEST['id'];
    logD($id, 'id');
}else{
    //formタグを使っていないからurlに直接delete入力しても削除できる
    header('Location: show.php?id='.$id);
    exit();
}

$pdo = connectDB();
$sql = 'DELETE FROM notes WHERE id = :id;';
logD($sql, 'SQL');
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();

$pdo = null;
$stmt = null;

// print_r($_REQUEST);
header('Location: index.php');
