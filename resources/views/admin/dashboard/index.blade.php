@extends('layouts.template')

@section('content')
    <div class="w-full h-full flex flex-col justify-center overflow-hidden relative bg-no-repeat bg-cover bg-center mt-20 ml-20">
        <h1 class="text-4xl font-bold mb-6 text-left w-full ml-50 z-10 leading-snug user-select-none">
            Bonjour,<br />
            {{ Auth::user()->name }}
        </h1>

        <hr>

        <div class="flex space-between gap-8">
            <a class="chip chip-primary flex w-30 mt-4" href="{{ route('users-management') }}">
                <span class="pb-px">Utilisateurs</span>
                <iconify-icon class="ml-2" icon="bi:person-fill"></iconify-icon>
            </a>

            <a class="chip chip-primary flex w-30 mt-4" href="{{ route('dashboard') }}">
                <span class="pb-px">Coupons</span>
                <iconify-icon class="ml-2" icon="ph:ticket-duotone"></iconify-icon>
            </a>

            <a class="chip chip-primary flex w-30 mt-4" href="{{ route('messages.admin.index') }}">
                <span class="pb-px">Messages</span>
                <iconify-icon class="ml-2" icon="tabler:message"></iconify-icon>
            </a>

            <a class="chip chip-primary flex w-30 mt-4" href="{{ route('orders.admin.index') }}">
                <span class="pb-px">Commandes</span>
                <iconify-icon class="ml-2" icon="icon-park-twotone:shopping"></iconify-icon>
            </a>
        </div>
    </div>
@stop