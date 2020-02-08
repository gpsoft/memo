<?php
require_once __DIR__ . '/vendor/autoload.php';


use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$logger = new Logger('notes');
$logger->pushHandler(new StreamHandler(__DIR__ . '/log/debug.log', Logger::DEBUG));

//$logger->pushHandler(new MemoryUsageProcessor);
$logger->debug('デバッグ　メッセージ　');
$logger->debug(__DIR__);
$logger->warning('警告レベル　　の　メッセージ　　　');
$logger->error('EROORです　');



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

    