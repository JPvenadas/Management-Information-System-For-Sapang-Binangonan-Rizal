<div class="filter-options">
    <label for="residents" class="option">
        <p>All Residents</p>
        <input checked id="residents" value="All Residents" name="filter" type="radio">
    </label>
    <label for="employees" class="option">
        <p>All Employees</p>
        <input id="employees" value="All Employees" name="filter" type="radio">
    </label>
    <label for="heads" class="option">
        <p>Head of the Family</p>
        <input id="heads" value="Family Heads" name="filter" type="radio">
    </label>
    <label for="custom" class="option">
        <p>Custom</p>
        <input id="custom" value="Custom" name="filter" type="radio">
    </label>
   <?php include "comboBoxes.php"?>
</div>
<script>
    let filterContainer = document.querySelector(".filter-options");
    let filterRadios = document.getElementsByClassName("option");
    let customOption = document.querySelector('#custom');
    let customFilterContainer = document.querySelector('.custom-filter');
    let comboBoxes = document.getElementsByClassName("combo");
    let filterShown = false;

    //individual radio
    residentsRadio = document.querySelector('#residents')
    employeesRadio = document.querySelector('#employees')
    heads = document.querySelector('#heads')

    function openFilter(){
       filterShown? filterContainer.style.display = 'none': filterContainer.style.display = 'block'
       filterShown? filterShown = false: filterShown = true
    }

    //the loop will apply the code inside to every each radio button
    for (var i = 0; i < filterRadios.length; i++) {
        //add an event listener and check if the "custom" radio button is checked
        filterRadios[i].addEventListener('change', function() {
            if(customOption.checked){
                //if checked show the custom filter options(combo boxes)
                customFilterContainer.style.display = 'flex'
                document.querySelector('#filter-value').value = "Custom"
            }else{
                //if not close the other filter and clear the values
                customFilterContainer.style.display = 'none'
                for (var a = 0; a < comboBoxes.length; a++) {
                    comboBoxes[a].selectedIndex = 0;
                }

                if(residentsRadio.checked){
                document.querySelector('#filter-value').value = "All Residents"
                openFilter()
                }else if(employeesRadio.checked){
                    document.querySelector('#filter-value').value = "All Employees"
                    openFilter()
                }else if(heads.checked){
                    document.querySelector('#filter-value').value = "Family Heads"
                    openFilter()
                }
            }
    });
}
</script>