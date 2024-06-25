<x-guest-layout>
    <div class="flex items-center justify-center h-screen">
        <div class="max-w-md w-full p-6">
            <img src="{{asset("logo.png")}}" alt="Villa 7"
                 class="w-20 h-20 object-contain object-left-bottom mx-auto mb-2 rounded-full border border-gray-400">
            <h1 class="text-xl sm:text-2xl font-semibold mb-2 text-black text-center">Bienvenido a FutbolPass</h1>
            <h1 class="text-sm font-semibold mb-4 text-gray-500 text-center">Inicia sesión con tu correo</h1>

            <x-validation-errors class="mb-4"/>
            <form method="POST" class="space-y-4" action="{{ route('login') }}">
                @csrf
                <!-- Your form elements go here -->
                    <x-input autofocus autocomplete="email" placeholder="Correo" class="w-full" type="text" id="email" name="email" :value="old('email')" required/>
                    <x-input autocomplete="password" placeholder="Contraseña" type="password" id="password" name="password" class="w-full"/>
                <div>
                    <button type="submit"
                            class="w-full bg-black text-white p-2 rounded-md hover:bg-gray-800 focus:outline-none focus:bg-black focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 transition-colors duration-300">
                        Ingresar
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
