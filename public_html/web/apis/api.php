
<?php
    //get接受传值
    $action = $_GET['action'];
    //执行函数
    api($action);
    //定义函数
    
    function api($action){
        //函数体
         $result = array('a'=>'one', 'b'=>'two', 'c'=>'three' ,'d'=>'你好','action'=>$action);
         echo json_encode($result);
        
//        $url="http://www.loncol.com/api/user.htm";
//        $ip=json_decode(file_get_contents($url));
//        echo json_encode($ip);
        
    }
?>