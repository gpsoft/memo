<!DOCTYPE html>
<html lang='ja'>
<?php include('header.inc.php') ?>

<body>
    <?php var_dump($_GET); ?>
    <?php var_dump($_GET['id']); ?>
    <h2><?=$message ; ?></h2>
    <p></p>
    <form action='update.php' method='post'>
        <input type='hidden' name='id' value="<?=$notes['id'] ?>">
        <label for='title'>タイトル</label><br>
        <input type='text' name='title' value="<?php if($_GET['request_t']){echo $_GET['request_t'];}elseif($_GET['title']!=='brank'){echo $notes['title'];} ?>">
        <br>
        <?php if($_GET['title'] && $_GET['title'] == 'brank'): ?>
        <?php echo "タイトルを入力してください"; ?>
        <?php endif ?>
        <br>
        <?php if($_GET['title'] && $_GET['title'] == 'length'): ?>
        <?php echo "タイトルは２５５文字以内で入力してください"; ?>
        <?php endif ?>
        <p></p>
        <label>テキスト</label><br>
        <textarea name='content' cols='40' rows='10'><?php if($_GET['request_c']){echo $_GET['request_c'];}elseif($_GET['content']!=='brank'){echo $notes['content'];} ?></textarea>
        <br>
        <?php if($_GET['content'] && $_GET['content'] == 'brank'): ?>
        <?php echo "テキストを入力してください"; ?>
        <?php endif ?>
        <p></p>
        <button type='submit' name='submit' value='submit'>変更する</button>

    <!-- <?php print_r($notes); ?> -->
    <p><a href='index.php'> 一覧に戻る</a></p>

<?php include('footer.inc.php') ?>
</body>

</html>