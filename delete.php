<?php
if(isset($_REQUEST['id'])){
    $id = $_REQUEST['id'];
}

require_once ('config.php');
$sql = 'DELETE FROM notes WHERE id = :id;';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();





$pdo = null;
$stmt = null;    

// print_r($_REQUEST);
header('Location: index.php');


    