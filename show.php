<?php
require_once __DIR__ . '/vendor/autoload.php';

if(isset($_REQUEST['id'])){
    $id = $_REQUEST['id'];
}else{
    //echo "不正なアクセスです";
    //$idに数値以外の文字列が入っても表示されてしまいリダイレクトしない。
    header('Location:index.php');
    exit();
}
//$_REQUEST $_POST, $_GET, $_COOKIEをまとめた連想配列。いつこれを使うべきなのか？

$pdo = connectDB();
$sql = 'SELECT id, title, content FROM notes WHERE id = :id;';
//表示したいカラムを指定　条件は入力されたid :idはプレースホルダ　?を使う場合もある。
//SQLインジェクションへの対応のためのプリペアードステートメント利用。
logD($sql, 'SQL');
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();//更新処理。 INSERT, UPDATE, DELETE文利用もしくはプリペアードステートメント使用時
$note = $stmt->fetch(PDO::FETCH_ASSOC);//指定した１行のレコードのみ表示したい
logD($note);
$pdo = null;
$stmt = null;

// showページ
// input: $message, $note
$message = 'メモ詳細';
require_once 'views/show.tpl.php';
