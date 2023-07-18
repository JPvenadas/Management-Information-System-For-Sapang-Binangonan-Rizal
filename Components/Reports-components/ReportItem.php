<?php function generateItem($name, $description, $image, $shortName){?>
<a href="../../Pages/Reports/ReportPreview.php?content=<?php echo $shortName?>"><button type="submit" name="view_report_button" class="report-item-record">
    <div class="report-info-container">
        <div class="report-image-container">
            <img src="<?php echo $image?>" class="report-image" alt="">
        </div>
        <div class="report-info">
            <p class="report-name"><?php echo $name?></p>
            <p class="report-description"><?php echo $description?></p>
        </div>
    </div>
    <div class="action-text">
        <p>Generate Reports</p>
    </div>
</button>
</a>
<?php } ?>