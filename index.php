<?php

// Requiring the DB Connection file.
require ('DbConnect.php');

// Queries to select all rows from the respective tables.
$codeQuery= "SELECT * FROM employee_code_table";
$salaryQuery = "SELECT * FROM employee_salary_table";
$detailsQuery = "SELECT * FROM employee_details_table";

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
  require ('./components/queryResults.php');
}

// Adding the use of query string to traverse different pages.
if($_SERVER["REQUEST_METHOD"] == "GET") {
  if(!empty($_GET['query'])) {
    $num = $_GET['query'];
    if($num > 0 && $num < 8) {
      header("location:Query$num.php");
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Assign-2</title>
  <link rel="stylesheet" href="./CSS/style.css">
</head>

<body>
  <div class="container">
    <p class="addDataBtn"><a href="insertData.php">Insert Data</a></p>
    <div class="heading">SQL Basic Assignment 2:</div>

    <!-- Displaying the employee_code_table. -->
    <div class="tableName">employee_code_table</div>
    <?php createTable($codeQuery); ?>

    <!-- Displaying the employee_salary_table. -->
    <div class="tableName">employee_salary_table</div>
    <?php createTable($salaryQuery); ?>

    <!-- Displaying the employee_details_table. -->
    <div class="tableName">employee_salary_table</div>
    <?php createTable($detailsQuery); ?>

    <?php require ('./components/queryButtons.html'); ?>
  <!-- Linking the javascript files. -->
  <script src="./JS/script.js"></script>
</body>

</html>
