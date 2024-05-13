@section('styles')
    <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
@stop

<nav class="bg-amber-900 py-4">
    <div class="container mx-auto px-4 flex justify-between items-center">
        <a class="main-font text-white" href="{{ url('/') }}">
            CursedBazar
        </a>

        <div id="navbarContent" class="hidden md:block">
            <ul class="flex items-center space-x-4">
                @guest
                    @if (Route::has('login'))
                        <li>
                            <a class="text-white hover:text-yellow-600" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li>
                            <a class="text-white hover:text-yellow-600" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="relative">
                        <a id="navbarDropdown" class="text-white hover:text-yellow-600" href="/moncompte" role="button" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div aria-labelledby="navbarDropdown" class="absolute hidden bg-white p-2 mt-2 rounded shadow-md">
                            <a class="block px-4 py-2 text-gray-800 text-white hover:text-yellow-600" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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
