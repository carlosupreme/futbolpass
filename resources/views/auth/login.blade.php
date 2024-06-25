<x-guest-layout>
    <div class="flex items-center justify-center h-screen bg-cover bg-bottom bg-no-repeat w-full"
         style="background-image: url('{{ asset('cancha.jpg') }}')">
        <div class="max-w-sm sm:max-w-md w-full mx-2 p-6 bg-login bg-opacity-90 rounded-lg backdrop-blur-sm">
            <img src="{{asset("logo.png")}}" alt="Villa 7"
                 class="w-20 h-20 object-contain object-left-bottom mx-auto mb-2">
            <h1 class="text-xl sm:text-2xl font-semibold mb-2 text-white text-center">Bienvenido a FutbolPass</h1>
            <h1 class="text-sm font-semibold mb-4 text-gray-300 text-center">Inicia sesión con tu correo</h1>

            <x-validation-errors class="mb-4"/>
            <form method="POST" class="space-y-4  " action="{{ route('login') }}">
                @csrf
                <!-- Your form elements go here -->
                <x-input
                    class="w-full border-gray-700 bg-gray-900 text-gray-300 focus:border-login-2 focus:ring-login-2"
                    autofocus autocomplete="email" placeholder="Correo" type="text" id="email" name="email"
                    :value="old('email')" required/>
                <x-input
                    class="w-full border-gray-700 bg-gray-900 text-gray-300 focus:border-login-2 focus:ring-login-2"
                    autocomplete="password" placeholder="Contraseña" type="password" id="password" name="password"
                />
                <div>
                    <x-button class="w-full justify-center focus:border-login-2 focus:ring-login-2">Ingresar</x-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
