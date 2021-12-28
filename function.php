<?php

function getPosts($conect){
    
        $posts = mysqli_query($conect,"SELECT * FROM `posts`");
        $postsList = [];
        while($post = mysqli_fetch_assoc($posts)){
            $postsList []= $post;
        }
        
        echo json_encode($postsList);
        
}

function getPost($conect,$id){
    
    $post = mysqli_query($conect,"SELECT * FROM `posts` WHERE `id`='$id'");

    if(mysqli_num_rows($post)===0){
        http_response_code(404);
        $rez = [
            "status"=>false,
            "message"=>"Post not found"

        ];
        echo json_encode($rez);
    }else{
        $post = mysqli_fetch_assoc($post);

        echo json_encode($post);
    }
    
   
    
}

function addPost($conect,$data){
    $title = $data['title'];
    $body =$data['body'];
    mysqli_query($conect,"INSERT INTO `posts` (`title`, `body`) VALUES ('$title', '$body')");

    http_response_code(201);

        $rez = [
            "status"=>true,
            "post_id"=>mysqli_insert_id($conect)

        ];
        echo json_encode($rez);
}

function updatePost($conect,$id,$data){
  
    $title = $data['title'];
    $body =$data['body'];
    mysqli_query($conect,"UPDATE `posts` SET `title` = '$title', `body` = '$body' WHERE `posts`.`id` = '$id'");

    http_response_code(200);

    $rez = [
        "status"=>true,
        "message"=>"Post is updated"

    ];
    echo json_encode($rez);

}

function deletePost($conect,$id){
    mysqli_query($conect,"DELETE FROM `posts` WHERE `posts`.`id` = '$id'");
    http_response_code(200);

    $rez = [
        "status"=>true,
        "message"=>"Post is deleted"

    ];
    echo json_encode($rez);
}