<script>
    let selectedService
    let selectedServiceFee 
    let selectedServiceType
</script>
<div id="residents-modal" class="modal-background-blur">
    <div class="modal-content-container">
        <div onclick="closeResidentModal()" class="modal-close-button">
            <ion-icon name="close"></ion-icon>
        </div>
        <div class="modal-header">
            <h3>Choose a Resident Issuee</h3>
            <input id="resident-filter" type="text" placeholder="Search Resident here" class="searchbar-transactions">
        </div>
        <div id="residents-list" class="resident-items-container">
        <?php require "residentItem.php";
        $residents = getResidents();
            foreach ($residents as $resident) {
               generateResidentItem($resident);
            }
        ?>
</div>
    </div>
</div>

<script>

    // script that will filter the residents
    let filterResident = document.getElementById('resident-filter');
    let residentsList = document.getElementById('residents-list').children;
    
    filterResident.addEventListener('input', (input) =>{
    filtercontent(input.target.value);
    })
    let filtercontent = (input)=>{

    for(var i=0; i<residentsList.length; i++){
            var child = residentsList[i];
            if(child.innerText.toLowerCase().includes(filterResident.value.toLowerCase())){
          child.classList.remove('hide');
          
       }
       else{
          child.classList.add('hide');
       }
    }
    }

 //Opening and closing of Modal
 let residentsModal = document.getElementById('residents-modal')
    let body = document.querySelector('body')
    residentsModal.style.display = "none"

    function closeResidentModal() {
        residentsModal.style.display = "none"
        body.style.overflowY = "auto"
    }

    function openResidentModal(service, fee, type) {
        residentsModal.style.display = "flex"
        body.style.overflowY = "hidden"

        //set the values passed to the hidden inputs
        selectedService = service
        selectedServiceFee = fee
        selectedServiceType = type
    }
</script>