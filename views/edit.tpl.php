<!DOCTYPE html>
<html lang='ja'>
<?php include('header.inc.php') ?>

<body>
    <h2><?=$message ; ?></h2>
    <p></p>
    <form action='update.php' method='post'>
        <input type='hidden' name='id' value="<?=$notes['id'] ?>">
        <label for='title'>タイトル</label><br>
        <input type='text' name='title' value="<?= $notes['title'] ?>">
        <p></p>
        <label>テキスト</label><br>
        <textarea name='content' cols='40' rows='10'><?= $notes['content'] ?></textarea>
        <p></p>
        <button type='submit' name='submit' value='submit'>変更する</button>

    <!-- <?php print_r($notes); ?> -->
    <p><a href='index.php'> 一覧に戻る</a></p>

<?php include('footer.inc.php') ?>
</body>

</html>