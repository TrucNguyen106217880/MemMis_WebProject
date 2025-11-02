<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    require_once('settings.php');
    function status_manage($id, $status){
        if($status=="New"){
            return  "UPDATE eoi
                    SET status = 'New'
                    WHERE id = $id
            ";
        }
        if($status=="Current"){
            return  "UPDATE eoi
                    SET status = 'Current'
                    WHERE id = $id
            ";
        }
        if($status=="Final"){
            return  "UPDATE eoi
                    SET status = 'Final'
                    WHERE id = $id
            ";
        }   
    }
    $sql2 = status_manage($id,$status);
    mysqli_query($connection,$sql2);
    echo header("Location: manage.php")
    ?>
</body>
</html>