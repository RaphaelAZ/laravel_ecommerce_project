@extends('layouts.template')

@section('content')
    <div>
        Compte utilisateur de {{ Auth::user()->name }}
    </div>

    <hr class="my-16">

    <h1>Dashboard</h1>
@stop