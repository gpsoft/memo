<!DOCTYPE html>
<html lang='ja'>
<?php include('header.inc.php') ?>

<body>
    <h2><?=$message ; ?></h2>
    <p></p>
    <form action='create.php' method='post'>
        <input type='hidden' name='id' value="<?php echo $notes['id'] ?>" >
        <label for='title'>タイトル</label><br>
        <input type='text' name='title'>
        <p></p>
        <label>テキスト</label><br>
        <textarea name='content' cols='40' rows='10'></textarea>
        <p></p>
        <button type='submit' name='submit' value='submit'>作成する</button>

    
    <p><a href='index.php'> 一覧に戻る</a></p>

<?php include('footer.inc.php') ?>
</body>

</html>