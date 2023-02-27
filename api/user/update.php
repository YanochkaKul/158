<?php 
include "../../config/db.php";
include "../../config/base_url.php";

if(isset($_GET['id'], $_POST['email'],
$_POST['nickname'],
$_POST['full_name']) &&
intval($_GET['id']) &&
strlen($_POST['nickname'])>0 &&
strlen($_POST['full_name'])>0 &&
strlen($_POST['email'])>0 ){
    $id = $_GET['id'];
    $email = $_POST['email'];
    $nickname = $_POST['nickname'];
    $full_name = $_POST['full_name'];

    if(isset($_POST['about'], $_FILES['img']) && 
    strlen($_POST['about']) > 0 && 
    strlen($_FILES['img']['name']) >0){
        $query = mysqli_query($con,
        "SELECT img FROM users WHERE id = $id");
        if(mysqli_num_rows($query) > 0){
            $row = mysqli_fetch_assoc($query);
            $old_path = __DIR__."../../".$row['img'];
            if(file_exists($old_path)){
                unlink($old_path);
            }
        }
        $ext = end(explode(".", $_FILES['img']['name']));
        $img_name = time().".".$ext;


        move_uploaded_file($_FILES['img']['tmp_name'],
        "../../images/users/$img_name");
        $path = "images/users/".$img_name;
        


        $prep = mysqli_prepare($con, 
        "UPDATE users SET nickname=?, full_name=?, email=?, about=?, img=? WHERE id=?");
        mysqli_stmt_bind_param($prep,"sssssi", $nickname, $full_name,  $email, $_POST['about'], $path,  $id);
        mysqli_stmt_execute($prep);


    }else{
        $prep=mysqli_prepare($con,
        "UPDATE users SET nickname=?, full_name=?, email=? WHERE id=?");
        mysqli_stmt_bind_param($prep,"sssi", $email, $nickname, $id, $full_name);
        mysqli_stmt_execute($prep);
       
        
    }
    session_start();
    $_SESSION['nickname'] = $nickname;
        $nick =$_SESSION['nickname'];  



header("Location: $BASE_URL/profile.php?nickname=$nick");
}else{
    header("Location: $BASE_URL/profileupdate.php?error=1");
}