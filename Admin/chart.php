<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Chart示例</title>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
</head>
<body>
	<canvas id="barChart"></canvas>
</body>
<script>
    var dynamicColors = function (opacity) {
        var r = Math.floor(Math.random() * 255);
        var g = Math.floor(Math.random() * 255);
        var b = Math.floor(Math.random() * 255);
        var a = opacity;
        return "rgba(" + r + "," + g + "," + b + "," + a + ")";
    }

    // 功能 返回rgba格式颜色数组
    // @param length 数组的长度
    // @param opacity 颜色的透明度
    // return 返回rgba数组
    var getColorArr = function (length, opacity) {
        var colorArr = new Array();
        for (var i = 0; i < length; i++) {
            colorArr.push(dynamicColors(opacity));
        }
        return colorArr;
    }

    

    // 准备数据
    var labels = ['一月','二月','三月','四月','五月','六月','七月'];
    var data = [12, 10, 5, 2, 20, 30, 45];
    var chartData = {
        // x轴显示的label
        labels: labels,
        datasets: [{
            data: data, // 数据               
            label: '业务考核得分',// 图例
            backgroundColor: getColorArr(labels.length,0.5),
            borderWidth: 1
        }]
    };
    // 绘制图表
    var ctx = document.getElementById('barChart').getContext('2d');
    var bar = new Chart(ctx, {
        type: 'bar',
        data: chartData,
        options: {
            hover: {
                animationDuration: 0  // 防止鼠标移上去，数字闪烁
            },
            animation: {           // 这部分是数值显示的功能实现
                onComplete: function () {
                    var chartInstance = this.chart,

                    ctx = chartInstance.ctx;
                    // 以下属于canvas的属性（font、fillStyle、textAlign...）
                    ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
                    ctx.fillStyle = "black";
                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'bottom';

                    this.data.datasets.forEach(function (dataset, i) {
                        var meta = chartInstance.controller.getDatasetMeta(i);
                        meta.data.forEach(function (bar, index) {
                            var data = dataset.data[index];
                            ctx.fillText(data, bar._model.x, bar._model.y - 5);
                        });
                    });
                }
            }
        }
    });

</script>
</html>

作者：会Coding的猴子
链接：https://juejin.cn/post/6844903732346355725
来源：稀土掘金
著作权归作者所有。商业转载请联系作者获得授权，非商业转载请注明出处。