<h3 class="section-title">
    <?php 
        if(isset($_GET['date']) and $_GET['date'] != date('Y-m-d')){
           $dateSet = $_GET['date'];
           $dateSet = date("F, d, Y", strtotime($dateSet));
           echo "$dateSet Attendance";
        }else{
            echo "Today's Attendance";
        }
    ?>
</h3>
<div id="employee-list" class="current-attendance-container">
    <?php 
    if(isset($_GET['date']) and $_GET['date'] != date('Y-m-d')){
        require "PastAttendanceItem.php";
        $employees = getEmployeeByDate();
         foreach($employees as $employee){
        generateItem($employee);
        }
    }else{
        require "AttendanceItem.php";
        $employees = getEmployeeAttendance();
         foreach($employees as $employee){
        generateItem($employee);
        }
    }
    
    ?>
</div>
<script>
    // script that will filter the residents
    let search = document.getElementById('search');
    let employeeList = document.getElementById('employee-list').children;
    
    search.addEventListener('input', (input) =>{
        filtercontent(input.target.value);
    })

    let filtercontent = (input)=>{

        for(var i=0; i<employeeList.length; i++){
            var child = employeeList[i];
            if(child.innerText.toLowerCase().includes(search.value.toLowerCase())){
            child.classList.remove('hide');
        }
       else{
          child.classList.add('hide');
       }
    }
}
</script>