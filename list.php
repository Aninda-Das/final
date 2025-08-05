<?php
include 'connect.php';

$query = "SELECT * FROM post ORDER BY id DESC";
$run = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Post Feed</title>
  <link rel="stylesheet" href="style.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }

    .main-container {
      display: flex;
      justify-content: center;
      align-items: flex-start;
      padding: 40px 20px;
      gap: 20px;
    }

    .sidebar {
      width: 20%;
      background: #fff;
      padding: 20px;
      box-shadow: 0 0 5px rgba(0,0,0,0.1);
      border-radius: 10px;
      height: 300px;
    }

    .feed {
      flex: 1;
      max-width: 800px;
      background: #fff;
      padding: 30px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      border-radius: 10px;
    }

    h2 {
      margin-top: 0;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
      background-color: #fafafa;
    }

    th, td {
      padding: 12px 16px;
      border-bottom: 1px solid #e0e0e0;
      text-align: left;
    }

    th {
      background-color: #f5f5f5;
      font-weight: 600;
      color: #333;
    }

    tr:hover {
      background-color: #fff;
    }

    a {
      color: #007BFF;
      text-decoration: none;
    }

    a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

<?php include 'nav.html'; ?>

<div class="main-container">
  <div class="sidebar">
    <h3>Left Feed</h3>
    <p>📢 Place ads, tips, or trending news.</p>
  </div>

  <div class="feed">
    <h2>User Posts</h2>
    <?php if (mysqli_num_rows($run) > 0) { ?>
    <table>
      <tr>
        <th>Username</th>
        <th>Posts</th>
        <th>Actions</th>
      </tr>
      <?php while($row = mysqli_fetch_assoc($run)) { ?>
      <tr>
        <td><?= htmlspecialchars($row['username']) ?></td>
        <td><?= nl2br(htmlspecialchars($row['post'])) ?></td>
        <td>
          <a href="update.php?id=<?= $row['id'] ?>">Update</a> |
          <a href="delete.php?id=<?= $row['id'] ?>">Delete</a>
        </td>
      </tr>
      <?php } ?>
    </table>
    <?php } else { ?>
      <p>No posts available.</p>
    <?php } ?>
  </div>

  <div class="sidebar">
    <h3>Write Feed</h3>
    <p>📝 <a href="form.html">Create a new post</a></p>
  </div>
</div>

</body>
</html>
