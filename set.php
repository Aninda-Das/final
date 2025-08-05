<?php

include'connect.php';


if (!isset($_POST['id']) || !isset($_POST['un']) || !isset($_POST['posts'])) {
    die("Missing required fields");
}

$id = $_POST['id'];
$un = $_POST['un'];
$posts = $_POST['posts'];


$query = "UPDATE post SET username = ?, post = ? WHERE id = ?";
$stmt = mysqli_prepare($con, $query);

if ($stmt) {
   
    mysqli_stmt_bind_param($stmt, "ssi", $un, $posts, $id);
    
   
    $run = mysqli_stmt_execute($stmt);
    
    if (!$run) {
        echo "Submission failed: " . mysqli_error($con);
    } else {
       
        $affected_rows = mysqli_stmt_affected_rows($stmt);
        if ($affected_rows > 0) {
            header("Location: list.php");
            exit(); 
        } else {
            echo "No rows were updated. The ID might not exist or no changes were made.";
        }
    }
    
    mysqli_stmt_close($stmt);
} else {
    echo "Failed to prepare statement: " . mysqli_error($con);
}

mysqli_close($con);
?>