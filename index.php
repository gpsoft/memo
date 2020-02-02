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




require_once ('config.php');
$sql = 'SELECT * FROM notes';//一覧表示したいので全部取得
$stmt = $pdo->prepare($sql);
$stmt->execute();
$notes = [];//空の配列の準備　必要ある？
while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    $notes[] = $row;
}
//fetchは１行しか取得しない　引数で取得方法を指定（今回は連想配列）
$pdo = null;
$stmt = null;
$message = 'メモ一覧';
    


require_once 'views/index.tpl.php';