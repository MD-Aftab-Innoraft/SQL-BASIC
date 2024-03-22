<?php

// Requiring the autoload file.
require ('./vendor/autoload.php');

// Requiring the DB Connection file.
require ('./DbConnect.php');

// Fetching the participating teams.
$query1 = "SELECT * FROM teams";
$stmt = $conn->query($query1);
$results = $stmt->fetchAll();

// Fetch all the column names for 'teams' table.
$columnNames = array();
$columnCount = $stmt->columnCount();
for ($i = 0; $i < $columnCount; $i++) {
  $col = $stmt->getColumnMeta($i);
  array_push($columnNames,$col['name']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Assign 1</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="//cdn.datatables.net/2.0.2/css/dataTables.dataTables.min.css">
</head>
<body>
  <div class="container">
    <div class="heroText">TATA IPL 2023</div>
    <div class="heading">Participating Teams:</div>
    <!-- Displaying the teams table. -->
    <?php require ('./queryResults.php') ?>

    <div class="heading">League Fixtures:</div>
    <!-- Displays the fixtures table. -->
    <?php
      $query1 = "SELECT * FROM fixtures";
      $stmt = $conn->query($query1);
      $results = $stmt->fetchAll();

      // Fetch all the column names for 'fixtures' table.
      $columnNames = array();
      $columnCount = $stmt->columnCount();
      for ($i = 0; $i < $columnCount; $i++) {
        $col = $stmt->getColumnMeta($i);
        array_push($columnNames,$col['name']);
      }
      // Displaying the
      require ('./queryResults.php');
    ?>
  </div>
  <!-- Linking the script files. -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="//cdn.datatables.net/2.0.2/js/dataTables.min.js"></script>
  <script src="script.js"></script>
</body>
</html>
