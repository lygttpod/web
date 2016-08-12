<?php
	$username=$_GET['username'];
    $password=$_GET['password'];
	if($username=="gejing"){
        if($password=="123321"){
            echo "OK";
        }
        else{
            echo "fail";
        }
    }else{
        echo "success";
        
    }
?>