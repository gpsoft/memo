<!DOCTYPE html>
<html lang="ja">
<?php include('header.inc.php') ?>

<body>
    <h2><?= $message; ?></h2>
    <p></p>
    <tr>
        <td>タイトル：<?= $title; ?></td><br>
        <td>内容：<?= $content; ?></td><br>
    </tr>

    <p><a href="index.php">一覧に戻る</a> | <a href="edit.php?id=<?= $id ?>">編集 |</a> 削除</p>

<?php include('footer.inc.php') ?>
</body>
</html>
