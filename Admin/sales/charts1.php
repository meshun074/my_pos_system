<?php
include("../server/connection.php");
include '../set.php';


// $sql = "SELECT SUM(total) AS AMOUNTS, YEAR(date(date)) AS YEARS FROM sales  GROUP BY YEAR(date(date)) ORDER BY YEAR(date(date))";
$sql = "SELECT DISTINCT t3.stotal-t3.sreturn AS AMOUNTS, IF( STRCMP(ADAY,DAY)=0, ADAY, CONCAT(ADAY,DAY)) AS YEARS FROM (
  SELECT  COALESCE(t1.AMOUNTS,0) AS sreturn, COALESCE(t1.YEARS,'') AS ADAY, COALESCE(t2.AMOUNTS,0) AS stotal, COALESCE( t2.YEARS,'') AS DAY
  FROM 
  (SELECT SUM(total) AS AMOUNTS, YEAR(date(date)) AS YEARS FROM sales_return  GROUP BY YEAR(date(date)) ORDER BY YEAR(date(date))) t1 
  RIGHT JOIN 
  (SELECT IF(STRCMP(t4.YEARS,t5.YEARS)=0,t4.AMOUNTS-t5.AMOUNTS,t4.AMOUNTS) AS AMOUNTS, t4.YEARS FROM (
SELECT SUM(total) AS AMOUNTS, YEAR(date(date)) AS YEARS FROM sales  GROUP BY YEAR(date(date)) ORDER BY YEAR(date(date))) t4
LEFT JOIN
(SELECT SUM(balance) AS AMOUNTS, YEAR(date(transaction_date)) AS YEARS FROM credits  GROUP BY YEAR(date(transaction_date)) ORDER BY YEAR(date(transaction_date)))t5 ON t4.YEARS=t5.YEARS ) t2 
  ON t1.YEARS = t2.YEARS
  UNION ALL
  
  SELECT COALESCE(t1.AMOUNTS,0) AS sreturn, COALESCE(t1.YEARS,'') AS ADAY, COALESCE(t2.AMOUNTS,0) AS stotal, COALESCE( t2.YEARS,'') AS DAY
  FROM 
  (SELECT SUM(total) AS AMOUNTS, YEAR(date(date)) AS YEARS FROM sales_return  GROUP BY YEAR(date(date)) ORDER BY YEAR(date(date))) t1 
  LEFT JOIN 
  (SELECT IF(STRCMP(t4.YEARS,t5.YEARS)=0,t4.AMOUNTS-t5.AMOUNTS,t4.AMOUNTS) AS AMOUNTS, t4.YEARS FROM (
SELECT SUM(total) AS AMOUNTS, YEAR(date(date)) AS YEARS FROM sales  GROUP BY YEAR(date(date)) ORDER BY YEAR(date(date))) t4
LEFT JOIN
(SELECT SUM(balance) AS AMOUNTS, YEAR(date(transaction_date)) AS YEARS FROM credits  GROUP BY YEAR(date(transaction_date)) ORDER BY YEAR(date(transaction_date)))t5 ON t4.YEARS=t5.YEARS ) t2 
  ON t1.YEARS = t2.YEARS) AS t3";
$result	= mysqli_query($db, $sql);

