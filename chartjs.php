<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "chartjs";
$con = new mysqli($servername, $username, $password, $db);
$all_uname = array();
$all_salary = array();
$user = mysqli_query($con, "SELECT * FROM `salary`");
while ($all_row = mysqli_fetch_assoc($user)) {
    $uname = "'".$all_row['name']."'";
    $usalary = $all_row['amount'];
    array_push($all_uname, $uname);
    array_push($all_salary, $usalary);
}

$aaa = implode(", ", $all_uname);
$bbb = implode(", ", $all_salary);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>All Chart JS</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
* {
  box-sizing: border-box;
}

/* Create three equal columns that floats next to each other */
.column {
  float: left;
  width: 33.33%;
  padding: 10px;
  height: 400px; /* Should be removed. Only for demonstration */
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}
</style>
</head>
<body>

<div class="row">
  <div class="column" style="background-color:;">
    <h2>Bar Chart</h2>
    <div style="width: 50%; height: 50%;">
    <canvas id="barChart" style=""></canvas>
</div>  
  </div>
  <div class="column" style="background-color:;">
    <h2>Line Chart</h2>
    <div style="width: 50%; height: 50%;">
    <canvas id="lineChart" style=""></canvas>
</div>
  </div>
  <div class="column" style="background-color:;">
    <h2>Pie Chart</h2>
    <div style="width: 50%; height: 50%;">
    <canvas id="pieChart" style=""></canvas>
</div>
  </div>
</div>





<script>

const barCtx = document.getElementById('barChart').getContext("2d");
const nam = [<?php echo $aaa; ?>];
const val = [<?php echo $bbb; ?>];
const barConfig = {
    type: 'bar',
    data: {
        labels: nam,
        datasets: [{
            label: '# Bar Chart',
            data: val,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
};
const barChart = new Chart(barCtx, barConfig);




// =============================================================================================
const lineCtx = document.getElementById('lineChart');
const labels = nam;
const lineData = {
labels: labels,
datasets: [{
  label: '# Line Chart JS',
  backgroundColor: 'rgb(255, 99, 132)',
  borderColor: 'rgb(255, 99, 132)',
  data: val,
}]
};
const lineConfig = {
type: 'line',
data: lineData,
options: {}
};
const lineChart = new Chart(lineCtx, lineConfig);




// =============================================================================================
const pieCtx = document.getElementById('pieChart');
const pieData = {
  labels: nam,
  datasets: [{
    label: '# Pie Chart JS',
    data: val,
    backgroundColor: [
      'rgb(255, 99, 132)',
      'rgb(54, 162, 235)',
      'rgb(255, 205, 86)',
      'rgb(255,0,255)',
    ],
    hoverOffset: 4
  }]
};
const pieConfig = {
  type: 'pie',
  data: pieData,
};
const pieChart = new Chart(pieCtx, pieConfig);

</script>

</body>
</html>