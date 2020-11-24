<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<link rel="stylesheet" href="{{ public_path('css/font-awesome/css/font-awesome.min.css') }}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="{{ asset('css/opmaak.css') }}" rel="stylesheet">

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    {{--    Offset seen from top--}}
    <div class="container" style="margin-top:100px;">

        <div class="container">
            @foreach($students as $row)
                <div class="row rowcard">
                    <div class="col-4">
                    <div class="card">
                        <div class="col-10">
                        <img src="https://cdn.icon-icons.com/icons2/1879/PNG/512/iconfinder-1-avatar-2754574_120513.png" alt="John" style="width:100%">
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card1">
                        <p>ID: {{$row->id}}</p>
                        <p>Voornaam: {{$row->first_name}}</p>
                        <p>Achternaam: {{$row->last_name}}</p>
                        <p>Nickname: {{$row->nickname}}</p>
                        <p>Email: {{$row->email}}</p>
                        <br>
                    </div>
                </div>
                    <div class="col-5">
                        <div class="card1">
                            <p>Color: {{$row->color}}</p>
                            <p>Hobby's: {{$row->interests}}</p>
                            <p>Aangemaakt op: {{$row->created_at}}</p>
                            <br>
                        </div>
                    </div>
                </div>
        @endforeach
        </div>
    </div>
</x-app-layout>
