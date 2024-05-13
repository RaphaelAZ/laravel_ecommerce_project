@extends('layouts.template')

@section('content')
<div class="container mx-auto p-6 flex">
    <div class="w-1/2 pr-3">
        <div class="max-w-md mx-auto bg-white shadow-md rounded-md overflow-hidden mb-6">
        <div class="p-4">
            <h2 class="text-2xl font-semibold text-gray-800 mb-2">Contactez-nous</h2>
            <form action="#" method="POST">
                <div class="mb-4">
                    <label for="name" class="block text-gray-600 font-semibold mb-2">Nom</label>
                    <input type="text" id="name" name="name" class="form-input w-full px-4 py-2 border rounded-md focus:outline-none focus:border-blue-400" placeholder="Votre nom" required>
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-600 font-semibold mb-2">Email</label>
                    <input type="email" id="email" name="email" class="form-input w-full px-4 py-2 border rounded-md focus:outline-none focus:border-blue-400" placeholder="Votre email" required>
                </div>
                <div class="mb-4">
                    <label for="message" class="block text-gray-600 font-semibold mb-2">Message</label>
                    <textarea id="message" name="message" class="form-textarea w-full px-4 py-2 border rounded-md focus:outline-none focus:border-blue-400" rows="6" placeholder="Votre message" required></textarea>
                </div>
                <div class="text-center">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-3 rounded-md transition duration-300">Envoyer</button>
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