// $sql1 = "SELECT SUM(total) AS AMOUNTS, MONTHNAME(date(date)) AS MONTHS FROM sales WHERE YEAR(date(date))=YEAR(CURDATE()) GROUP BY MONTH(date(date)) ORDER BY MONTH(date(date))";
$sql1 = "SELECT DISTINCT t3.stotal-t3.sreturn AS AMOUNTS, IF( STRCMP(ADAY,DAY)=0, ADAY, CONCAT(ADAY,DAY)) AS MONTHS FROM (
  SELECT  COALESCE(t1.AMOUNTS,0) AS sreturn, COALESCE(t1.MONTHS,'') AS ADAY, COALESCE(t2.AMOUNTS,0) AS stotal, COALESCE( t2.MONTHS,'') AS DAY
  FROM 
  (SELECT SUM(total) AS AMOUNTS, MONTHNAME(date(date)) AS MONTHS FROM sales_return WHERE YEAR(date(date))=YEAR(CURDATE()) GROUP BY MONTH(date(date)) ORDER BY MONTH(date(date))) t1 
  RIGHT JOIN 
  (SELECT IF(STRCMP(t4.MONTHS,t5.MONTHS)=0,t4.AMOUNTS-t5.AMOUNTS,t4.AMOUNTS) AS AMOUNTS, t4.MONTHS FROM 
(SELECT SUM(total) AS AMOUNTS, MONTHNAME(date(date)) AS MONTHS FROM sales WHERE YEAR(date(date))=YEAR(CURDATE()) GROUP BY MONTH(date(date)) ORDER BY MONTH(date(date)) ) t4
LEFT JOIN
(SELECT SUM(balance) AS AMOUNTS, MONTHNAME(date(transaction_date)) AS MONTHS FROM credits WHERE YEAR(date(transaction_date))=YEAR(CURDATE()) GROUP BY MONTH(date(transaction_date)) ORDER BY MONTH(date(transaction_date)))t5 ON t4.MONTHS=t5.MONTHS ) t2 
  ON t1.MONTHS = t2.MONTHS
  UNION ALL
  
  SELECT COALESCE(t1.AMOUNTS,0) AS sreturn, COALESCE(t1.MONTHS,'') AS ADAY, COALESCE(t2.AMOUNTS,0) AS stotal, COALESCE( t2.MONTHS,'') AS DAY
  FROM 
  (SELECT SUM(total) AS AMOUNTS, MONTHNAME(date(date)) AS MONTHS FROM sales_return WHERE YEAR(date(date))=YEAR(CURDATE()) GROUP BY MONTH(date(date)) ORDER BY MONTH(date(date))) t1 
  LEFT JOIN 
  (SELECT IF(STRCMP(t4.MONTHS,t5.MONTHS)=0,t4.AMOUNTS-t5.AMOUNTS,t4.AMOUNTS) AS AMOUNTS, t4.MONTHS FROM 
(SELECT SUM(total) AS AMOUNTS, MONTHNAME(date(date)) AS MONTHS FROM sales WHERE YEAR(date(date))=YEAR(CURDATE()) GROUP BY MONTH(date(date)) ORDER BY MONTH(date(date)) ) t4
LEFT JOIN
(SELECT SUM(balance) AS AMOUNTS, MONTHNAME(date(transaction_date)) AS MONTHS FROM credits WHERE YEAR(date(transaction_date))=YEAR(CURDATE()) GROUP BY MONTH(date(transaction_date)) ORDER BY MONTH(date(transaction_date)))t5 ON t4.MONTHS=t5.MONTHS ) t2 
  ON t1.MONTHS = t2.MONTHS) AS t3";
$result1	= mysqli_query($db, $sql1);

