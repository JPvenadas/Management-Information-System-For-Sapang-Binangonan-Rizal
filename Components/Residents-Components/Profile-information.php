<?php  require "Profile-info-Item.php";
       include "Datalists.php";
function AttachPersonalInfo($resident){
    generateInfoItem("firstName","First Name", $resident['firstName'], "text");
    generateInfoItem("middleName","Middle Name", $resident['middleName'], "text");
    generateInfoItem("lastName","Last Name", $resident['lastName'], "text");
    generateInfoItem("extension","Name Extension", $resident['extension'], "text");
    generateInfoItem("birthDate","Birth Date", $resident['birthDate'], "date");
    generateInfoItem("sex","Sex", $resident['sex'], "text");
    generateInfoItem("purok","Purok", $resident['purok'], "text");
    generateInfoItem("address","Address", $resident['exactAddress'], "text");
    generateInfoItem("voterStatus","Voter's Status", $resident['voterStatus'], "text");
    generateInfoItem("maritalStatus","Marital Status", $resident['maritalStatus'], "text");
    generateInfoItem("occupation","Occupation", $resident['occupation'], "text");
    generateInfoItem("residentCategory","Resident Category", $resident['residentCategory'], "text");
    generateInfoItem("familyHead","Family Head", $resident['familyHead'], "text");
    if($resident['familyHead'] == "Yes"){
        generateInfoItem("familyMembers","Number of Family Members", $resident['familyMembers'], "number");
    }
    generateInfoItem("contactNo","Contact Number", $resident['contactNo'], "text");
}?>

<script>
//function to execute when "edit personal info is clicked"
function enableEditing() {
//get the elements
    //all of the inputs in the personal information section
    let inputs = document.getElementsByClassName("personal-information-value");
    //edit personal info button
    let enableEditButton = document.querySelector(".edit-button")
    //save and cancel button 
    let cancelButton = document.querySelector(".cancel-editing")
    let saveButton = document.querySelector(".save-editing")


    //show save and cancel button
    cancelButton.style.display = "flex"
    saveButton.style.display = "flex"

    //loop to select all inputs
    for (var i = 0; i < inputs.length; i++) {
        //enable the inputs
        inputs[i].disabled = false;
        enableEditButton.style.display = 'none'
    }

}
</script>