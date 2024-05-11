@extends('layouts.template')

@section('content')
    <div>
        Compte utilisateur de {{ Auth::user()->name }}
    </div>

    <hr class="my-16">

    <a href="{{ route('commandes.index') }}" class="btn btn-primary">
        <iconify-icon icon="mdi:cart"></iconify-icon>
        Historique commandes
    </a>
@stop
