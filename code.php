<?php

include'connect.php';

$un = $_POST['un'];
$posts = $_POST['posts'];

$query = "INSERT INTO post(username, post) VALUES ('$un', '$posts')";
$run = mysqli_query($con, $query);

if(!$run){
    echo "Submission failed: ";
} else {
    header("Location: list.php");
}   
?>