// $sql2 = "SELECT SUM(total) AS AMOUNTS, concat('Week ',WEEK(FROM_DAYS(TO_DAYS(date) -MOD(TO_DAYS(date) -1, 7)),2)) AS WEEKS FROM sales WHERE YEAR(date(date))=2022 GROUP BY FROM_DAYS(TO_DAYS(date) -MOD(TO_DAYS(date) -1, 7)) ORDER BY FROM_DAYS(TO_DAYS(date) -MOD(TO_DAYS(date) -1, 7))";
$sql2 = "SELECT DISTINCT t3.stotal-t3.sreturn AS AMOUNTS, IF( STRCMP(ADAY,DAY)=0, ADAY, CONCAT(ADAY,DAY)) AS WEEKS FROM (
  SELECT  COALESCE(t1.AMOUNTS,0) AS sreturn, COALESCE(t1.WEEKS,'') AS ADAY, COALESCE(t2.AMOUNTS,0) AS stotal, COALESCE( t2.WEEKS,'') AS DAY
  FROM 
  (SELECT SUM(total) AS AMOUNTS, concat('Week ',WEEK(FROM_DAYS(TO_DAYS(date) -MOD(TO_DAYS(date) -1, 7)),2)) AS WEEKS FROM sales_return WHERE YEAR(date(date))=2022 GROUP BY FROM_DAYS(TO_DAYS(date) -MOD(TO_DAYS(date) -1, 7)) ORDER BY FROM_DAYS(TO_DAYS(date) -MOD(TO_DAYS(date) -1, 7))) t1 
  RIGHT JOIN 
  (SELECT IF(STRCMP(t4.WEEKS,t5.WEEKS)=0,t4.AMOUNTS-t5.AMOUNTS,t4.AMOUNTS) AS AMOUNTS, t4.WEEKS FROM 
(SELECT SUM(total) AS AMOUNTS, concat('Week ',WEEK(FROM_DAYS(TO_DAYS(date) -MOD(TO_DAYS(date) -1, 7)),2)) AS WEEKS FROM sales WHERE YEAR(date(date))=2022 GROUP BY FROM_DAYS(TO_DAYS(date) -MOD(TO_DAYS(date) -1, 7)) ORDER BY FROM_DAYS(TO_DAYS(date) -MOD(TO_DAYS(date) -1, 7)) ) t4
LEFT JOIN
(SELECT SUM(balance) AS AMOUNTS, concat('Week ',WEEK(FROM_DAYS(TO_DAYS( transaction_date) -MOD(TO_DAYS( transaction_date) -1, 7)),2)) AS WEEKS FROM credits WHERE YEAR(date( 	transaction_date))=YEAR(NOW()) GROUP BY FROM_DAYS(TO_DAYS( transaction_date) -MOD(TO_DAYS( transaction_date) -1, 7)) ORDER BY FROM_DAYS(TO_DAYS( transaction_date) -MOD(TO_DAYS( transaction_date) -1, 7)))t5 ON t4.WEEKS=t5.WEEKS) t2 
  ON t1.WEEKS = t2.WEEKS
  UNION ALL
  
  SELECT COALESCE(t1.AMOUNTS,0) AS sreturn, COALESCE(t1.WEEKS,'') AS ADAY, COALESCE(t2.AMOUNTS,0) AS stotal, COALESCE( t2.WEEKS,'') AS DAY
  FROM 
  (SELECT SUM(total) AS AMOUNTS, concat('Week ',WEEK(FROM_DAYS(TO_DAYS(date) -MOD(TO_DAYS(date) -1, 7)),2)) AS WEEKS FROM sales_return WHERE YEAR(date(date))=2022 GROUP BY FROM_DAYS(TO_DAYS(date) -MOD(TO_DAYS(date) -1, 7)) ORDER BY FROM_DAYS(TO_DAYS(date) -MOD(TO_DAYS(date) -1, 7))) t1 
  LEFT JOIN 
  (SELECT IF(STRCMP(t4.WEEKS,t5.WEEKS)=0,t4.AMOUNTS-t5.AMOUNTS,t4.AMOUNTS) AS AMOUNTS, t4.WEEKS FROM 
(SELECT SUM(total) AS AMOUNTS, concat('Week ',WEEK(FROM_DAYS(TO_DAYS(date) -MOD(TO_DAYS(date) -1, 7)),2)) AS WEEKS FROM sales WHERE YEAR(date(date))=2022 GROUP BY FROM_DAYS(TO_DAYS(date) -MOD(TO_DAYS(date) -1, 7)) ORDER BY FROM_DAYS(TO_DAYS(date) -MOD(TO_DAYS(date) -1, 7)) ) t4
LEFT JOIN
(SELECT SUM(balance) AS AMOUNTS, concat('Week ',WEEK(FROM_DAYS(TO_DAYS( transaction_date) -MOD(TO_DAYS( transaction_date) -1, 7)),2)) AS WEEKS FROM credits WHERE YEAR(date( 	transaction_date))=YEAR(NOW()) GROUP BY FROM_DAYS(TO_DAYS( transaction_date) -MOD(TO_DAYS( transaction_date) -1, 7)) ORDER BY FROM_DAYS(TO_DAYS( transaction_date) -MOD(TO_DAYS( transaction_date) -1, 7)))t5 ON t4.WEEKS=t5.WEEKS) t2 
  ON t1.WEEKS = t2.WEEKS) AS t3";
$result2	= mysqli_query($db, $sql2);

