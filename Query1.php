<?php

// Requiring the autoload file.
require ('./vendor/autoload.php');

// Requiring the  DB Connection file.
require ('./DbConnect.php');

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

// When the user visits the page, relevant query result is displayed.
if($_SERVER["REQUEST_METHOD"] == "GET") {
  $query1 = "SELECT emp.employee_first_name,sal.employee_salary
             FROM employee_details_table AS emp
             INNER JOIN employee_salary_table AS sal
             ON emp.employee_id=sal.employee_id
             WHERE sal.employee_salary > '50k'";
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
  <title>Query-1</title>
  <link rel="stylesheet" href="./CSS/style.css">
</head>
<body>
  <div class="container">
    <p class="homeBtn"><a href="index.php">Home</a></p>
    <h1 class="heading">Query 1:</h1>
    <p class="question">WAQ to list all employee first name with salary greater than 50k. </p>

    <!-- Displaying the query results in the form of table. -->
    <?php createTable($query1); ?>

    <!-- Query buttons for easy navigation between pages. -->
    <?php require ('./components/queryButtons.html'); ?>
  </div>
  <script src="./JS/buttonClick.js"></script>
</body>
</html>
