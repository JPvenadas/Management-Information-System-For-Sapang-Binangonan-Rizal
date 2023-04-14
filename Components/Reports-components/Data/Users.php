<table>
    <tr>
        <th>Username</th>
        <th>Full name</th>
        <th>User Type</th>
        <th>Active Status</th>
    </tr>
    <?php
                        $users = getUsers();
                        foreach($users as $user){?>
    <tr>
        <td><?php echo $user['userName']?></td>
        <td><?php echo $user['fullName']?></td>
        <td><?php echo $user['userType']?></td>
        <td><?php echo $user['accountStatus']?></td>
    </tr>
    <?php }?>
</table>