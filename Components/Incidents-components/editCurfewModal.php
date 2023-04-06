<div id="edit-curfew-modal" class="modal-background-blur">
    <form
        action="../../Pages/Incidents/Incidents.php?filter=<?php if(isset($_GET['filter'])){
            echo $_GET['filter'];
        }?>";
        method="post" class="edit modal-content-container">
        <div onclick="closeEditCurfewModal()" class="modal-close-button">
            <ion-icon name="close"></ion-icon>
        </div>
        <div class="modal-title">
            <p>Curfew Violation Record</p>
            <input type="hidden" id="ID" name="recordID">
        </div>
        <div class="curfew-information">
            <p>It has been officially recorded that <span id="fullName" class="highlight-text">Christine De la paz</span> broke the curfew rule on the night of <span id="date" class="highlight-text">April 2, 2023</span> , at exactly <span id="time" class="highlight-text">10:30 PM</span>. This means that he/she was out past the time that she was supposed to be home according to the rules, and his/her actions have been officially documented.</p>
        </div>
        <div class="divider"></div>
        <div class="button-container">
            <button class="white-button" id="archive-button" type="submit" name="archive_curfew">
                <ion-icon name="archive-sharp"></ion-icon>
                <p>Archive</p>
            </button>
        </div>
       
    </form>
</div>

<script>
let editcurfewModal = document.getElementById('edit-curfew-modal')
editcurfewModal.style.display = "none";

//open modal with content attached
function openEditCurfewModal(ID, resident, time, date) {
    editcurfewModal.style.display = 'flex';
    body.style.overflow = "hidden"

    document.querySelector('#ID').value = ID;
    document.querySelector("#fullName").innerHTML = resident;
    document.querySelector("#time").innerHTML = time;
    document.querySelector("#date").innerHTML = date;
}
function closeEditCurfewModal(){
    editcurfewModal.style.display = 'none';
    body.style.overflow = "auto"
}

</script>