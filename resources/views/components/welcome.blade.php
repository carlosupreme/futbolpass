<div>
    <h1 class="text-3xl font-medium text-gray-900 dark:text-white mb-5">
        Hola {{ Auth::user()->name }} <br>
        Bienvenido al Sistema de Credenciales de Villa 7
    </h1>

    <hr class="w-full h-1 mx-auto bg-gray-100 my-1 border-0 rounded md:my-2 dark:bg-gray-700">
    
    <h2 class="text-2xl font-medium text-center mb-3">Datos personales</h2>

    <div class="max-w-md p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 m-auto">

        <dl class="max-w-md text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
        <div class="flex flex-col pb-3">
            <dt class="mb-1 text-blue-500 md:text-lg dark:text-blue-400">Dirección de correo electrónico</dt>
            <dd class="text-lg font-semibold">{{ Auth::user()->email }}</dd>
        </div>
        <div class="flex flex-col py-3">
            <dt class="mb-1 text-blue-500 md:text-lg dark:text-blue-400">Nombre completo</dt>
            <dd class="text-lg font-semibold">{{ Auth::user()->name }}</dd>
        </div>
        
    </div>
</div>