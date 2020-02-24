<!DOCTYPE html>
<html lang="ja">
<?php include('header.inc.php') ?>

<body>
    <h2><?= h($message); ?></h2>
    <p></p>
    <p>No.<?= $note['id']; ?></p>
    <p>タイトル：<?php echo h($note['title']); ?></p>
    <p>内容：<br><?php echo hbr($note['content']); ?></p>

    <p><a href="index.php">一覧に戻る</a> | <a href="edit.php?id=<?=$id ?>">編集</a> | <a href="delete.php?id=<?=$id ?>" name="submit" value="submit">削除</a></p>

<?php include('footer.inc.php') ?>
</body>
</html>
