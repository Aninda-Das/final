<?php
    include 'connect.php';
    $id = $_GET['id'];

    $query = "DELETE FROM post WHERE id= $id";
    $run = mysqli_query($con, $query);

    if(!$run){
        echo "Deletion failed!";
    } else {
        header("Location: list.php");
    }
?>