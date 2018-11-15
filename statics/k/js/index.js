$(function () {
   show("week");
});
function show(time) {
    $.ajax({
        url:"../home/k?action=k",
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
                name:'提成',
                type:'line',
                data:extract,
                markLine: {data: [{type: 'average', name: '平均值'}]}
            }
        ]
    }) ;
}
