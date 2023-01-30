<form action="?step=4" method="POST" class="form">
    <div class="limit-width">
        <h2 class="form-title">Other information</h2>
        <p class="text">Please fill the necessary information below</p>
        <!-- FirstName input -->
        <label class="label" for="sex">Sex</label>
        <input placeholder="Sex" id="sex" class="input" type="text">
        <!-- Purok -->
        <label class="label" for="purok">Purok</label>
        <input placeholder="Purok" id="purok" class="input" type="text">
        <!-- Street -->
        <label class="label" for="address">Address</label>
        <input placeholder="Exact Address (ex. Street, Home no.)" id="address" class="input" type="text">
        <!-- Voter Status -->
        <label class="label" for="voterStatus">Voter Status</label>
        <input placeholder="Voter's Status" id="voterStatus" class="input" type="text">
        <!-- Marital Status -->
        <label class="label" for="maritalStatus">Marital Status</label>
        <input placeholder="Marital Status" id="maritalStatus" class="input" type="text">
        <!-- Occupation -->
        <label class="label" for="occupation">Occupation</label>
        <input placeholder="Occupation" id="occupation" class="input" type="text">
        <!-- Resident Categories -->
        <label class="label" for="residentCategory">Resident Category</label>
        <input placeholder="Other Categories (ex. PWD, Indigent, etc)" id="residentCategory" class="input" type="text">
        <div class="multiple-choice-container">
            <p class="label">Head of the family</p>
            <div class="choices">
                <div>
                    <input onchange="showMemberInput()" type="radio" id="familyHead" name="familyHead" value="Yes">
                    <label class="text-small" for="familyHead">Yes</label>
                </div>
                <div>
                    <input onchange="showMemberInput()" type="radio" id="notFamilyHead" name="familyHead" value="No">
                    <label class="text-small" for="notFamilyHead">No</label>
                </div>
            </div>
        </div>
        <!-- Family Members -->
        <label id="labelMembers" class="label" for="familyMembers">Number of Family Members</label>
        <input placeholder="Number of Family Members" id="familyMembers" class="input" type="number">
    </div>
    <div class="button-group">
            <a href="?step=2" class="action-button">
                <p>Previous</p>
            </a>
            <button type="submit" class="action-button">
                <p>Next</p>
            </button>
    </div>
</form>
<script>
    let FamilyMembersInput = document.querySelector('#familyMembers');
    let labelMembers = document.querySelector('#labelMembers');
    
    const showMemberInput = () =>{
        var ele = document.querySelector("#familyHead")
                if(ele.checked){
                    FamilyMembersInput.style.display = "inline";
                    labelMembers.style.display = "inline";
                }
                else{
                    FamilyMembersInput.style.display = "none";
                    labelMembers.style.display = "none";
                }
    }
</script>