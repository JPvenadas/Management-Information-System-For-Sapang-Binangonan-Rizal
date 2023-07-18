<?php date_default_timezone_set('Asia/Manila');?>
<div id="hearing-<?php echo $blotter['blotterID']?>" style="width: 100%;" class="hide">
    <?php if(!empty($blotter['hearing1'])){?>
    <div class="hearing">
        <div class="left">
            <p class="higlight-text">1</p>
            <input name="date_1" value="<?php echo $blotter['hearing1']?>"  
            <?php if($blotter['totalHearing'] == 1 and strtotime($blotter['hearing1']) > strtotime(date('Y-m-d'))){?>
               
            <?php }else{?>
                readonly
            <?php }?>
            type="date">
        </div>
        <div class="right">
            <?php if($blotter['totalHearing'] == 1 and strtotime($blotter['hearing1']) > strtotime(date('Y-m-d'))){?>
                <input id="add-hearing-<?php echo $blotter['blotterID']?>" name="resched" type="submit" class="small-button blue" value="Reschedule">
            <?php }else{?>
                <p style="font-weight: 400;font-size: 13px;color: #2E2E2E;">Finished</p>
            <?php }?>
        </div>
    </div>
    <?php }?>
    <?php if(!empty($blotter['hearing2'])){?>
    <div class="hearing">
        <div class="left">
            <p class="higlight-text">2</p>
            <input name="date_2" value="<?php echo $blotter['hearing2']?>"
            <?php if($blotter['totalHearing'] == 2 and strtotime($blotter['hearing2']) > strtotime(date('Y-m-d'))){?>
               
            <?php }else{?>
                   readonly
            <?php }?> type="date">
        </div>
        <div class="right">
            <?php if($blotter['totalHearing'] == 2 and strtotime($blotter['hearing2']) > strtotime(date("Y-m-d"))){?>
                <input id="add-hearing-<?php echo $blotter['blotterID']?>" name="resched" type="submit" class="small-button blue" value="Reschedule">
            <?php }else{?>
                <p style="font-weight: 400;font-size: 13px;color: #2E2E2E;">Finished</p>
            <?php }?>
        </div>
    </div>
    <?php }?>
    <?php if(!empty($blotter['hearing3'])){?>
    <div class="hearing">
        <div class="left">
            <p class="higlight-text">3</p>
            <input name="date_3" value="<?php echo $blotter['hearing3']?>"
            <?php if($blotter['totalHearing'] == 3 and strtotime($blotter['hearing3']) > strtotime(date('Y-m-d'))){?>
               
               <?php }else{?>
                      readonly
            <?php }?> type="date">
        </div>
        <div class="right">
            <?php if($blotter['totalHearing'] == 3 and strtotime($blotter['hearing3']) > strtotime(date("Y-m-d"))){?>
                <input id="add-hearing-<?php echo $blotter['blotterID']?>" name="resched" type="submit" class="small-button blue" value="Reschedule">
            <?php }else{?>
                <p style="font-weight: 400;font-size: 13px;color: #2E2E2E;">Finished</p>
            <?php }?>
        </div>
    </div>
    <?php }?>
</div>