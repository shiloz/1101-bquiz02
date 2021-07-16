<div>目前位置：首頁 > 分類網誌 > <span id='navType'>健康新知</span></div>
<fieldset style="width:15%;display:inline-block;vertical-align:top">
    <legend>分類網誌</legend>
    <p><a class="type" id="t1" href="#">健康新知</a></p>
    <p><a class="type" id="t2" href="#">菸害防制</a></p>
    <p><a class="type" id="t3" href="#">癌症防治</a></p>
    <p><a class="type" id="t4" href="#">慢性病防治</a></p>
</fieldset>
<fieldset style="width:75%;display:inline-block">
    <legend>文章列表</legend>
    <div id="titles"></div>
</fieldset>


<script>
$(".type").on("click",function(){
    let type=$(this).text();
    $("#navType").html(type);

    //去後端撈文章列表
    $.get('api/get_list.php',
         {'type':$(this).attr('id').replace('t','')},
         function(list){
            $("#titles").html(list)
         }
         
         )
})


</script>