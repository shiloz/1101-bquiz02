<?php
session_start();
date_default_timezone_set("Asia/Taipei");
//設定後台的抬頭文字

class DB{
    private $dsn="mysql:host=localhost;charset=utf8;dbname=db55";
    private $root='root';
    private $password='12345';
    private $table;
    private $pdo;

    public function __construct($table){
        $this->table=$table;
        $this->pdo=new PDO($this->dsn,$this->root,$this->password);
    }

    public function all(...$arg){
        $sql="select * from $this->table ";
        // $arg=[]  or [陣列],[SQL字串],[陣列,SQL字串],

        if(isset($arg[0])){
            if(is_array($arg[0])){
                //["欄位"=>"值","欄位"=>"值"]
                //where `欄位`='值' && `欄位`='值'
                //"欄位"=>"值" ====> `欄位`='值'

                foreach($arg[0] as $key => $value){
                    $tmp[]=sprintf("`%s`='%s'",$key,$value);
                }
                    $sql=$sql . " where " . implode(" && ",$tmp);
            }else{
                //當它是字串
                $sql=$sql . $arg[0];
            }

            if(isset($arg[1])){
                //當它是字串
                $sql=$sql . $arg[1];
            }

        }

        //echo $sql;
        return $this->pdo->query($sql)->fetchAll();

    }

    public function count(...$arg){
        $sql="select count(*) from $this->table ";

        if(isset($arg[0])){
            if(is_array($arg[0])){
                foreach($arg[0] as $key => $value){
                    $tmp[]=sprintf("`%s`='%s'",$key,$value);
                }
                    $sql=$sql . " where " . implode(" && ",$tmp);
            }else{
 
                $sql=$sql . $arg[0];
            }

            if(isset($arg[1])){
                 $sql=$sql . $arg[1];
            }
        }

        //echo $sql;
        return $this->pdo->query($sql)->fetchColumn();

    }
    public function find($id){
        $sql="select * from $this->table ";

        
            if(is_array($id)){
                foreach($id as $key => $value){
                    $tmp[]=sprintf("`%s`='%s'",$key,$value);
                }
                    $sql=$sql . " where " . implode(" && ",$tmp);
            }else{
 
                $sql=$sql . " where `id`='$id'";
            }

        //echo $sql;
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);

    }
    public function del($id){
        $sql="delete from $this->table ";
            if(is_array($id)){
                foreach($id as $key => $value){
                    $tmp[]=sprintf("`%s`='%s'",$key,$value);
                }
                    $sql=$sql . " where " . implode(" && ",$tmp);
            }else{
 
                $sql=$sql . " where `id`='$id'";
            }

        //echo $sql;
        return $this->pdo->exec($sql);

    }

    //欄位加總的計畫
    public function sum($col){
        $sql="select sum(`$col`) from $this->table";

        return $this->pdo->query($sql)->fetchColumn();
    }

    public function save($array){
        if(isset($array['id'])){
            //update
                foreach($array as $key => $value){
                    if($key!='id'){
                        $tmp[]=sprintf("`%s`='%s'",$key,$value);
                    }
                }

            $sql="update $this->table set ".implode(',',$tmp)." where `id`='{$array['id']}'";
        }else{
            //insert
            // `name`,`addr`,`tel`
            $sql="insert into $this->table 
                    (`".implode("`,`",array_keys($array))."`) values
                    ('".implode("','",$array)."')";
        }

        //echo $sql;
        return $this->pdo->exec($sql);
    }

}

$Total=new DB('total');
$Mem=new DB('mem');


//判斷是否要新增當日的資料
if($Total->count(['date'=>date("Y-m-d")])<=0){
    $Total->save(['date'=>date("Y-m-d"),'total'=>0]);
};

//判斷是否要增加session
if(!isset($_SESSION['total'])){
    $todayTotal=$Total->find(['date'=>date("Y-m-d")]);
    $todayTotal['total']++;
    $Total->save($todayTotal);
    $_SESSION['total']=1;
}


function to($url){
    header("location:".$url);
}


?>