<?php
include_once "../base.php";

$type=$_GET['type'];
$news=$News->all(['type'=>$type]);
foreach($news as $n){
    echo "<div><a href='javascript:getNews({$n['id']})'>";
    echo $n['title'];

    echo "</a></div>";
}

