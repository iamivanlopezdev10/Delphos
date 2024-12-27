@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-center text-2xl font-semibold mb-6">{{ __('Verifica tu dirección de correo electrónico') }}</h2>

        <div class="mb-4">
            @if (session('resent'))
                <div class="alert alert-success bg-green-100 text-green-800 p-3 rounded-md mb-4">
                    {{ __('Se ha enviado un nuevo enlace de verificación a tu dirección de correo electrónico.') }}
                </div>
            @endif

            <p>{{ __('Antes de continuar, revisa tu correo electrónico para un enlace de verificación.') }}</p>
            <p>{{ __('Si no has recibido el correo electrónico') }}, 
                <form class="inline" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="text-blue-500 hover:underline">
                        {{ __('haz clic aquí para solicitar otro') }}
                    </button>.
                </form>
            </p>
        </div>
    </div>
</div>
@endsection
