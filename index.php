<?php

require('header.html');

require('calc.php');

require('data.php'); 
$con = mysqli_connect($host, $user, $pas) or die ('Error con'); 
mysqli_select_db($con, $db) or die ('Error db'); 
$query = "SELECT `sum` FROM `expenses` WHERE `article`='Еда'"; 
$res = mysqli_query($con, $query); 
$summa1 = 0; 
foreach($res as $result) { 
    $summa1 += array_sum($result); 
} 

$query = "SELECT `sum` FROM `expenses` WHERE `article`='Какая-то'"; 
$res = mysqli_query($con, $query); 
$summa2 = 0; 
foreach($res as $result) { 
    $summa2 += array_sum($result); 
} 

$query = "SELECT `sum` FROM `expenses` WHERE `article`='Бизнес'"; 
$res = mysqli_query($con, $query); 
$summa3 = 0; 
foreach($res as $result) { 
    $summa3 += array_sum($result); 
} 

?> 

<!DOCTYPE html> 
<html> 
<head> 
    <title>Google Charts Example</title> 
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> 
    <script type="text/javascript"> 
        google.charts.load('current', {'packages':['corechart']}); 
        google.charts.setOnLoadCallback(drawChart); 

        function drawChart() { 
            var data = google.visualization.arrayToDataTable([ 
                ['Category', 'Sum'], 
                ['Еда', <?php echo $summa1; ?>], 
                ['Какая-то', <?php echo $summa2; ?>], 
                ['Бизнес', <?php echo $summa3; ?>] 
            ]); 

            var options = { 
                title: 'Expenses by Category', 
                curveType: 'function', 
                legend: { position: 'bottom' } 
            }; 

            var chart = new google.visualization.PieChart(document.getElementById('air')); 
            chart.draw(data, options); 
        } 
    </script> 
</head> 
<body> 
    <div id="air" style="width: 500px; height: 400px;"></div> 
</body> 
</html> 