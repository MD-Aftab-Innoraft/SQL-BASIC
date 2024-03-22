<?php

// Requiring db connection file.
require 'DbConnect.php';

// When the form is submitted using POST method.
if($_SERVER["REQUEST_METHOD"] == "POST") {
  $fname = $_POST["fname"];
  $lname = $_POST["lname"];
  $gradPercent = $_POST["gradPercent"];
  $empId = $_POST["empId"];
  $empCode = $_POST["empCode"];
  $empCodeName = $_POST["empCodeName"];
  $empDomain = $_POST["empDomain"];
  $empSalary = $_POST["empSalary"];

  // Inserting data into employee_code_table.
  $insertQuery = "INSERT INTO employee_code_table
                 (employee_code, employee_code_name, employee_domain)
                  VALUES (?, ?, ?)";
  $stmt1 = $conn->prepare($insertQuery);
  $stmt1->execute([$empCode, $empCodeName, $empDomain]);

  // Inserting data into employee_salary_table.
  $insertQuery = "INSERT INTO employee_salary_table
                 (employee_id, employee_salary, employee_code)
                 VALUES (?, ?, ?)";
  $stmt2 = $conn->prepare($insertQuery);
  $stmt2->execute([$empId, $empSalary, $empCode]);

  // Inserting data into employee_details_table.
  $insertQuery = "INSERT INTO employee_details_table
                 (employee_id, employee_first_name, employee_last_name, Graduation_percentile)
                 VALUES (?, ?, ?, ?)";
  $stmt3 = $conn->prepare($insertQuery);
  $stmt3->execute([$empId, $fname, $lname, $gradPercent]);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Insert Data</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <!-- Redirects to the home page(index.php). -->
    <p class="homeBtn"><a href="index.php">Home</a></p>

    <!-- Message on successful insertion. -->
    <?php if ($stmt1 && $stmt2 && $stmt3) { ?>
      <div class="successMsg">Record inserted successully.</div>
    <?php } ?>

    <div class="heading">Insert Employee Data:</div>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>"
    method="POST" onsubmit="return validateData();">

    <!-- Input for first name and display related errors. -->
    <label for="fname">First name:</label>
    <input type="text" name="fname" id="fname" required maxlength="25">
    <span class="error" id="fnameErr">*</span> <br>

    <!-- Input for last name and display related errors. -->
    <label for="lname">Last name:</label>
    <input type="text" name="lname" id="lname" required maxlength="25">
    <span class="error" id="lnameErr">*</span> <br>

    <!-- Input for graduation percentage and display related errors. -->
    <label for="gradPercent">Graduation percentage: (in %)</label>
    <input type="number" id="gradPercent" name="gradPercent" required step=1 max=100 min=0  maxlength="3">
    <span class="error" id="gradPercentErr">*</span>

    <!-- Input for employee ID and display related errors. -->
    <label for="empId">Employee ID: (start with RU)</label>
    <input type="text" id="empId" name="empId" required minlength="5" maxlenght="10">
    <span class="error" id="empIdErr">*</span> <br>

    <!-- Input for employee code and display related errors. -->
    <label for="empCode">Employee Code:</label>
    <input type="text" id="empCode" name="empCode" required maxlenght="25">
    <span class="error" id="empCodeErr">*</span> <br>

    <!-- Input for employee code name and display related errors. -->
    <label for="empCodeName">Employee Code Name:</label>
    <input type="text" id="empCodeName" name="empCodeName" required maxlength="25">
    <span class="error" id="empCodeNameErr">*</span> <br>

    <!-- Input for employee domain and display related errors. -->
    <label for="empDomain">Employee Domain:</label>
    <input type="text" id="empDomain" name="empDomain" required maxlength="20" >
    <span class="error" id="empDomainErr">*</span>

    <!-- Input for employee salary(in K's) and display related errors. -->
    <label for="empSalary">Employee Salary: (in K's)</label>
    <input type="number" id="empSalary" name="empSalary" required maxlength="3">
    <span class="error" id="empSalaryErr">*</span>

    <!-- Submit button to submit the form. -->
    <input type="submit" value="SUBMIT">
  </form>
  </div>
  <!-- Linking the javascript file for the page. -->
  <script src="script.js"></script>
</body>
</html>
