<?php
include 'connect.php';
if(isset($_GET['deleteid'])){
    $id = $_GET['deleteid'];

    $sql = "DELETE FROM `immigration_db` WHERE id = $id";
    $result = mysqli_query($connection, $sql);
    if($result){
        header('location:display.php');
        echo 'Deleted!!!';
    }else{
        die("Connection Failed: ". mysqli_error($connection));
    }
}
?>