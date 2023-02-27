<?php
    include "config/base_url.php";
	include "config/db.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Добавление нового блога</title>
	<?php include "views/head.php"; ?>
</head>
<body>
<?php include "views/header.php"; ?>
<?php
   $id=$_GET['id'];
   $user = mysqli_query($con,
   "SELECT * FROM users WHERE id=$id");
   $row = mysqli_fetch_assoc($user);
?>


<section class="container page">
    <div class="auth-form">
        <h1>Редактирование</h1>
        
        <form class="form" action="<?=$BASE_URL?>/api/user/update.php?id=<?=$_SESSION['id']?>" method="POST" enctype="multipart/form-data">
            <fieldset class="fieldset">
                <input class="input" value="<?=$row['email']?>" type="text" name="email" placeholder="Введите email">
            </fieldset>
            <fieldset class="fieldset">
                <input class="input" value="<?=$row['full_name']?>" type="text" name="full_name" placeholder="Полное имя">
            </fieldset>
            <fieldset class="fieldset">
                <input class="input" value="<?=$row['nickname']?>" type="text" name="nickname" placeholder="Nickname">
            </fieldset class="fieldset">
                <textarea name="about" id="" cols="52" rows="10"></textarea>
            <fieldset>
            <fieldset class="fieldset">
				<button class="button button-yellow input-file">
					<input type="file" name="img">	
					Выберите картинку
				</button>
			</fieldset>

            </fieldset>
            <fieldset class="fieldset">
                    <button class="button" type="submit">Зарегистрироваться</button>
                </fieldset>
            
        </form>
    </div>


</section>
    
</body>
</html>