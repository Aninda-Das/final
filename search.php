<?php

    include 'connect.php';

    $token = $_GET['search'];

    $query = "SELECT * FROM post WHERE username LIKE '%$token%' 
                OR post LIKE '%$token%'";

    $run = mysqli_query($con, $query);

    if(mysqli_num_rows($run)>0){

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'nav.html' ?>
    <div class="container">
        <div class="table">
            <style>
            .card-list {
                display: flex;
                flex-direction: column;
                gap: 20px;
                margin-top: 24px;
            }
            .card {
                background: #fafafa;
                border-radius: 8px;
                box-shadow: 0 1px 4px rgba(0,0,0,0.06);
                padding: 20px 24px;
                display: flex;
                flex-direction: column;
                transition: box-shadow 0.2s;
            }
            .card:hover {
                box-shadow: 0 4px 16px rgba(25, 118, 210, 0.10);
                background: #f0f8ff;
            }
            .card .card-header {
                font-weight: 600;
                color: #1976d2;
                margin-bottom: 8px;
                font-size: 1.1em;
            }
            .card .card-body {
                color: #333;
                margin-bottom: 12px;
            }
            .card .card-actions a {
                color: #1976d2;
                text-decoration: none;
                margin-right: 12px;
                font-size: 0.97em;
            }
            .card .card-actions a:hover {
                text-decoration: underline;
            }
            </style>
            <div class="card-list">
            <?php mysqli_data_seek($run, 0); while($row = mysqli_fetch_assoc($run)){ ?>
                <div class="card">
                    <div class="card-header"><?= htmlspecialchars($row['username']) ?></div>
                    <div class="card-body"><?= nl2br(htmlspecialchars($row['post'])) ?></div>
                    <div class="card-actions">
                        <a href="update.php?id=<?= $row['id']?>">Update</a>
                        <a href="delete.php?id=<?= $row['id']?>">Delete</a>
                    </div>
                </div>
            <?php } ?>
            </div>
            <style>
            .container {
                max-width: 800px;
                margin: 40px auto;
                padding: 24px;
                background: #fff;
                border-radius: 8px;
                box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            }

            .table {
                margin-top: 24px;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                background: #fafafa;
            }

            th, td {
                padding: 12px 16px;
                text-align: left;
                border-bottom: 1px solid #e0e0e0;
            }

            th {
                background: #f5f5f5;
                font-weight: 600;
                color: #333;
            }

            tr:hover {
                background: #f0f8ff;
            }

            a {
                color: #1976d2;
                text-decoration: none;
                margin: 0 4px;
            }

            a:hover {
                text-decoration: underline;
            }
            </style>

            <table>
                <tr>
                    <th>Username</th>
                    <th>Posts</th>
                    <th>Actions</th>
                </tr>
                <?php while($row = mysqli_fetch_assoc($run)){ ?>
                <tr>
                    <td><?= $row['username'] ?></td> 
                    <td><?= $row['post'] ?></td>
                    <td>
                        <a href="update.php?id=<?= $row['id']?>">Update</a> |
                        <a href="delete.php?id=<?= $row['id']?>">Delete</a>
                    </td>
                </tr>
                <?php } ?>
            </table>    
            <?php } ?>
        </div>
        
    </div>
</body>
</html>