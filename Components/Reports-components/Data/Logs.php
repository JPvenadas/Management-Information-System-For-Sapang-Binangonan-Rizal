<table>
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>User type</th>
        <th>Date</th>
        <th>Action performed</th>
    </tr>
    <?php
                        $logs = getLogs();
                        foreach($logs as $log){?>
    <tr>
        <td><?php echo $log['activityID']?></td>
        <td><?php echo $log['userName']?></td>
        <td><?php echo $log['userType']?></td>
        <td><?php echo $log['date']?></td>
        <td><?php echo $log['action']?></td>
    </tr>
    <?php }?>
</table>