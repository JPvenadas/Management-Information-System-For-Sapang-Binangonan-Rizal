<table>
    <tr>
        <th>ID</th>
        <th>Complainant</th>
        <th>Defendant</th>
        <th>Latest Hearing</th>
        <th>Total Hearing</th>
        <th>Case Status</th>
        <th>Summary</th>
    </tr>
    <?php
                        $blotters = getBlotters();
                        foreach($blotters as $blotter){?>
    <tr>
        <td><?php echo $blotter['blotterID']?></td>
        <td><?php echo $blotter['complainant']?></td>
        <td><?php echo $blotter['defendant']?></td>
        <td><?php echo $blotter['latestHearing']?></td>
        <td><?php echo $blotter['totalHearing']?></td>
        <td><?php echo $blotter['caseStatus']?></td>
        <td><?php echo $blotter['summary']?></td>
    </tr>
    <?php }?>
</table>