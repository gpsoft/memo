<!DOCTYPE html>
<html lang='ja'>
<?php include('header.inc.php') ?>

<body>
    <!-- <?php print_r($error); ?>
    <?php print_r($_REQUEST); ?>
    <?php print_r($_GET); ?> -->
    <h2><?=$message ; ?></h2>
    <p></p>
    <form action='create.php' method='post'>
        <input type='hidden' name='id' value="<?php echo $notes['id'] ?>" >
        <label for='title'>タイトル</label><br>
        <input type='text' name='title' 
        value="<?php if($_REQUEST['title']){echo $_REQUEST['title'];} ?>">
        <br>
        <?php if($error['title'] && $error['title'] == 'brank'): ?>
        <?php echo "タイトルを入力してください"; ?>
        <?php endif ?>
        <br>
        <?php if($error['title'] && $error['title'] == 'length'): ?>
        <?php echo "タイトルは２５５文字以内で入力してください"; ?>
        <?php endif ?>
        <p></p>
        <label>テキスト</label><br>
        <textarea name='content' cols='40' rows='10'><?php if($_REQUEST['content']){echo $_REQUEST['content'];} ?></textarea>
        <br>
        <?php if($error['content'] && $error['content'] == 'brank'): ?>
        <?php echo "テキストを入力してください"; ?>
        <?php endif ?>
        <p></p>
        <button type='submit' name='submit' value='submit'>作成する</button>

    
    <p><a href='index.php'> 一覧に戻る</a></p>

<?php include('footer.inc.php') ?>
</body>

</html>