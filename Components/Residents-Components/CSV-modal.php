<div id="csv-modal" class="modal-background-blur">
    <form enctype="multipart/form-data" method="post" action="../../Pages/Residents/Residents.php" class="modal-content-container">
        <!-- close button -->
        <div onclick="closeCSVModal()" class="modal-close-button">
            <ion-icon name="close"></ion-icon>
        </div>
        <div class="modal-content">
            <div class="modal-title">Add Residents via CSV</div>
            <div style="padding: 10px 0;" class="modal-instructions">To register a group of residents, simply upload a
                CSV file and the system
                will automatically process the registration upon submission. To avoid any errors, please ensure that the
                CSV file contains the appropriate fields. In case you don't have the required format, you can easily
                obtain it by clicking on the "Export CSV Format" button.</div>
            <div class="input-with-button">
                <input required style="width: 380px" required placeholder="Upload a CSV file"
                    name="text" id="csv-image-text" class="input" readonly type="text">
                <input required accept=".csv" id="csv-image" name="csvFile" hidden type="file">
                <label class="input-button" for="csv-image">
                    <p>Upload</p>
                </label>
            </div>
        </div>
        <div class="submit-button-container">
            <button onclick="return confirmSubmit()" type="submit" class="add-resident-button" name="submit_csv" type="submit">
                <ion-icon name="add-sharp"></ion-icon>
                <p>Submit CSV</p>
            </button>
        </div>
    </form>
</div>
<script>
let csvModal = document.querySelector('#csv-modal')

function confirmSubmit() {
    return confirm("All records inside the CSV file will be automatically imported to the database. Are you sure you want to Proceed?", 'Confirm Submission');
}

function openCSVModal() {
    csvModal.style.display = "flex";
    body.style.overflow = "hidden"
}

function closeCSVModal() {
    csvModal.style.display = "none";
    body.style.overflow = "auto"
}
let csvImage = document.querySelector("#csv-image");

csvImage.addEventListener('change', (event) => {
            let csvImageText = document.querySelector("#csv-image-text")
            var image = event.target.files[0]
            csvImageText.value = image.name
})
</script>