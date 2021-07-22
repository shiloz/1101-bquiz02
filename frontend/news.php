<div>目前位置：首頁 > 最新文章區</div>

<table>
    <tr>
        <td width="30%">標題</td>
        <td>內容</td>
        <td>人氣</td>
    </tr>
    <?php
    $all=$News->count(['sh'=>1]);
    $div=5;
    $pages=ceil($all/$div);
    $now=$_GET['p']??1;
    $start=($now-1)*$div;
    //$now=(isset($_GET['p']))?$_GET['p']:1;
    $news=$News->all(['sh'=>1]," limit $start,$div");
    foreach($news as $n){
    ?>
    <tr>
        <td class="clo"><?=$n['title'];?></td>
        <td><?=mb_substr($n['news'],0,30);?>...</td>
        <td></td>
    </tr>
    <?php
        }
    ?>

</table>
<div>
<?php
        if($now-1>0){
            echo "<a href='index.php?do=news&p=".($now-1)."' style='font-size:20px'> ";
            echo " < ";
            echo " </a>";
        }

        for($i=1;$i<=$pages;$i++){
            $fontsize=($now==$i)?'26px':'18px';
            echo "<a href='index.php?do=news&p=$i' style='font-size:$fontsize'> ";
            echo $i;
            echo " </a>";
        }

        if($now+1<=$pages){
            echo "<a href='index.php?do=news&p=".($now+1)."' style='font-size:20px'> ";
            echo " > ";
            echo " </a>";
        }


?>
</div>