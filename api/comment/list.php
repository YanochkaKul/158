<?php
    include "../../config/base_url.php";
	include "../../config/db.php";
	

    if(!isset($_GET['id']) || !intval($_GET['id'])){
        exit();
    }
    $id = $_GET['id'];
    $query = mysqli_query($con,
    "SELECT c.*, u.full_name FROM comments c LEFT OUTER JOIN users u ON c.authur_id=u.id WHERE c.blog_id=$id");

    $comment = array();

    if(mysqli_num_rows($query)  == 0){
        echo json_encode($comment);
        exit();

    }

    while($com = mysqli_fetch_assoc($query)){
        $comment[] = $com;
    }

    echo json_encode($comment);
?>