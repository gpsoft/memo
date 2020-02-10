<!DOCTYPE html>
<html lang='ja'>
<?php include('header.inc.php') ?>

<body>
    <h2><?=$message ; ?></h2>
    <p></p>
    <tr>
    <td>No.<?=$notes['id']; ?></td><br>
    <td>タイトル：<?php h($notes['title']); ?></td><br>
    <td>内容：<br><?php hbr($notes['content']); ?></td><br>
    </tr>

    <p><a href='index.php'>一覧に戻る</a> | <a href='edit.php?id=<?=$id ?>'>編集</a> | <a href='delete.php?id=<?=$id ?>' name='submit' value='submit'>削除</a></p>
    
   
<?php include('footer.inc.php') ?>
</body>

</html>