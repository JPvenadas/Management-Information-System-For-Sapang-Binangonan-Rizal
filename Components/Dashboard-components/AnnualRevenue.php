<?php
  //get the months (last 12 months)
  $months = [date('M')];
 $t = new Datetime();
 $interval = new DateInterval("P1M");
 for($i=0;$i<11;$i++){
     $months[]= $t->sub($interval)->format('M')."\n";
 }
 $months = array_reverse($months);

 //get the revenues from the database for every each month
 $revenues = [];
 foreach($months as $month){
  $monthFormated =  date('m', strtotime($month));
  $revenue = getRevenues($monthFormated);
  $revenues[] = $revenue['revenue'];
 }
?>

<div class="revenues-section">
    <h3 class="section-title">Annual Revenues from services</h3>
    <div class="graph-container">
    <canvas id="myChart"></canvas>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
console.log('hello')
const ctx = document.getElementById('myChart');

var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: <?php echo json_encode($months)?>,
      datasets: [{
        label: 'Revenues',
        data: <?php echo json_encode($revenues); ?>,
        backgroundColor: ['#E8B80E', '#195FA0', '#35CA32', '#E6453A'],
        
      }]
    },
    options: {
        plugins: {
            legend: false,
        },
        events: [],
      scales: {
        y: {
          beginAtZero: true,
        },
        x:{
            grid: {
          display: false,
        }
        },
        y: {
        grid: {
          display: false
        }
      },
      }
    }
  });
</script>

