<?php
session_start();
include("C:/xampp/htdocs/FYP/dataconnection.php");

$query = "SELECT mc.Main_Category_ID, mc.Main_Category_Name, COUNT(jp.Main_Category_ID) as post_count
          FROM main_category mc
          LEFT JOIN job_post jp ON mc.Main_Category_ID = jp.Main_Category_ID
          GROUP BY mc.Main_Category_ID";

$result = mysqli_query($connect, $query);

$xValues = [];
$yValues = [];

// Fetch data from the result set
while ($row = mysqli_fetch_assoc($result)) {
    // Add Main_Category_Name to xValues
    $xValues[] = $row['Main_Category_Name'];

    // Add post count to yValues
    $yValues[] = $row['post_count'];
}
?>

<!DOCTYPE html>
<html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<body>

<canvas id="myChart" style="width:100%;max-width:1000px"></canvas>

<script>
var xValues = <?php echo json_encode($xValues); ?>;
var yValues = <?php echo json_encode($yValues); ?>;
var barColors = [
    "#b91d47", "#00aba9", "#2b5797", "#e8c3b9", "#1e7145",
    "#FF6633", "#FFB399", "#FF33FF", "#FFFF99", "#00B3E6",
    "#E6B333", "#3366E6", "#999966", "#99FF99", "#B34D4D",
    "#80B300", "#809900", "#E6B3B3", "#6680B3", "#66991A",
    "#FF99E6", "#CCFF1A", "#FF1A66", "#E6331A", "#33FFCC",
    "#66994D", "#B366CC", "#4D8000", "#B33300", "#CC80CC"
];

new Chart("myChart", {
  type: "pie",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    title: {
      display: true,
      text: "World Wide Wine Production 2018"
    }
  }
});
</script>

</body>
</html>