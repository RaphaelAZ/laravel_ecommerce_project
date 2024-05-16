@section('styles')
    <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
@stop

<nav class="bg-gray-800 py-2 text-white">
    <div class="container mx-auto px-4 flex justify-between items-center">
        <div class="gap-9 flex items-center">
            <a class="block h-fit" href="{{ route('dashboard') }}">
                Administration
            </a>
            <a class="block h-fit" href="{{ route('users-management') }}">
                Utilisateurs
            </a>
            <a class="block h-fit" href="{{ route('products-management') }}">
                Articles
            </a>
            <a class="block h-fit" href="{{ route('dashboard') }}">
                Coupons
            </a>
            <a class="block h-fit" href="{{ route('messages.admin.index') }}">
                Messages
            </a>
            <a class="block h-fit" href="{{ route('orders.admin.index') }}">
                Commandes
            </a>
        </div>
    </div>
</nav>
