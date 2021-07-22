<?php
include_once "../base.php";

$type=$_POST['type'];
$news=$_POST['news'];
$acc=$_POST['acc'];

switch($type){
    case '1':
        $Log->save(['news'=>$news,'acc'=>$acc]);
    break;
    case '2':
        $Log->del(['news'=>$news,'acc'=>$acc]);
    break;
}
