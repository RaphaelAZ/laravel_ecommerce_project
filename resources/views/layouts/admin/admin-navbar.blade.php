@section('styles')
    <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
@stop

<nav class="bg-sec py-2 text-white">
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
        </div>
    </div>
</nav>
