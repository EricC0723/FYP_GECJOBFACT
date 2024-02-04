<?php
session_start();
include("C:/xampp/htdocs/FYP/dataconnection.php");
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if($_GET["action"] == "updatePost")
    {
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
    }
    else if($_GET["action"] == "updateProfit")
    {
        $selectedDateRange = $_GET['selectedDateRange'];

    // 解析年月
    list($selectedYear, $selectedMonth) = explode('-', $selectedDateRange);

    // 生成完整的日期范围
    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $selectedMonth, $selectedYear);

    $completeDays = [];
    for ($day = 1; $day <= $daysInMonth; $day++) {
        $completeDays[] = $day;
    }

    // 查询收益数据
    $profit_query = "SELECT DAY(Payment_Date) AS DayOfMonth, SUM(Payment_Amount) AS Daily_Payment_Total 
                        FROM payment 
                        WHERE YEAR(Payment_Date) = $selectedYear AND MONTH(Payment_Date) = $selectedMonth
                        GROUP BY DAY(Payment_Date) 
                        ORDER BY DAY(Payment_Date);";

    $profit_result = mysqli_query($connect, $profit_query);

    // 处理查询结果
    $data = [];

    while ($row = mysqli_fetch_assoc($profit_result)) {
        $data[$row['DayOfMonth']] = $row['Daily_Payment_Total'];
    }

    // 填充缺失的天数为零
    foreach ($completeDays as $day) {
        if (!isset($data[$day])) {
            $data[$day] = 0;
        }
    }

    // 按照天数重新排序
    ksort($data);

    // 返回 JSON 数据
    echo json_encode(array_values($data));
    exit;
    }
}
?>