<?php
require_once 'config.php';
$pdo = connectDB();

// $sql = 'SELECT * FROM notes';
// $stmt = $pdo->prepare($sql);
// $stmt->execute(); 接続だけで、取得する必要はなかった?。


$pdo = null;
//$stmt = null;
$message = '新規投稿';
    

require_once 'views/new.tpl.php';