// $sql3 = "SELECT SUM(total) AS AMOUNTS, concat(DATE(date),' ',DAYNAME(date)) as DAYS FROM sales WHERE DATE_SUB(CURDATE(),INTERVAL 15 DAY) <= sales.date GROUP BY DATE(date)";
$sql3 = "SELECT DISTINCT t3.stotal-t3.sreturn AS AMOUNTS, IF( STRCMP(ADAY,DAY)=0, ADAY, CONCAT(ADAY,DAY)) AS DAYS FROM (
  SELECT  COALESCE(t1.AMOUNTS,0) AS sreturn, COALESCE(t1.DAYS,'') AS ADAY, COALESCE(t2.AMOUNTS,0) AS stotal, COALESCE( t2.DAYS,'') AS DAY
  FROM 
  (SELECT SUM(total) AS AMOUNTS, concat(DATE(date),' ',DAYNAME(date)) as DAYS FROM sales_return WHERE DATE_SUB(CURDATE(),INTERVAL 15 DAY) <= sales_return.date GROUP BY DATE(date)) t1 
  RIGHT JOIN 
  (
  SELECT  IF(STRCMP(t4.DAYS,t5.DAYS)=0, t4.AMOUNTS-t5.AMOUNTS, t4.AMOUNTS) AS AMOUNTS, t4.DAYS FROM
  ((SELECT SUM(total) AS AMOUNTS, concat(DATE(date),' ',DAYNAME(date)) as DAYS FROM sales WHERE DATE_SUB(CURDATE(),INTERVAL 15 DAY) <= sales.date GROUP BY DATE(date)) t4
  LEFT JOIN
  (SELECT SUM(balance) AS AMOUNTS, concat(DATE(transaction_date),' ',DAYNAME(transaction_date)) as DAYS FROM credits WHERE DATE_SUB(CURDATE(),INTERVAL 15 DAY) <= credits.transaction_date GROUP BY DATE(transaction_date)) t5 ON t4.DAYS =t5.DAYS)
  ) t2 
  ON t1.DAYS = t2.DAYS
  UNION ALL
  SELECT COALESCE(t1.AMOUNTS,0) AS sreturn, COALESCE(t1.DAYS,'') AS ADAY, COALESCE(t2.AMOUNTS,0) AS stotal, COALESCE( t2.DAYS,'') AS DAY
  FROM 
  (SELECT SUM(total) AS AMOUNTS, concat(DATE(date),' ',DAYNAME(date)) as DAYS FROM sales_return WHERE DATE_SUB(CURDATE(),INTERVAL 15 DAY) <= sales_return.date GROUP BY DATE(date)) t1 
  LEFT JOIN 
  (
  SELECT  IF(STRCMP(t4.DAYS,t5.DAYS)=0, t4.AMOUNTS-t5.AMOUNTS, t4.AMOUNTS) AS AMOUNTS, t4.DAYS FROM
  ((SELECT SUM(total) AS AMOUNTS, concat(DATE(date),' ',DAYNAME(date)) as DAYS FROM sales WHERE DATE_SUB(CURDATE(),INTERVAL 15 DAY) <= sales.date GROUP BY DATE(date)) t4
  LEFT JOIN
  (SELECT SUM(balance) AS AMOUNTS, concat(DATE(transaction_date),' ',DAYNAME(transaction_date)) as DAYS FROM credits WHERE DATE_SUB(CURDATE(),INTERVAL 15 DAY) <= credits.transaction_date GROUP BY DATE(transaction_date)) t5 ON t4.DAYS =t5.DAYS)
  ) t2 
  ON t1.DAYS = t2.DAYS) AS t3";
$result3	= mysqli_query($db, $sql3);

