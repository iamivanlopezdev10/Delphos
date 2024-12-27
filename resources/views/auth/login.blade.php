<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Flowbite -->
    <link href="https://cdn.jsdelivr.net/npm/flowbite@1.6.5/dist/flowbite.min.css" rel="stylesheet">

    <!-- FontAwesome (para el icono de ojo) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

    <!-- Contenedor principal del Login -->
    <div class="flex items-center justify-center min-h-screen">
        <div class="w-full max-w-md bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-center text-2xl font-semibold mb-6">Iniciar sesión</h2>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Nombre de usuario -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">{{ __('Nombre de usuario') }}</label>
                    <input id="name" type="text" class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 @error('name') border-red-500 @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Contraseña -->
                <div class="mb-4 relative">
                    <label for="password" class="block text-sm font-medium text-gray-700">{{ __('Contraseña') }}</label>
                    <input id="password" type="password" class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 @error('password') border-red-500 @enderror" name="password" required autocomplete="current-password">
                    <!-- Icono de Ojo centrado -->
                    <span toggle="#password" class="fa fa-fw fa-eye absolute right-3 top-1/2 transform -translate-y-1/2 cursor-pointer"></span>
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Recordarme -->
                <div class="mb-4 flex items-center">
                    <input class="form-checkbox" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="ml-2 text-sm text-gray-700" for="remember">{{ __('Recuérdame') }}</label>
                </div>

                <!-- Botón de Enviar -->
                <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                    {{ __('Iniciar sesión') }}
                </button>

                <!-- Enlace de Olvidé mi Contraseña -->
                @if (Route::has('password.request'))
                    <div class="mt-4 text-center">
                        <a class="text-blue-500 text-sm hover:underline" href="{{ route('password.request') }}">
                            {{ __('¿Olvidaste tu contraseña?') }}
                        </a>
                    </div>
                @endif

                <!-- Enlace para abrir el Modal de Registro -->
                <div class="mt-4 text-center">
                    <button type="button" class="text-blue-500 text-sm hover:underline" data-modal-toggle="registerModal">
                        {{ __('¿No tienes cuenta? Regístrate aquí') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal de Registro -->
    <div id="registerModal" class="fixed inset-0 flex items-center justify-center z-50 hidden bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
            <h3 class="text-center text-2xl font-semibold mb-6">Registrar empleado</h3>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Nombre -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">{{ __('Nombre') }}</label>
                    <input id="name" type="text" class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 @error('name') border-red-500 @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">{{ __('Correo Electrónico') }}</label>
                    <input id="email" type="email" class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Contraseña -->
                <div class="mb-4 relative">
                    <label for="password" class="block text-sm font-medium text-gray-700">{{ __('Contraseña') }}</label>
                    <input id="password" type="password" class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 @error('password') border-red-500 @enderror" name="password" required autocomplete="new-password">
                    <!-- Icono de Ojo centrado -->
                    <span toggle="#password" class="fa fa-fw fa-eye absolute right-3 top-1/2 transform -translate-y-1/2 cursor-pointer"></span>
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirmar Contraseña -->
                <div class="mb-4 relative">
                    <label for="password-confirm" class="block text-sm font-medium text-gray-700">{{ __('Confirmar Contraseña') }}</label>
                    <input id="password-confirm" type="password" class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" name="password_confirmation" required autocomplete="new-password">
                    <!-- Icono de Ojo centrado -->
                    <span toggle="#password-confirm" class="fa fa-fw fa-eye absolute right-3 top-1/2 transform -translate-y-1/2 cursor-pointer"></span>
                </div>

                <!-- Botón de Registro -->
                <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                    {{ __('Registrar') }}
                </button>

                <!-- Botón de Cerrar Modal -->
                <div class="mt-4 text-center">
                    <button type="button" class="text-gray-500" data-modal-toggle="registerModal">
                        Cerrar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@1.6.5/dist/flowbite.min.js"></script>

    <script>
        // Script para mostrar/ocultar el modal de registro
        const modal = document.getElementById('registerModal');
        const openModalButton = document.querySelector('[data-modal-toggle="registerModal"]');
        const closeModalButton = modal.querySelector('[data-modal-toggle="registerModal"]');

        openModalButton.addEventListener('click', () => {
            modal.classList.remove('hidden');
        });

        closeModalButton.addEventListener('click', () => {
            modal.classList.add('hidden');
        });

        // Alternar visibilidad de la contraseña
        document.querySelectorAll('.fa-eye').forEach(function (icon) {
            icon.addEventListener('click', function () {
                let passwordInput = document.querySelector(icon.getAttribute('toggle'));
                if (passwordInput.type === "password") {
                    passwordInput.type = "text";
                    icon.classList.replace("fa-eye", "fa-eye-slash");
                } else {
                    passwordInput.type = "password";
                    icon.classList.replace("fa-eye-slash", "fa-eye");
                }
            });
        });
    </script>
</body>
</html>
