<div id="add-service" class="modal-background-blur">
    <div class="modal-content-container">
        <div onclick="closeAddService()" class="modal-close-button">
            <ion-icon name="close"></ion-icon>
        </div>
        <form action="../../Pages/Settings/Settings.php?page=services" method="post" class="container">
            <p>Add Barangay Service</p>
                <input name="serviceName" autocomplete="off" type="text" required placeholder="Service Name" class="input">
                <input name="serviceFee" autocomplete="off" type="number" required placeholder="service Fee" class="input">
                <button name="add_service" class="add-button width-499">
                    <ion-icon name="add-sharp"></ion-icon>
                    <p>Add a Service</p>
                </button>
        </form>
    </div>
</div>

<script>
let addServiceModal = document.getElementById('add-service')
addServiceModal.style.display = 'none'

function closeAddService() {
    addServiceModal.style.display = "none"
    body.style.overflowY = "auto"
}

function openAddService() {

    addServiceModal.style.display = "flex"
    body.style.overflowY = "hidden"

}
</script>