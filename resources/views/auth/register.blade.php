@extends('home')

@section('content')
<div>
    <div>
        <div>
            <div>
                <div>{{ __('Register') }}</div>

                <div>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div>
                            <label for="name">{{ __('Username') }}</label>

                            <div>
                                <input id="name" type="text" class="@error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="email">{{ __('Email') }}</label>

                            <div>
                                <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="address">{{ __('Address') }}</label>

                            <div>
                                <input id="address" type="text" class="@error('adresse') is-invalid @enderror" name="address" required autocomplete="address">

                                @error('address')
                                    <span role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="city">{{ __('City') }}</label>

                            <div>
                                <input id="city" type="text" class="@error('city') is-invalid @enderror" name="city" required autocomplete="city">

                                @error('city')
                                    <span role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="zipcode">{{ __('Zip Code') }}</label>

                            <div>
                                <input id="zipcode" type="text" class="@error('zipcode') is-invalid @enderror" name="zipcode" required autocomplete="zipcode">

                                @error('zipcode')
                                    <span role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="phone">{{ __('Phone') }}</label>

                            <div>
                                <input id="phone" type="text" class="@error('phone') is-invalid @enderror" name="phone" required autocomplete="phone">

                                @error('phone')
                                    <span role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="password">{{ __('Password') }}</label>

                            <div>
                                <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="password-confirm">{{ __('Confirm Password') }}</label>

                            <div>
                                <input id="password-confirm" type="password" class="@error('password-confirm') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div>
                            <button type="submit">{{ __('Register') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
