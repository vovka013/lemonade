<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *, Authorization');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Credentials: true');
header('Content-type: json/application');

require_once "connect.php";
require_once "function.php";

$method = $_SERVER['REQUEST_METHOD'];

$q=$_GET['q'];
$params = explode('/',$q);
$type = $params[0];
$id = $params[1];
 
if($method==='GET'){

    if($type=='posts'){
        if(isset($id)){
            getPost($conect,$id);    
        }else{
    
        getPosts($conect);
        }
    }

}elseif($method==='POST'){
    if($type=='posts'){
        addPost($conect,$_POST);
    }
}elseif($method==='PATCH'){
    if($type=='posts'){
        if(isset($id)){
            $data = file_get_contents('php://input');
            $data = json_decode($data,true);

        updatePost($conect,$id,$data);
        }
    }
}elseif($method==='DELETE'){
    if($type=='posts'){
        if(isset($id)){
        deletePost($conect,$id);
        }
    }
}


// echo "<pre>";
// var_dump($postsList);
// echo "</pre>";