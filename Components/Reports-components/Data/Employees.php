<table>
    <tr>
        <th>ID</th>
        <th>Full Name</th>
        <th>Position</th>
        <th>Committee</th>
        <th>Start of Term</th>
        <th>End of Term</th>
        <th>Term Status</th>
    </tr>
    <?php
                        $employees = getEmployees();
                        foreach($employees as $employee){?>
    <tr>
        <td><?php echo $employee['employeeID']?></td>
        <td><?php echo $employee['fullName']?></td>
        <td><?php echo $employee['position']?></td>
        <td><?php echo $employee['committee']?></td>
        <td><?php echo $employee['termStart']?></td>
        <td><?php echo $employee['termEnd']?></td>
        <td><?php echo $employee['termStatus']?></td>
    </tr>
    <?php }?>
</table>