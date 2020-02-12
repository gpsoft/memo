<!DOCTYPE html>
<html lang='ja'>
<?php include('header.inc.php') ?>

<body>
    <h2><?=$message ; ?></h2>
    <p></p>
   
    <?php foreach($notes as $note){ ?>
        <p><a href="show.php?id=<?=$note['id'] ?>"><?= h($note['title'])."\n<br>"; ?></a></p>
    <?php } ?>
    
    <p><a href='new.php'> 新規メモ</a></p>

<?php include('footer.inc.php') ?>
</body>

</html>