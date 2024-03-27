<!-- Displays the query results in the form of table. -->
<table class="myTable">
  <thead>
    <tr>
      <?php
        // Fetching and displaying the table headers(if rows are returned).
      if(!empty($results)) {
        foreach ($columnNames as $columnName) { ?>
      <th><?php echo $columnName; ?></th>
      <?php } ?>
    </tr>
  </thead>
  <tbody>
    <!-- Displaying the resultant rows(if present) in table form. -->
    <?php foreach ($results as $result) { ?>
      <tr>
        <?php foreach ($columnNames as $columnName) { ?>
        <td><?php echo $result->$columnName; ?></td>
        <?php } ?>
      </tr>
    <?php }
        }
        // Displaying no records found message.
        else { ?>
          <div class="emptyMsg">No records found!</div>
      <?php } ?>
  </tbody>
</table>
