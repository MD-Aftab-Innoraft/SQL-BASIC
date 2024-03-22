<?php

// Requiring the autoload file.
require ('./vendor/autoload.php');

// Requiring the  DB Connection file.
require ('./DbConnect.php');

// When the user visits the page, relevant query result is displayed.
if($_SERVER["REQUEST_METHOD"] == "GET") {
  $query4 = "SELECT CONCAT(details.employee_first_name,' ', details.employee_last_name)
             AS employee_full_name, salary.employee_salary
             FROM employee_code_table AS code INNER JOIN employee_salary_table AS salary
             ON code.employee_code=salary.employee_code
             INNER JOIN employee_details_table AS details
             ON salary.employee_id=details.employee_id
             WHERE code.employee_domain != 'Java'";
  $stmt = $conn->query($query4);
  $results = $stmt->fetchAll();

  // Fetch all the column names.
  $columnNames = array();
  $columnCount = $stmt->columnCount();
  for ($i = 0; $i < $columnCount; $i++) {
    $col = $stmt->getColumnMeta($i);
    array_push($columnNames,$col['name']);
  }
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
  <title>Query-4</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <p class="homeBtn"><a href="index.php">Home</a></p>
    <h1 class="heading">Query 4:</h1>
    <p class="question">WAQ to list all employee’s full name that are not of domain Java.</p>

    <!-- Displaying the query results in the from of table. -->
    <?php require ('./queryResults.php'); ?>
  </div>
</body>
</html>
