<!-- this file contains only data lists. this will add options to the inputs in the registration section -->

<!-- get the puroks registered in the system -->
<datalist id="purok">
    <?php
        $puroks = getPuroks();
        foreach ($puroks as $purok) {?>
            <option value="<?php echo $purok['purokID']?>"><?php echo $purok['purokName']?></option>
    <?php }?>
    ?>
</datalist>
<datalist id="sex">
    <option value="Male"></option>
    <option value="Female"></option>
    <option value="Transagender"></option>
    <option value="Non-binary"></option>
    <option value="Prefer not to disclose"></option>
</datalist>
<datalist id="voterStatus">
    <option value="Registered">Registered</option>
    <option value="Non-voter">Non-voter</option>
</datalist>
<datalist id="maritalStatus">
    <option value="Single">Single</option>
    <option value="Married">Married</option>
    <option value="Widow">Widow</option>
</datalist>
<datalist id="residentCategory">
    <option value="PWD">PWD</option>
    <option value="Indigent">Indigent</option>
    <option value="Senior">Senior</option>
</datalist>