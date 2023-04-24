<div onclick="openModal()" class="add-button-container">
    <button class="circle">
        <ion-icon name="add"></ion-icon>
    </button>
</div>
<script>
    function openModal(){
        <?php 
            if(isset($_GET['filter']) && $_GET['filter'] == 'curfew'){
        ?>
                openResidentModal("curfewViolator");
        <?php
            }else{
        ?>
                openAddBlotterModal();
        <?php
            }    
        ?>
    }
</script>