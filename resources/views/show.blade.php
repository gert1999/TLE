<?php

    /* Database connection settings */
    $host = 'boostworks.online';
    $user = 'boostworksonline_ced-dashboard';
    $pass = '&G!0N995QE1tgq%3cujW';
    $db = 'boostworksonline_ced';
    $mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);

    $data1 = '';

    //query to get data from the table

    $sql = "SELECT * FROM `feelings` WHERE `student_id` = $id";
    $result = mysqli_query($mysqli, $sql);

    //loop through the returned data
    while ($row = mysqli_fetch_array($result)) {
        $data1 = $data1 . '"'. $row['score'].'",';
    }

    $row2 = mysqli_num_rows($result);
    $data1 = trim($data1,",");

    $size = explode(",", $data1,100);
    $arraysize = count($size);
    //dd($size);
    $smileys = [];
    for($s=0; $s < $arraysize ; $s++)
        {
            if ($size[$s]== "1")
                {
                  $smileys[]= 1;
                }
            else if ($size[$s]== "2")
            {
                $smileys[]=  2;
            }
            else if ($size[$s]== "3")
            {
                $smileys[]=  3;
            }
            else if ($size[$s]== "4")
            {
                $smileys[]=  4;
            }
            else if ($size[$s]== "5")
            {
                $smileys[]=  5;
            }

        }
dd($smileys);
    $sql2 = "SELECT `created_at` FROM `feelings` WHERE `student_id` = $id";
    $result2 = mysqli_query($mysqli, $sql2);

    while ($row3 = mysqli_fetch_array($result2))
    {
        $data2[] = $row3['created_at'];

    }

//    $sql2 = "SELECT COUNT(*) FROM feelings WHERE `student_id` = $id";
//    $result2 = mysqli_query($mysqli, $sql2);
//
//    $row3 = mysqli_num_rows($result2);
//

?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<link rel="stylesheet" href="{{ asset('css/font-awesome/css/font-awesome.min.css') }}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
<script type="text/javascript" src="https://rawgit.com/nnnick/Chart.js/v1.0.2/Chart.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<style>
    .chartWrapper {/* w w w. j a v  a2 s.co  m*/
        position: relative;
    }
    .chartWrapper > canvas {
        position: absolute;
        left: 0;
        top: 0;
        pointer-events:none;
    }
    .chartAreaWrapper {
        width: 100%;
        overflow-x: scroll;
    }

    .btn {
        background-color: #f5d142;
        border: none;
        color: white;
        padding: 8px;
        font-size: 12px;
        cursor: pointer;
    }
    .btn:hover {
        background-color: RoyalBlue;
    }

    .mydataChart{
        width:0px;
        height:300px;
    }
    /*body{*/
    /*    font-family: Arial;*/
    /*    margin: 80px 100px 10px 100px;*/
    /*    padding: 0;*/
    /*    color: white;*/
    /*    text-align: center;*/
    /*    background: #555652;*/
    /*}*/

    /*.container {*/
    /*    color: #E8E9EB;*/
    /*    background: #222;*/
    /*    border: #555652 1px solid;*/
    /*    padding: 10px;*/
    /*}*/
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container" style="margin-top:100px;">
        {{--        <canvas id="chart" style="width: 100%; height: 65vh; background: #222; border: 1px solid #555652; margin-top: 10px;"></canvas>--}}

        <div class="chartWrapper">
            <div class="chartAreaWrapper">
                <canvas id="myChart" class="mydataChart"></canvas>
            </div>
            <canvas id="myChartAxis" height="300" width="0"></canvas>
            <div style="display:none">
                <img id="source"
                     src="{{ asset('images\emotie.png') }}"
                     width="300" height="227">
            </div>
        </div>
    </div>

    <div class="container">
        <table class="table" style="margin-top:100px;">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">score</th>
                <th scope="col">Opmerking</th>
            </tr>
            </thead>
            <tbody>
            @foreach($feeling as $row)
                    <tr>
                        <th scope="row">{{$row->student_id}}</th>
                        @if($row->score == 1)
                            <td>☹</td>
                        @elseif($row->score == 2)
                            <td>🙁</td>
                        @elseif($row->score == 3)
                            <td>🙂</td>
                        @elseif($row->score == 4)
                            <td>😃</td>
                        @elseif($row->score == 5)
                            <td>😄</td>
                        @endif
                        <th>{{$row->comment}}</th>
                    </tr>
            @endforeach
            </tbody>
        </table>
    </div>



        <script>
            {{--var ctx = document.getElementById("chart").getContext('2d');--}}
            {{--var myChart = new Chart(ctx, {--}}
            {{--    type: 'line',--}}
            {{--    data: {--}}
            {{--        labels: [1,2,3,4,5,6,7,8,9,10],--}}
            {{--        datasets:--}}
            {{--            [{--}}
            {{--                label: 'Emoties',--}}
            {{--                data: [<?php echo $data1 ?>],--}}
            {{--                backgroundColor: 'transparent',--}}
            {{--                borderColor:'rgba(255,99,132)',--}}
            {{--                borderWidth: 5,--}}
            {{--            }]--}}
            {{--    },--}}

            {{--    options: {--}}
            {{--        scales: {scales:{yAxes: [{beginAtZero: false}], xAxes: [{autoskip: true, maxTicketsLimit: 20}]}},--}}
            {{--        tooltips:{mode: 'index'},--}}
            {{--        legend:{display: true, position: 'top', labels: {fontColor: 'rgb(255,255,255)', fontSize: 16}}--}}
            {{--    }--}}
            {{--});--}}

            var ctx = document.getElementById("myChart").getContext("2d");

            var labelsData = [];

            var users = <?php echo json_encode($data2); ?>;

            for (i = 1; i <= <?php echo $row2 ?>; i++) {
                // text += cars[i] + "<br>";

                labelsData.push(users[i-1]);
            }

                let data = {
                    labels: labelsData,
                    datasets: [
                        {
                            label: "Emoties",
                            fillColor: "rgba(220,220,220,0.2)",
                            strokeColor: "rgba(220,220,220,1)",
                            pointColor: "rgba(220,220,220,1)",
                            pointStrokeColor: "#fff",
                            pointHighlightFill: "#fff",
                            pointHighlightStroke: "rgba(220,220,220,1)",
                            data: [<?php echo $data1 ?>],

                        },
                    ]
                };
                // document.getElementsByClassName("mydataChart").style.width = widthData + "px";
                $(".mydataChart").css("width", data.labels.length * 150 + "px");
                $(".chartAreaWrapper").scrollLeft(data.labels.length * 150);



                new Chart(ctx).Line(data,

                    {
                        // options:{
                        //     scales:{
                        //         yAxes:[{
                        //             ticks: {
                        //                 callback: function (value, index, values) {
                        //                     return value + 1;
                        //
                        //                 }
                        //
                        //             }
                        //         }]
                        //     }
                        // },
                    onAnimationComplete: function () {
                        var sourceCanvas = this.chart.ctx.canvas;
                        var copyWidth = this.scale.xScalePaddingLeft - 5;
                        var copyHeight = this.scale.endPoint + 5;
                        var targetCtx = document.getElementById("myChartAxis").getContext("2d");
                        targetCtx.canvas.width = copyWidth;
                        targetCtx.drawImage(sourceCanvas, 0, 0, copyWidth, copyHeight, 0, 0, copyWidth, copyHeight);
                    }
                });


                // if(data.labels.length > 10){
                //     // document.getElementById("myChart").style.width = "300%";
                // }
                // $(".chartAreaWrapper").scrollTop(100);




        </script>
    </div>
</x-app-layout>

