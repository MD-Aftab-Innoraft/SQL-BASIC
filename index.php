<?php

// Requiring the DB Connection file.
require 'DbConnect.php';

// Queries to select all rows from the respective tables.
$codeQuery= "SELECT * FROM employee_code_table";
$salaryQuery = "SELECT * FROM employee_salary_table";
$detailsQuery = "SELECT * FROM employee_details_table";

// Getting all the data from employee_code_table.
$codeStatement= $conn->query($codeQuery);
$codes = $codeStatement->fetchAll();

// Getting all thre data from the employee_salary_table.
$salaryStatement= $conn->query($salaryQuery);
$salaries = $salaryStatement->fetchAll();

// Getting all thre data from the employee_details_table.
$detailStatement= $conn->query($detailsQuery);
$details = $detailStatement->fetchAll();

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
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="container">
    <p class="addDataBtn"><a href="insertData.php">Insert Data</a></p>
    <div class="heading">SQL Basic Assignment 2:</div>
    <!-- Displaying the employee_code_table. -->
    <table>
      <thead>
        <tr>
          <th colspan="3">employee_code_table</th>
        </tr>
        <tr>
          <th>employee_code</th>
          <th>employee_code_name</th>
          <th>employee_domain</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($codes as $code) { ?>
        <tr>
          <td>
            <?php echo $code->employee_code; ?>
          </td>
          <td>
            <?php echo $code->employee_code_name; ?>
          </td>
          <td>
            <?php echo $code->employee_domain; ?>
          </td>
        </tr>
        <?php  } ?>

      </tbody>
    </table>

    <!-- Displaying the employee_salary_table. -->
    <table>
      <thead>
        <tr>
          <th colspan="3">employee_salary_table</th>
        </tr>
        <tr>
          <th>employee_id</th>
          <th>employee_salary</th>
          <th>employee_code</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($salaries as $salary) { ?>
        <tr>
          <td>
            <?php echo $salary->employee_id; ?>
          </td>
          <td>
            <?php echo $salary->employee_salary; ?>
          </td>
          <td>
            <?php echo $salary->employee_code; ?>
          </td>
        </tr>
        <?php } ?>
      </tbody>

    <!-- Displaying the employee_details_table. -->
    </table>
    <table>
      <thead>
        <tr>
          <th colspan="4">employee_details_table</th>
        </tr>
        <tr>
          <th>employee_id</th>
          <th>employee_first_name</th>
          <th>employee_last_name</th>
          <th>graduation_percentile</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($details as $detail) { ?>
        <tr>
          <td>
            <?php echo $detail->employee_id; ?>
          </td>
          <td>
            <?php echo $detail->employee_first_name; ?>
          </td>
          <td>
            <?php echo $detail->employee_last_name; ?>
          </td>
          <td>
            <?php echo $detail->graduation_percentile; ?>
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
    <!-- Buttons to redirect to the respective Query page. -->
    <div class="queryButtons">
      <button class="queryBtn" onclick="handleQueryClick(1)">Query1</button>
      <button class="queryBtn" onclick="handleQueryClick(2)">Query2</button>
      <button class="queryBtn" onclick="handleQueryClick(3)">Query3</button>
      <button class="queryBtn" onclick="handleQueryClick(4)">Query4</button>
      <button class="queryBtn" onclick="handleQueryClick(5)">Query5</button>
      <button class="queryBtn" onclick="handleQueryClick(6)">Query6</button>
      <button class="queryBtn" onclick="handleQueryClick(7)">Query7</button>
    </div>
  </div>
  <!-- Linking the javascript file. -->
  <script src="script.js"></script>
</body>

</html>
