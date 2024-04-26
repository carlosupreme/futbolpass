<div
    class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">

    <h1 class="mt-8 text-2xl font-medium text-gray-900 dark:text-white">
        Hola {{ Auth::user()->name }} <br>
        Bienvenido al Sistema de Credenciales de Villa 7
    </h1>

    <form method="POST" action="{{ route('logout') }}" x-data class="my-10">
        @csrf

        <a href="{{ route('logout') }}" class="bg-gray-400 rounded-lg p-4" @click.prevent="$root.submit();">Cerrar
            sesión </a>
    </form>
</div>
