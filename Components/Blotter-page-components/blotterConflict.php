<div class="header">
    <h3 class="title">Case conflict</h3>
    <button id="edit-conflict" class="underlined-button">
        <ion-icon name="pencil"></ion-icon>
        <p>Edit</p>
    </button>
</div>
<form action="" method="post" style="display:flex; flex-direction: column; gap: 10px">
    <textarea class="long-input" disabled id="blotter-textarea"><?php echo $blotter['summary'] ?></textarea>
    <div class='small-button-container' style="display:none;">
        <button name="edit_conflict" class="small-button" id="save-button">Save</button>
        <div class="small-button" id="cancel-button">Cancel</div>
    </div>
</form>

<script>
const editButton = document.getElementById('edit-conflict');
const textarea = document.getElementById('blotter-textarea');
const saveButton = document.getElementById('save-button');
const cancelButton = document.getElementById('cancel-button');
const buttonContainer = document.querySelector('.small-button-container');

editButton.addEventListener('click', () => {
    textarea.removeAttribute('disabled');
    buttonContainer.style.display = 'flex';
    editButton.style.display = 'none';
    textarea.style.cursor = 'pointer';
});

cancelButton.addEventListener('click', () => {
    textarea.value = '<?php echo $blotter['summary'] ?>';
    textarea.setAttribute('disabled', 'true');
    textarea.style.cursor = 'not-allowed';
    buttonContainer.style.display = 'none';
    editButton.style.display = 'flex';
});
</script>