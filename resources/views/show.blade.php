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

//    $size = explode(",", $data1,100);
//    $arraysize = count($size);
//    dd($size);
//    $smileys = [];
//    for($s=0; $s < $arraysize ; $s++)
//        {
//            if ($size[$s]== "1")
//                {
//                  $smileys[]= 1;
//                }
//            else if ($size[$s]== "2")
//            {
//                $smileys[]=  2;
//            }
//            else if ($size[$s]== "3")
//            {
//                $smileys[]=  3;
//            }
//            else if ($size[$s]== "4")
//            {
//                $smileys[]=  4;
//            }
//            else if ($size[$s]== "5")
//            {
//                $smileys[]=  5;
//            }
//
//        }
//dd($smileys);
    $sql2 = "SELECT `created_at` from feelings WHERE `student_id` = $id";
    $result2 = mysqli_query($mysqli, $sql2);

    while ($row3 = mysqli_fetch_array($result2))
    {
        $row3['created_at'];
        $data2[] = $row3['created_at'];

    }
$time = [];
    for ($t=0; $t < count($data2); $t++)
        {
          $crazyTime =  explode("-", $data2[$t]);

          $time[] = "$crazyTime[2]-$crazyTime[1]-$crazyTime[0]";
        }


    if($row2 == 0){
        $data2[] = '';
        $error = 'Op dit moment is er niets ingevuld';
    }else{
        $error = '';
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
        @foreach($student as $students)
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Gevoelens {{$students->first_name}} {{$students->last_name}}
            </h2>
        @endforeach
    </x-slot>

    <div class="container" style="margin-top:100px;">
        {{--        <canvas id="chart" style="width: 100%; height: 65vh; background: #222; border: 1px solid #555652; margin-top: 10px;"></canvas>--}}

        <div class="chartWrapper">
            <div class="chartAreaWrapper">
                <canvas id="myChart" class="mydataChart"></canvas>
            </div>
            <canvas id="myChartAxis" height="300" width="0"></canvas>
            <div>
                <img src="/images/EmojiEdged128x/5emoji128x.png" style="position:absolute;height: 20px;top:0;left:6px"/>
                <img src="/images/EmojiEdged128x/4emoji128x.png" style="position:absolute;height: 20px;top:68px;left:6px"/>
                <img src="/images/EmojiEdged128x/3emoji128x.png" style="position:absolute;height: 20px;top:135px;left:6px"/>
                <img src="/images/EmojiEdged128x/2emoji128x.png" style="position:absolute;height: 20px;top:200px;left:6px"/>
                <img src="/images/EmojiEdged128x/1emoji128x.png" style="position:absolute;height: 20px;top:263px;left:6px"/>
            </div>

        </div>
<?php echo "<h1 style='font-size:30px;text-align:center;position:relative;top:40px;'>$error</h1>"; ?>
    </div>

    <div class="container">
        <table class="table" style="margin-top:100px;">
            <thead>
            <tr>
                <th scope="col">Gevoel</th>
                <th scope="col">Opmerking</th>
            </tr>
            </thead>
            <tbody>
            @foreach($feeling as $row)
                    <img>
                        @if($row->score == 1)
                            <td><img src="/images/EmojiEdged128x/1emoji128x.png" style="height: 25px;"/></td>
                        @elseif($row->score == 2)
                            <td><img src="/images/EmojiEdged128x/2emoji128x.png" style="height: 25px;"/></td>
                        @elseif($row->score == 3)
                            <td><img src="/images/EmojiEdged128x/3emoji128x.png" style="height: 25px;"/></td>
                        @elseif($row->score == 4)
                            <td><img src="/images/EmojiEdged128x/4emoji128x.png" style="height: 25px;"/></td>
                        @elseif($row->score == 5)
                            <td><img src="/images/EmojiEdged128x/5emoji128x.png" style="height: 25px;"/></td>
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

            var users = <?php echo json_encode($time); ?>;

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
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        suggestedMin: 1,
                                        suggestedMax: 5
                                    }
                                }]
                            }
                        },

                            onAnimationComplete: function () {
                                var sourceCanvas = this.chart.ctx.canvas;
                                var copyWidth = this.scale.xScalePaddingLeft - 5;
                                var copyHeight = this.scale.endPoint + 5;
                                var targetCtx = document.getElementById("myChartAxis").getContext("2d");
                                targetCtx.canvas.width = copyWidth;
                                targetCtx.drawImage(sourceCanvas, 0, 0, copyWidth, copyHeight, 0, 0, copyWidth, copyHeight);
                    },

                });

                // if(data.labels.length > 10){
                //     // document.getElementById("myChart").style.width = "300%";
                // }
                // $(".chartAreaWrapper").scrollTop(100);
        </script>
    </div>
</x-app-layout>

