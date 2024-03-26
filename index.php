<?php

// Requiring the autoload file.
require ('./vendor/autoload.php');

// Requiring the DB Connection file.
require ('./DbConnect.php');

// Required queries.
$query1 = "SELECT * FROM teams";
$query2 = "SELECT * FROM fixtures";

/**
 * Function to execute a sql query and display the result in table form.
 *
 * @param string $query
 *  Query to be executed and showed result of.
 */
function createTable(string $query): void {
  global $conn;
  // Executing the query.
  $stmt = $conn->query($query);
  // Fetching all the rows.
  $results = $stmt->fetchAll();

  // Fetch all the column names for the table.
  $columnNames = array();
  $columnCount = $stmt->columnCount();
  for ($i = 0; $i < $columnCount; $i++) {
    $col = $stmt->getColumnMeta($i);
    // Pushing column names into '$columnNames' array.
    array_push($columnNames,$col['name']);
  }

  // Requiring the php file resposible for displaying table.
  require ('./queryResults.php');
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
    <?php createTable($query1); ?>

    <div class="heading">League Fixtures:</div>
    <!-- Displays the fixtures table. -->
    <?php createTable($query2); ?>
  </div>

  <!-- Linking the script files. -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="//cdn.datatables.net/2.0.2/js/dataTables.min.js"></script>
  <script src="script.js"></script>
</body>
</html>
