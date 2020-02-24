<!DOCTYPE html>
<html lang="ja">
<?php include('header.inc.php') ?>

<body>
    <h2><?= h($message); ?></h2>
    <p></p>

    <?php foreach($notes as $note){ ?>
        <p><a href="show.php?id=<?= $note['id']; ?>"><?php echo h($note['title']); ?><br></a></p>
    <?php } ?>

    <p><a href="new.php">新規メモ</a></p>

<?php include('footer.inc.php') ?>
</body>
</html>
