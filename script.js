/* Initially, assuming every field is properly filled. */
let errorFree = true;

/**
 * Redirects to the desired query number page.
 *
 * @param {int} num
 *  Query button number clicked.
 */
function handleQueryClick(num) {
  window.location.href = `Query${num}.php`;
}

/**
 * Function to validate the user input data.
 *
 * @param {string} text
 *  Text to be validated.
 * @param {string} regex
 *  Regex to be validated against.
 * @param {string} field
 *  Field which is being verified.
 * @param {int} maxlength
 *  Max allowed length for text.
 * @param {int} minlength
 *  Min allowed length for text.
 *
 * @returns {string}
 *  Containing the relevant error message.
 */
function checkInput(text, regex, field, maxlength=25, minlength=1) {
  if (text == "") {
    errorFree = false;
    return `* ${field} is required.`;
  }
  else if (!regex.test(text)) {
    errorFree = false;
    return `* Invalid input.`;
  }
  else if (text.length < minlength || text.length > maxlength) {
    errorFree = false;
    return `* ${field} must be between ${minlength} and ${maxlength}.`
  }
  return "*";
}

/**
 * Validates the Input form details.
 */
function validateData() {
  /* Initially, asssuming every field is properly filled. */
  errorFree = true;

  // Getting the user input values.
  let fname = document.getElementById('fname').value.trim();
  let lname = document.getElementById('lname').value.trim();
  let gradPercent = document.getElementById('gradPercent').value.trim();
  let empId = document.getElementById('empId').value.trim();
  let empCode = document.getElementById('empCode').value.trim();
  let empCodeName = document.getElementById('empCodeName').value.trim();
  let empDomain = document.getElementById('empDomain').value.trim();
  let empSalary = document.getElementById('empSalary').value.trim();

  // Targetting the error messages.
  let fnameErr = document.getElementById('fnameErr');
  let lnameErr = document.getElementById('lnameErr');
  let gradPercentErr = document.getElementById('gradPercentErr');
  let empIdErr = document.getElementById('empIdErr');
  let empCodeErr = document.getElementById('empCodeErr');
  let empCodeNameErr = document.getElementById('empCodeNameErr');
  let empDomainErr = document.getElementById('empDomainErr');
  let empSalaryErr = document.getElementById('empSalaryErr');

  // Regex to validate text inputs.
  const  nameRegex = /^[a-zA-Z\s]+$/;
  const codeRegex = /^[a-zA-Z\s_]+$/;
  const empIdRegex = /^RU[a-zA-Z0-9]{3,}$/;
  const percentRegex = /^(100(\.0{1,2})?|\d{1,2}(\.\d{1,2})?)$/;
  const salaryRegex = /^(1\d\d|20|\b1\d|\b[1-9][0-9]?)$/;;

  // Updating the error messages for the input fields.
  fnameErr.innerHTML = checkInput(fname,  nameRegex,"First name", 25, 1);
  lnameErr.innerHTML = checkInput(lname,  nameRegex, "Last name", 25, 1);
  gradPercentErr.innerHTML = checkInput(gradPercent, percentRegex, "Graduation Percentile", 100, 1);
  empIdErr.innerHTML = checkInput(empId, empIdRegex, "Employee ID", 10, 5);
  empCodeErr.innerHTML = checkInput(empCode, codeRegex, "Employee Code", 25, 1);
  empCodeNameErr.innerHTML = checkInput(empCodeName, codeRegex, "Employee Code Name", 25, 1);
  empDomainErr.innerHTML = checkInput(empDomain,  nameRegex, "Employee Domain", 20);
  empSalaryErr.innerHTML = checkInput(empSalary, salaryRegex, "Salary", 5, 1);

  // Returns whether all the inputs fields are properly filled.
  return errorFree;;
}
