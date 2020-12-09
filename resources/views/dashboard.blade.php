<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<link rel="stylesheet" href="{{ public_path('css/font-awesome/css/font-awesome.min.css') }}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="{{ asset('css/opmaak.css') }}" rel="stylesheet">
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
    .switch3 {
        display: none;
    }
    #switch2 {
        display: none;
        background-color: #3155ed;
        border: none;
        color: white;
        padding: 9px;
        text-align: center;
        text-decoration: none;
        font-size: 14px;
        margin: 10px 2px;
        cursor: pointer;
        float: right;
        border-radius: 4px;
    }
    #switch{
        background-color: #3155ed;
        border: none;
        color: white;
        padding: 9px;
        text-align: center;
        text-decoration: none;
        font-size: 14px;
        margin: 10px 2px;
        cursor: pointer;
        float: right;
        border-radius: 4px;
    }



</style>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

{{--    Offset seen from top--}}
    <div class="container" style="margin-top:100px;">
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Volledige naam</th>
                <th scope="col">E-mailadres</th>
                <th scope="col">Aangemaakt op</th>
                <th scope="col">Acties</th>
                <th scope="col">Status</th>

            </tr>
            </thead>
            <tbody>
            <button id="switch">Toon alle leerlingen</button>
            <button id="switch2">Toon eigen klas</button>
            @foreach($students as $row)
                <tr id="switch1">
                    <th scope="row">{{$row->id}}</th>
                    <td>{{$row->first_name}} {{$row->last_name}} </td>
                    <td>{{$row->email}}</td>
                    <td>{{$row->created_at}}</td>
                    <td>
                        <a href="{{route('info', $row->id)}}"> <button class="btn"><i class="fa fa-address-card"></i></button></a>
                        <a href="{{route('show', $row->id)}}"><button class="btn"><i class="fa fa-signal"></i></button></a>
                        <button class="btn"><i class="fa fa-edit"></i></button>
                        <button class="btn"><i class="fa fa-times"></i></button>
                    </td>
                    @if ($feeling[$row->id] >= 3)
                        <td data-toggle="tooltip" title="de leerling heeft {{$feeling[$row->id]}} opeenvolgende negatieve reacties geplaatst">⚠️</td>
                    @else
                        <td data-toggle="tooltip" title="het gaat goed met de leerling">✔️</td>
                    @endif
                </tr>
            @endforeach

            @foreach($studentNumber as $row1)
                <tr class="switch3">
                    <th scope="row">{{$row1->id}}</th>
                    <td>{{$row1->first_name}} {{$row1->last_name}} </td>
                    <td>{{$row1->email}}</td>
                    <td>{{$row1->created_at}}</td>
                    <td>
                        <a href="{{route('info', $row1->id)}}"> <button class="btn"><i class="fa fa-address-card"></i></button></a>
                        <a href="{{route('show', $row1->id)}}"><button class="btn"><i class="fa fa-signal"></i></button></a>
                        <button class="btn"><i class="fa fa-edit"></i></button>
                        <button class="btn"><i class="fa fa-times"></i></button>
                    </td>
                    @if ($feeling[$row1->id] >= 3)
                        <td data-toggle="tooltip" title="de leerling heeft {{$feeling[$row1->id]}} opeenvolgende negatieve reacties geplaatst">⚠️</td>
                    @else
                        <td data-toggle="tooltip" title="het gaat goed met de leerling">✔️</td>
                    @endif
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
    </div>
        <footer class="page-footer">
        <div class="footer-copyright text-center py-3">© 2020 HAPPY
        </div>
    </footer>
        <script>
            $(document).ready(function(){
                $('[data-toggle="tooltip"]').tooltip();
            });

            $(document).ready(function(){
                $('#switch').click(function() {
                    $('#switch1').hide();
                    $('#switch').hide();
                    $('.switch3').show();
                    $('#switch2').show();
                })
                $('#switch2').click(function() {
                    $('#switch1').show();
                    $('#switch').show();
                    $('.switch3').hide();
                    $('#switch2').hide();
                })
            });
        </script>
</x-app-layout>

