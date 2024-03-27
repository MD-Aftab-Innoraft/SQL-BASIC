/**
 * Redirects to the desired query number page.
 *
 * @param {int} num
 *  Query button number clicked.
 */
function handleQueryClick(num) {
  window.location.href = `Query${num}.php`;
}
