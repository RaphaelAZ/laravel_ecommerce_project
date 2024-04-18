@extends('layouts.template')

@section('content')
    <div>
        Compte utilisateur de {{ Auth::user()->name }}
    </div>
@stop