<form action="?step=4" method="POST" class="form">
    <div class="limit-width">
        <h2 class="form-title">Other information</h2>
        <p class="text">Please fill the necessary information below</p>

        <!-- FirstName input -->
        <label class="label" for="sex">Sex</label>
        <input list="sex" required required placeholder="Sex" name="sex" id="sex" class="input" type="text"
        value="<?php inputContent('sex'); ?>">

        <!-- Purok -->
        <label class="label" for="purok">Purok</label>
        <input autocomplete="off" list="purok" required placeholder="Purok" id="purok" name="purok" class="input" type="text"
        value="<?php inputContent('purok'); ?>">

        <!-- Street -->
        <label class="label" for="address">Address</label>
        <input autocomplete="off" placeholder="Exact Address (ex. Street, Home no.)" required id="address" name="address" class="input" type="text"
        value="<?php inputContent('address'); ?>">

        <!-- Voter Status -->
        <label list="voterStatus" class="label" for="voterStatus">Voter Status</label>
        <input placeholder="Voter's Status" required id="voterStatus" name="voterStatus" class="input" type="text"
        value="<?php inputContent('voterStatus'); ?>">

        <!-- Marital Status -->
        <label class="label" for="maritalStatus">Marital Status</label>
        <input placeholder="Marital Status" required id="maritalStatus" name="maritalStatus" class="input" type="text"
        value="<?php inputContent('maritalStatus'); ?>">

        <!-- Occupation -->
        <label class="label" for="occupation">Occupation</label>
        <input autocomplete="off" placeholder="Occupation" required id="occupation" name="occupation" class="input" type="text"
        value="<?php inputContent('occupation'); ?>">

        <!-- Resident Categories -->
        <input list="residentCategory" placeholder="Other Categories (ex. PWD, Indigent, etc)" id="residentCategory" name="residentCategory" class="input" type="hidden"
        value="<?php inputContent('residentCategory'); ?>">

        <div class="multiple-choice-container">
            <p class="label">Head of the family</p>
            <div class="choices">
                <div>
                    <input onchange="showMemberInput()" type="radio" id="familyHead" name="familyHead" value="Yes"
                    <?php checkradio("Yes") ?>>
                    <label class="text-small" for="familyHead">Yes</label>
                </div>
                <div>
                    <input onchange="showMemberInput()" type="radio" id="notFamilyHead" name="familyHead" value="No"
                    <?php checkradio("No") ?>>
                    <label class="text-small" for="notFamilyHead">No</label>
                </div>
            </div>
        </div>
        <!-- Family Members -->
        <label id="labelMembers" class="label" for="familyMembers">Number of Family Members</label>
        <input placeholder="Number of Family Members" min="1" id="familyMembers" name="familyMembers" class="input" type="number"
        value="<?php inputContent('familyMembers');?>">
    </div>
    <div class="button-group">
            <a href="?step=2" class="action-button">
                <p>Previous</p>
            </a>
            <button name="next3" type="submit" class="action-button">
                <p>Next</p>
            </button>
    </div>
</form>
<script>
    let FamilyMembersInput = document.querySelector('#familyMembers');
    let labelMembers = document.querySelector('#labelMembers');
    var yesRadio = document.querySelector("#familyHead")
    
    if(yesRadio.checked){
                    FamilyMembersInput.style.display = "inline";
                    labelMembers.style.display = "inline";
    }
    const showMemberInput = () =>{
        
                if(yesRadio.checked){
                    FamilyMembersInput.style.display = "inline";
                    labelMembers.style.display = "inline";
                }
                else{
                    FamilyMembersInput.style.display = "none";
                    labelMembers.style.display = "none";
                }
    }
</script>