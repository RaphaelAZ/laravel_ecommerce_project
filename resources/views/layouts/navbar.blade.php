@section('styles')
    <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
@stop

<nav class="bg-gray-800 py-4 text-white">
    <div class="container mx-auto px-4 flex justify-between items-center">
        <div class="gap-8 flex items-center">
            <a class="main-font text-center d-block" href="{{ url('/') }}">
                Cursed<br/>Bazar
            </a>

            <a class="block h-fit" href="{{ route('produits.index') }}">
                Produits
            </a>
        </div>



        <div id="navbarContent" class="hidden md:block">
            <ul class="flex items-center space-x-4">
                @guest
                    @if (Route::has('login'))
                        <li>
                            <a href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li>
                            <a href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="relative">
                        <a id="navbarDropdown" href="/moncompte" role="button" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div aria-labelledby="navbarDropdown" class="absolute hidden bg-white p-2 mt-2 rounded shadow-md">
                            <a class="block px-4 py-2 text-gray-800" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
