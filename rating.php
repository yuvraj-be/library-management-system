<?php
session_start();
if(!isset($_SESSION["Saved_userId"])){
    header("Location:index.php");
}
include 'function/functions.php';
// Connect to MySQL database
$pdo = pdo_connect_mysql();

// Prepare the SQL statement and get records from our books table
$stmt = $pdo->prepare('SELECT * FROM book ORDER BY bid');
$stmt->execute();
// Fetch the records so we can display them in our template.
$books = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>NCIT Library</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/all.css"/>
  </head>
  <body>
    <nav>
      <input type="checkbox" id="check">
      <label for="check" class="checkbtn">
        <i class="fas fa-bars"></i>
      </label>
      <label class="logo">NCIT Library</label>
      <ul>
      <li><a class="active" href="home.php">Home</a></li>
        <li><a href="rating.php">Rate a Book</a></li>
        <li><a href="borrowed.php">Borrowed</a></li>
        <li><a href="logout.php">Logout</a></li> 
      </ul>
    </nav>
    <div class="content read">
    <table>
        <thead>
            <tr>
                <td>#</td>
                <td>ISBN</td>
                <td>Title</td>
                <td>Author</td>
                <td>Category</td>
                <td>Publisher</td>
                <td>Publisher Date</td>
                <td>Available</td>
                <td>Positive Review</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($books as $book): ?>
            <tr>
                <td><?=$book['bid']?></td>
                <td><?=$book['isbn']?></td>
                <td><?=$book['title']?></td>
                <td><?=$book['author']?></td>
                <td><?=$book['category']?></td>
                <td><?=$book['publisher']?></td>
                <td><?=$book['publish_date']?></td>
                <td><?=$book['available']?></td>
                <td><?=$book['rate']?></td>
                <td class="actions">
                    <a href="rating_book.php?id=<?=$book['bid']?>" class="edit"> Rate</a>
                    
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
  </body>
</html>



   