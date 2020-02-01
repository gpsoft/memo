<?php

if(isset($_REQUEST['id'])){
    $id = $_REQUEST['id'];
}
require_once ('config.php');
$sql = 'SELECT id, title, content FROM notes 
        WHERE id = :id ';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$notes = $stmt->fetch(PDO::FETCH_ASSOC);
    

$pdo = null;
$stmt = null;

$message = 'Memo Update';
    


require_once 'views/edit.tpl.php';

    