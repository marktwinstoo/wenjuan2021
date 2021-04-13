@extends('common.layout')
@section('title','后台首页')
@section('content')
            <div id="chart1" style="width: 400px;height: 400px;float: left "></div>
            <div id="chart2" style="width: 400px;height: 400px;float: right "></div>
            <script type="text/javascript" src="/assests/js/echarts.min.js"></script>
            <script type="text/javascript" src="/assests/js/jquery-1.7.2.min.js"></script>
            <script>
                var chartDom = document.getElementById('chart1');
                var chartDom1 = document.getElementById('chart2');
                var myChart = echarts.init(chartDom);
                var myChart1 = echarts.init(chartDom1);
                var option;
                var option1;

                option = {
                    title: {
                        text: '满意度调查',
                        left: 'center'
                    },
                    tooltip: {
                        trigger: 'item'
                    },
                    legend: {
                        orient: 'vertical',
                        left: 'left',
                    },
                    series: [
                        {
                            name: '文件满意度',
                            type: 'pie',
                            radius: '50%',
                            data: [
                            ],
                            emphasis: {
                                itemStyle: {
                                    shadowBlur: 10,
                                    shadowOffsetX: 0,
                                    shadowColor: 'rgba(0, 0, 0, 0.5)'
                                }
                            }
                        }
                    ]
                };
                myChart.setOption(option);

                option1 = {
                    title: {
                        text: '建议意见',
                        left: 'center'
                    },
                    tooltip: {
                        trigger: 'item'
                    },
                    legend: {
                        orient: 'vertical',
                        left: 'left',
                    },
                    series: [
                        {
                            name: '问卷汇总',
                            type: 'pie',
                            radius: '50%',
                            data: [
                            ],
                            emphasis: {
                                itemStyle: {
                                    shadowBlur: 10,
                                    shadowOffsetX: 0,
                                    shadowColor: 'rgba(0, 0, 0, 0.5)'
                                }
                            }
                        }
                    ]
                };
                myChart1.setOption(option);

                $.ajax({
                    type:'get',
                    url:'/adm/show-chart',
                    dataType:'json',
                    success:function (res){
                        myChart.setOption(
                            {
                                series:{
                                    data:[
                                        {value: res['q11'], name: '满意'},
                                        {value: res['q12'], name: '不满意'}
                                    ]
                                }
                            }
                        )
                        myChart1.setOption(
                            {
                                series:{
                                    data:[
                                        {value: res['q21'], name: '检索结果不够精确'},
                                        {value: res['q22'], name: '检索结果不全面'},
                                        {value: res['q23'], name: '反馈时间超出规定天数'},
                                        {value: res['q24'], name: '流程繁琐'},
                                        {value: res['q25'], name: '服务态度不佳'}
                                    ]
                                }
                            }
                        )
                    },
                    error:function (){
                        alert('图标请求失败');
                        myChart.hideLoading();
                        myChart1.hideLoading();
                    }
                });
            </script>
@endsection