foreach($result as $data)
{

  $month[] = $data['YEARS'];
  $amount[] = $data['AMOUNTS'];
}
foreach($result1 as $data)
{

  $month1[] = $data['MONTHS'];
  $amount1[] = $data['AMOUNTS'];
}
foreach($result2 as $data)
{

  $month2[] = $data['WEEKS'];
  $amount2[] = $data['AMOUNTS'];
}
foreach($result3 as $data)
{

  $month3[] = $data['DAYS'];
  $amount3[] = $data['AMOUNTS'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <?php include('../../templates/head1.php');
    include('../print.php');
    ?>
    <script src="../package/dist/chart.umd.js"></script>
</head>
<body>
<div class="contain h-100">
    <?php
    include('../sales/base.php');
    ?>
    <div class="pe-1">
        <h1 class="ms-5 pt-2"><i class="fa-solid fa-square-poll-vertical"></i> Sales Chart</h1>
        <hr>
        <div class="ms-4 mb-4" id="chart" style="width: 80%;">
        <h2 ><div class="text-center">
            <div class="text-center">
                <button class="btn btn-outline-secondary" id="day" type="button">Days</button>
                <button autofocus class="btn btn-outline-secondary" id="week" type="button">Weeks</button>
                <button class="btn btn-outline-secondary" id="month" type="button">Months</button>
                <button class="btn btn-outline-secondary" id="year" type="button">Years</button>
            </div>
            </div>
        </h2>
        <!-- Checked switch -->
        <div class="ms-5 ps-5 shadow-sm w-25 border form-check form-switch">
              <input class="form-check-input opacity-10  border border-primary" onclick="window.location.href='../sales/charts2.php'"  type="checkbox" role="switch" id="flexSwitchCheckChecked" checked />
              <label class="form-check-label" for="flexSwitchCheckChecked"><strong>Account for Creditors</strong></label>
            </div>

            <canvas id="salesChart"></canvas>
        </div>
            <canvas id="salesChart"></canvas>
        </div>

        
    </div>
</div>
<script src="../../bootstrap4/jquery/jquery.min.js"></script>
<script src="../../bootstrap4/jquery/accounting.min.js"></script>
<script src="../../bootstrap4/jquery/datepicker.js"></script>
<script src="../../bootstrap4/js/jquery.dataTables.js"></script>

<script src="../../bootstrap4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../bootstrap4/js/bootstrap.bundle.min.js"></script>
<script src="../sales/javascript.js"></script>
<script>
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
      return new bootstrap.Popover(popoverTriggerEl)
    })
	</script>
<script>
  // === include 'setup' then 'config' above ===
  $(document).ready(function(){
    drawgraph(<?php echo json_encode($month2) ?>, <?php echo json_encode($amount2) ?>);
    $('#week').click(function(){
        $("canvas#salesChart").remove();
        $("#chart").append('<canvas id="salesChart"></canvas>');
        drawgraph(<?php echo json_encode($month2) ?>, <?php echo json_encode($amount2) ?>);
    })

    $('#month').click(function(){
        $("canvas#salesChart").remove();
        $("#chart").append('<canvas id="salesChart"></canvas>');
        drawgraph(<?php echo json_encode($month1) ?>, <?php echo json_encode($amount1) ?>);
    })
    $('#year').click(function(){
        $("canvas#salesChart").remove();
        $("#chart").append('<canvas id="salesChart"></canvas>');
        drawgraph(<?php echo json_encode($month) ?>, <?php echo json_encode($amount) ?>);
    })
    $('#day').click(function(){
        $("canvas#salesChart").remove();
        $("#chart").append('<canvas id="salesChart"></canvas>');
        drawgraph(<?php echo json_encode($month3) ?>, <?php echo json_encode($amount3) ?>);
    })
    });
  
  function drawgraph(label, amount)
  {
  const labels = label;
  const data = {
    labels: labels,
    datasets: [{
      label: 'My First Dataset',
      data: amount,
      backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(255, 159, 64, 0.2)',
        'rgba(255, 205, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(201, 203, 207, 0.2)'
      ],
      borderColor: [
        'rgb(255, 99, 132)',
        'rgb(255, 159, 64)',
        'rgb(255, 205, 86)',
        'rgb(75, 192, 192)',
        'rgb(54, 162, 235)',
        'rgb(153, 102, 255)',
        'rgb(201, 203, 207)'
      ],
      borderWidth: 1
    }]
  };

  const config = {
    type: 'bar',
    data: data,
    options: {
      indexAxis: 'y',
      scales: {
        y: {
          beginAtZero: true
        }
      }
    },
  };

  var myChart = new Chart(
    document.getElementById('salesChart'),
    config
  );
}
</script>

</body>
</html>
