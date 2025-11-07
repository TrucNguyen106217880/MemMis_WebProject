<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Group Project 2">
	<meta name="keywords" content="Management Site, MemMis, GroupProject">
	<meta name="author" content="Hoang Trong Toan">
	<title></title>
</head>
</head>
<body>
    <?php
    require_once 'settings.php';
    if ($user == "Memmis" && $pwd == password_verify("Memmis676905#:3")){
			session_start();
			$_SESSION["admin_user"];
			$host="localhost";
			$admin_user=$_SESSION(stripslashes(strip_tags('Memmis')));
			$admin_password=$_SESSION(password_verify('Memmis676905#:3'));
		} 
        else echo header(header:'Location: https://www.youtube.com/watch?v=l60MnDJklnM'); 
        $connection = mysqli_connect($host, $admin_user, $admin_password, "jobs");
        if (!$connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
    function status_manage($id, $status){
        if($status=="New" || $status=="Current" || $status=="Final"){
            return  "UPDATE eoi
                    SET status = $status
                    WHERE id = $id
            ";
        }
    }
    $valid_status=mysqli_real_escape_string($connection,$status);
    $sql2 = status_manage($id,$valid_status);
    mysqli_query($connection,$sql2);
    echo header("Location: manage.php")
    ?>
</body>
</html>