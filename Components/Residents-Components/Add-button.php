<div class="add-button-container">
    <div class="add-buttons">
        <button>Add a Resident</button>
        <button>Add Residents via CSV</button>
        <button>Export CSV Format</button>
    </div>
    <button class="circle">
        <ion-icon name="person-add"></ion-icon>
    </button>
</div>

<script>
    let add = document.querySelector(".circle")
    let buttonList = document.querySelector(".add-buttons")
    let showButtonList = false

    add.addEventListener('click', ()=>{
        showButtonList = !showButtonList
        if(showButtonList){
            buttonList.style.display = "flex";
        }else{
            buttonList.style.display = "none";
        }
    })
</script>