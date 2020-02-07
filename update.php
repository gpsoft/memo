<?php

if(isset($_REQUEST['submit'])){
    $id =htmlspecialchars($_REQUEST['id'], ENT_QUOTES, 'UTF-8');
    $title = htmlspecialchars($_REQUEST['title'], ENT_QUOTES, 'UTF-8');
    $content = htmlspecialchars($_REQUEST['content'], ENT_QUOTES, 'UTF-8');
}

require_once ('config.php');
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