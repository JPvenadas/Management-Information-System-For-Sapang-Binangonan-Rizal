<table>
    <tr>
        <th>ID</th>
        <th>Event Name</th>
        <th>Event Date</th>
        <th>Event Description</th>
    </tr>
    <?php
                        $events = getEvents();
                        foreach($events as $event){?>
    <tr>
        <td><?php echo $event['eventID']?></td>
        <td><?php echo $event['eventName']?></td>
        <td><?php echo $event['date']?></td>
        <td><?php echo $event['eventDescription']?></td>
    </tr>
    <?php }?>
</table>