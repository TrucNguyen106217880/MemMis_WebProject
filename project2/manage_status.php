<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Group Project 2">
	<meta name="keywords" content="Management Site, MemMis, GroupProject">
	<meta name="author" content="Hoang Trong Toan">
	<title>Management</title>
</head>
</head>
<body>
    <?php
    require_once 'settings.php';
        session_start();
    function status_manage($id, $status){
        if($status=="New" || $status=="Current" || $status=="Final"){
            return  "UPDATE eoi
                    SET eoi_status = '$status'
                    WHERE eoi_number = $id
            ";
        }
    }
    $id=$_GET["id"];
    $status=$_GET["status"];
    $valid_status=mysqli_real_escape_string($conn,$status);
    $sql2 = status_manage($id,$valid_status);
    mysqli_query($conn,$sql2);
    mysqli_close($conn);
    echo header("Location: manage.php")
    ?>
</body>
</html>