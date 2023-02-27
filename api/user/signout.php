<?php
    include "../../config/base_url.php";
	include "../../config/db.php";
    session_start();
    session_destroy();
    header("Location:$BASE_URL/index.php");
?>
<!-- hw -->