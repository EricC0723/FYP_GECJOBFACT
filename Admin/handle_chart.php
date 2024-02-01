<?php
session_start();
include("C:/xampp/htdocs/FYP/dataconnection.php");

// 获取前端传递的日期范围
$startDate = $_GET['startDate'];
$endDate = $_GET['endDate'];

// 构建 SQL 查询，使用日期范围进行过滤
$query = "SELECT mc.Main_Category_ID, mc.Main_Category_Name, COUNT(jp.Main_Category_ID) as post_count
          FROM main_category mc
          LEFT JOIN job_post jp ON mc.Main_Category_ID = jp.Main_Category_ID
          WHERE jp.AdStartDate BETWEEN '$startDate' AND '$endDate'
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

$totalPosts = array_sum($yValues);

$response = ['xValues' => $xValues, 'yValues' => $yValues, 'totalPosts' => $totalPosts];
echo json_encode($response);
?>