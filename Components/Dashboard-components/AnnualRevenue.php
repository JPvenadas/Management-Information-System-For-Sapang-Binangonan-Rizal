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
      labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
      datasets: [{
        label: 'Revenues',
        data: ["1000", "2500", "4000", "3000","1000", "6700", "4000", "3000","1000", "4500", "4000", "3000"],
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

