<div class="custom-filter">
        <div>
            <select class="combo" name="purok" id="purok">
                <option disabled value="" selected value="volvo">Filter By Purok</option>
                <?php
                    $puroks = getPuroks(); 
                    foreach($puroks as $purok){?>
                    <option default value="<?php echo $purok['purok']?>"><?php echo $purok['purok']?></option>
                    <?php } ?>
            </select>
        </div>
        <div>
            <select class="combo" name="age" id="age">
                <option disabled value="" selected value="volvo">Filter By Age</option>
                <option default value="Youths">Youth (below 18)</option>
                <option default value="Adults">Adult (19-59)</option>
                <option default value="Seniors">Senior (Above 60)</option>
            </select>
        </div>
       <div>
            <select class="combo" name="sex" id="sex">
                <option disabled value="" selected value="volvo">Filter By Sex</option>
                <option default value="Male">Male</option>
                <option default value="Female">Female</option>
                <option default value="Non-binary">Non-binary</option>
            </select>
       </div>
    </div>