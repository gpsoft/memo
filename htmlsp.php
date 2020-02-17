<?php
function h($str){
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
    //echo htmlspecialchars($str, ENT_QUOTES, 'UTF-8')
    //returnを使うなら出力先でechoするのを忘れない

}

function hbr($str){
    return nl2br(h($str));
    //echo nl2br(htmlspecialchars($str, ENT_QUOTES, 'UTF-8'));
    //return使うならこの範囲内でも上で作ったh関数を使って良い。出力先でecho
    //echo使うなら上のh関数をここで使うとechoが２重になってしまい改行がうまくいかない
}