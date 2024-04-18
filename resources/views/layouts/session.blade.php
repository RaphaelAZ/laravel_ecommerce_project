@extends('layouts.template')

@section('content')
<div>
    <div>
        <div>
            <div>
                <div>{{ __('Panel') }}</div>

                <div>
                    @if (session('status'))
                        <div role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Vous êtes connecté!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
