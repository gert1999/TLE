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

    $data1 = trim($data1,",");

?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<link rel="stylesheet" href="{{ public_path('css/font-awesome/css/font-awesome.min.css') }}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>

<style>
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
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">score</th>
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

    <div class="container">
        <canvas id="chart" style="width: 100%; height: 65vh; background: #222; border: 1px solid #555652; margin-top: 10px;"></canvas>

        <script>
            var ctx = document.getElementById("chart").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: [1,2,3,4,5,6,7,8,9],
                    datasets:
                        [{
                            label: 'Hoi',
                            data: [<?php echo $data1 ?>],
                            backgroundColor: 'transparent',
                            borderColor:'rgba(255,99,132)',
                            borderWidth: 5,
                        }]
                },

                options: {
                    scales: {scales:{yAxes: [{beginAtZero: false}], xAxes: [{autoskip: true, maxTicketsLimit: 20}]}},
                    tooltips:{mode: 'index'},
                    legend:{display: true, position: 'top', labels: {fontColor: 'rgb(255,255,255)', fontSize: 16}}
                }
            });
        </script>
    </div>
</x-app-layout>

