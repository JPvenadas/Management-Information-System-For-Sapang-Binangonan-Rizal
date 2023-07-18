<?php
  $voters = getTotalVoters('Registered');
  $nonVoters = getTotalVoters('Non-voter');
?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js?ver=1"></script>
<script type="text/javascript">
google.charts.load('current', {
    'packages': ['corechart']
});
google.charts.setOnLoadCallback(drawChart);


function drawChart() {

    var data = google.visualization.arrayToDataTable([
        ['Voter Status', 'Value', ],
        ['Registered', <?php echo $voters['number']?>],
        ['Non-voter', <?php echo $nonVoters['number']?>],
    ]);

    var options = {
        title: "Resident's Voter Status Chart",
        subtitle: 'Data from 587 Residents, !00% population',
        legend: 'none',
        backgroundColor: '#EAEAEA',
        slices: [{
            color: '#195FA0'
        }, {
            color: '#E8B80E'
        }],
        pieHole: '0.3',
        pieSliceBorderColor: "transparent",
        width: '260',
        height: '280',
        chartArea: {
            left: '40',
            width: "190",
            height: "190"
        }
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechart'));

    chart.draw(data, options);
}
</script>
<div class="third-division">
    <div id="piechart"></div>
</div>