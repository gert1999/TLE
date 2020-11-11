<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<link rel="stylesheet" href="{{ public_path('css/font-awesome/css/font-awesome.min.css') }}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
                <th scope="col">Volledige naam</th>
                <th scope="col">E-mailadres</th>
                <th scope="col">Aangemaakt op</th>
                <th scope="col">Acties</th>
            </tr>
            </thead>
            <tbody>
            @foreach($students as $row)
                <tr>
                    <th scope="row">{{$row->id}}</th>
                    <td>{{$row->first_name}} {{$row->last_name}} </td>
                    <td>{{$row->email}}</td>
                    <td>{{$row->created_at}}</td>
                    <td>
                        <button class="btn"><i class="fa fa-edit"></i></button>
                        <button class="btn"> <a href="{{route('show', $row->id)}}"><i class="fa fa-signal"></i></a></button>
                        <button class="btn"><i class="fa fa-times"></i></button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
