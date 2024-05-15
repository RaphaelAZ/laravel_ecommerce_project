@extends('layouts.template')

@section('content')
<div class="container mx-auto mt-20 p-6 flex">
    <div class="w-1/2 pr-3">
        <div class="max-w-md mx-auto bg-white shadow-md rounded-md overflow-hidden mb-6">
            <div class="p-4">
                <h2 class="text-2xl font-semibold text-gray-800 mb-2">Contactez-nous</h2>
                @if(session('throwBack'))
                    <div class="bg-green-200 text-green-800 border border-green-600 px-4 py-2 rounded relative" role="alert">
                        {{ session('throwBack') }}
                    </div>
                @endif
                <form action="{{ route('contact.add')}}" method="POST">
                @CSRF
                    <div class="mb-4">
                        @include('components.input', [
                            "name" => "name",
                            "label" => "Nom",
                            "id" => "name",
                            "value" => Auth::user() ? Auth::user()->name : '',
                            "required" => true,
                            "placeholder" => "Votre nom"
                        ])
                    </div>
                    <div class="mb-4">
                        @include('components.input', [
                            "name" => "email",
                            "label" => "Email",
                            "type" => "email",
                            "id" => "email",
                            "value" => Auth::user() ? Auth::user()->email : '',
                            "required" => true,
                            "placeholder" => "Votre email"
                        ])
                    </div>
                    <div class="mb-4">
                        @include('components.textarea', [
                            "name" => "message",
                            "label" => "Message",
                            "id" => "message",
                            "rows" => 6,
                            "required" => true,
                            "placeholder" => "Votre message"
                        ])
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Envoyer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="w-1/2 pl-3">
        <div class="bg-white shadow-md rounded-md overflow-hidden">
            <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d13766653.533609908!2d86.9367677097621!3d-76.37471539126774!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sfr!2sfr!4v1715589320327!5m2!1sfr!2sfr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</div>
@stop
