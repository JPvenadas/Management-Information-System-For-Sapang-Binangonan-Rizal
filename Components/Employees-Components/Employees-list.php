<div class="employee-items-container">
  <?php require "Employees-item.php";
        foreach ($employees as $employee) {
        generateEmployeeItem($employee);
        }?>
</div>