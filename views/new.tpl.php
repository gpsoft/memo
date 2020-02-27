<!DOCTYPE html>
<html lang="ja">
<?php include('header.inc.php') ?>

<body>
    <h2><?= h($message); ?></h2>
    <p></p>
    <form action="create.php" method="post">
        <label for="title">タイトル</label><br>
        <input type="text" name="title" value="<?= h($note['title']); ?>">
        <br>
        <?php if($error['title'] == 'blank'): ?>
        <?php echo "タイトルを入力してください"; ?>
        <?php endif ?>
        <br>
        <?php if($error['title'] == 'length'): ?>
        <?php echo "タイトルは２５５文字以内で入力してください"; ?>
        <?php endif ?>
        <p></p>
        <label>テキスト</label><br>
        <textarea name="content" cols="40" rows="10"><?= hbr($note['content']); ?></textarea>
        <br>
        <?php if($error['content'] == 'blank'): ?>
        <?php echo "テキストを入力してください"; ?>
        <?php endif ?>
        <p></p>
        <button type="submit" name="submit" value="submit">作成する</button>

    <p><a href="index.php">一覧に戻る</a></p>

<?php include('footer.inc.php') ?>
</body>
</html>
