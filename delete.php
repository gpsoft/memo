<?php
require_once __DIR__ . '/vendor/autoload.php';

$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
if ( $id == '' ) {
    header('Location: index.php');
    exit();
}

$pdo = connectDB();
removeNote($pdo, $id);

logD('Redirecting to: index.php');
header('Location: index.php');
