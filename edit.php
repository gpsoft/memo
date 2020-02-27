<?php
require_once __DIR__ . '/vendor/autoload.php';

if(isset($_REQUEST['id'])){
    $id = $_REQUEST['id'];
}else{
    //echo "不正なアクセスです";
    header('Location: index.php');
    exit();
}

$pdo = connectDB();
$sql = 'SELECT id, title, content FROM notes WHERE id = :id ';
logD($sql, 'SQL');
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$note = $stmt->fetch(PDO::FETCH_ASSOC);
logD($note);
$pdo = null;
$stmt = null;

// editページ
// input: $message, $note, $error
$message = 'Memo Update';
require_once 'views/edit.tpl.php';
