<?php include_once "../base.php";

$acc=$_GET['acc'];
echo $Mem->count(['acc'=>$acc]);

/* $chk=$Mem->count(['acc'=>$acc]);

if($chk>0){
    echo "1";
} */


?>