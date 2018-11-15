$(function () {
    // var time = ['周一','周二','周三','周四','周五','周六','周日'];
    // var data = [23, 42, 18, 45, 48, 49,100];
    // echart(time,data);
    // console.log()
   show("week");
});
function show(time) {
    $.ajax({
        url:"",
        method:"POST",
        data:{time:time},
        dataType:"json",
        success:function (res) {
            echart(res.time,res.extract);
        },
        error:function () {
            console.log('网络出错啦！');
        }
    })
}

//折线图
function echart(time,extract) {
    var line = echarts.init(document.getElementById('line'));
    line.setOption({
        color:["#32d2c9"],
        title: {
            x: 'left',
            text: '提成',
            textStyle: {
                fontSize: '18',
                color: '#4c4c4c',
                fontWeight: 'bolder'
            }
        },
        tooltip: {
            trigger: 'axis'
        },
        toolbox: {
            show: true,
            feature: {
                dataZoom: {
                    yAxisIndex: 'none'
                },
                dataView: {readOnly: false},
                magicType: {type: ['line', 'bar']}
            }
        },
        xAxis:  {
            type: 'category',
            boundaryGap: false,
            data: time,
            axisLabel: {
                interval:0
            }
        },
        yAxis: {
            type: 'value'
        },
        series: [
            {
                name:'成绩',
                type:'line',
                data:extract,
                markLine: {data: [{type: 'average', name: '平均值'}]}
            }
        ]
    }) ;
}
