<!DOCTYPE html>
<html lang='ja'>
<?php include('header.inc.php') ?>

<body>
    <!-- <?php var_dump($_REQUEST); ?>
    <br>
    <?php var_dump($error); ?>
    <br>
    <?php var_dump($notes); ?> -->
    <h2><?=$message ; ?></h2>
    <p></p>
    <form action='update.php' method='post'>
        <input type='hidden' name='id' value="<?php echo $notes['id'];?>">
        <label for='title'>タイトル</label><br>
        <input type='text' name='title' value="<?php echo $notes['title']; ?>">
        <br>
        <?php if($error['title'] == 'brank'): ?>
        <?php echo "タイトルを入力してください"; ?>
        <?php endif ?>
        <br>
        <?php if($error['title'] == 'length'): ?>
        <?php echo "タイトルは２５５文字以内で入力してください"; ?>
        <?php endif ?>
        <p></p>
        <label>テキスト</label><br>
        <textarea name='content' cols='40' rows='10'><?php echo $notes['content']; ?></textarea>
        <br>
        <?php if($error['content'] == 'brank'): ?>
        <?php echo "テキストを入力してください"; ?>
        <?php endif ?>
        <p></p>
        <button type='submit' name='submit' value='submit'>変更する</button>

    <!-- <?php print_r($notes); ?> -->
    <p><a href='index.php'> 一覧に戻る</a></p>

<?php include('footer.inc.php') ?>
</body>

</html>