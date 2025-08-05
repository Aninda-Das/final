<?php
    include 'connect.php';

    if (!isset($_GET['id'])) {
        die("ID parameter is missing");
    }

    $id = (int)$_GET['id']; 
    $query = "SELECT * FROM post WHERE id = ?";
    $stmt = mysqli_prepare($con, $query);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        
        if (!$row) {
            die("Post not found");
        }
        
        mysqli_stmt_close($stmt);
    } else {
        die("Failed to prepare statement: " . mysqli_error($con));
    }
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
    <h3>Update Post</h3>
    <p>✏️ Edit your post content and username here.</p>
  </div>

  <div class="feed">
    <h2>Update Post</h2>
    <div class="form">
      <form action="set.php" autocomplete="on" method="post">
        <input type="hidden" name="id" value="<?= $row['id'] ?>">
        
        <label for="un">Username:</label>
        <input type="text" id="un" name="un" value="<?= htmlspecialchars($row['username']) ?>" required>
        
        <label for="posts">Post Content:</label>
        <textarea id="posts" name="posts" required><?= htmlspecialchars($row['post']) ?></textarea>
        
        <input type="submit" value="Update Post" class="btn">
      </form>
      
      <div style="margin-top: 20px; text-align: center;">
        <a href="list.php" style="color: #4299e1; text-decoration: none;">← Back to Posts</a>
      </div>
    </div>
  </div>

  <div class="sidebar">
    <h3>Actions</h3>
    <p>📝 <a href="list.php">View All Posts</a></p>
    <p>➕ <a href="index.html">Add New Post</a></p>
  </div>
</div>

</body>
</html>