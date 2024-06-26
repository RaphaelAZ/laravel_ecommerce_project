<nav class="bg-primary py-4 text-white w-full top-0 left-0 z-50">
    <div class="container mx-auto px-4 flex justify-between items-center">
        <div class="gap-8 flex items-center">
            <a class="main-font text-center d-block" href="{{ url('/') }}">
                Cursed<br/>Bazaar
            </a>

            <a class="block h-fit" href="{{ route('products.index') }}">
                Produits
            </a>

            <a class="block h-fit" href="{{ route('contact') }}">
                Nous Contacter
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
                    <li class="relative flex items-center gap-x-12">
                        <a class="chip chip-primary flex" href="{{ route('basket.index') }}">
                            <span class="pb-px">{{ \App\Helpers\Basket::numberOfItems() }}</span>
                            <iconify-icon class="ml-2" icon="mdi:cart"></iconify-icon>
                        </a>

                        <a href="{{ route("account") }}" role="button" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <iconify-icon id="menu-icon" class="cursor-pointer" id="navbarDropdown" icon="mdi:menu"></iconify-icon>

                        <div id="menu-dropdown" aria-labelledby="navbarDropdown" class="absolute hidden bg-white top-6 right-0 p-2 mt-2 rounded shadow-md">
                            <a class="flex flex-col items-center px-4 py-2 text-gray-800" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <iconify-icon class="text-red-600" icon="material-symbols:logout"></iconify-icon>
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
