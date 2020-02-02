<?php
if(isset($_REQUEST['id'])){
    $id = $_REQUEST['id'];
}
//$_REQUEST $_POST, $_GET, $_COOKIEをまとめた連想配列。いつこれを使うべきなのか？

require_once ('config.php');
$sql = 'SELECT id, title, content FROM notes WHERE id = :id;';
//表示したいカラムを指定　条件は入力されたid :idはプレースホルダ　?を使う場合もある。
//SQLインジェクションへの対応のためのプリペアードステートメント利用。
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();//更新処理。 INSERT, UPDATE, DELETE文利用もしくはプリペアードステートメント使用時
$notes = $stmt->fetch(PDO::FETCH_ASSOC);//指定した１行のレコードのみ表示したい
    


$pdo = null;
$stmt = null;

$message = 'メモ詳細';
    


require_once 'views/show.tpl.php';

    