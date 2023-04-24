<table>
    <tr>
        <th>ID</th>
        <th>Message</th>
        <th>Recipients</th>
        <th>Date Posted</th>
        <th>Posted by</th>
    </tr>
    <?php
                        $announcements = getAnnouncements();
                        foreach($announcements as $announcement){?>
    <tr>
        <td><?php echo $announcement['announcementID']?></td>
        <td><?php echo $announcement['message']?></td>
        <td><?php echo $announcement['recepients']?></td>
        <td><?php echo $announcement['datePosted']?></td>
        <td><?php echo $announcement['fullName']?></td>
    </tr>
    <?php }?>
</table>