<div id="minors-modal" class="modal-background-blur">
    <div class="modal-content-container">
        <div onclick="closeMinorsModal()" class="modal-close-button">
            <ion-icon name="close"></ion-icon>
        </div>
        <div class="modal-header">
            <h3>Select the Resident</h3>
            <input id="minor-filter" type="text" placeholder="Search Resident here" class="searchbar-transactions">
        </div>
        <div id="minor-list" class="resident-items-container">
        <?php
        $residents = getMinorResidents();
            foreach ($residents as $resident) {
               generateResidentItem($resident);
            }
        ?>
</div>
    </div>
</div>

<script>
    // script that will filter the residents
    let filterMinors = document.getElementById('minor-filter');
    let minorsList = document.getElementById('minor-list').children;

    filterMinors.addEventListener('input', (input) =>{
    filterContentFunction(input.target.value);
    })
    
    let filterContentFunction = (input)=>{
    for(var i=0; i<minorsList.length; i++){
            var child = minorsList[i];
            if(child.innerText.toLowerCase().includes(filterMinors.value.toLowerCase())){
          child.classList.remove('hide');
          
       }
       else{
          child.classList.add('hide');
       }
    }
}

 //Opening and closing of Modal
 let minorsModal = document.getElementById('minors-modal')
    minorsModal.style.display = "none"

    function closeMinorsModal() {
        minorsModal.style.display = "none"
        body.style.overflowY = "auto"
    }

    function openMinorsModal(purpose) {
        action = purpose;
        minorsModal.style.display = "flex"
        body.style.overflowY = "hidden"
        closeAddBlotterModal();
    }
</script>