<table>
    <tr>
        <th>ID</th>
        <th>Full Name</th>
        <th>Position</th>
        <th>Date</th>
        <th>Time in</th>
        <th>Time out</th>
    </tr>
    <?php
                        $attendees = getAttendance();
                        foreach($attendees as $attendee){?>
    <tr>
        <td><?php echo $attendee['attendanceID']?></td>
        <td><?php echo $attendee['fullName']?></td>
        <td><?php echo $attendee['position']?></td>
        <td><?php echo $attendee['date']?></td>
        <td><?php echo $attendee['timeIn']?></td>
        <td><?php echo $attendee['timeOut']?></td>
    </tr>
    <?php }?>
</table>