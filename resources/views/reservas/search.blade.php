<x-layout>
    <x-slot:title>
        Nueva Reserva
    </x-slot>
    <main class="flex max-w-[335px] w-full flex-col-reverse lg:max-w-4xl lg:flex-row">
        <div class="text-[13px] leading-[20px] flex-1 p-6 pb-12 lg:p-20 bg-white dark:bg-[#161615] dark:text-[#EDEDEC] shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] rounded-bl-lg rounded-br-lg lg:rounded-tl-lg lg:rounded-br-none">
            <h1 class="mb-4 font-medium">DETALLES RESERVA:</h1>
            <div class="bg-gray-100 border border-gray-400 text-gray-700 px-4 py-3 rounded">
                Fecha: {{$fecha}} - Hora: {{$hora}} - Número Personas: {{$num_personas}}
            </div>

            <h2 class="mb-4 font-medium">Mesas Disponibles:</h2>
            <div class="bg-gray-100 border border-gray-400 text-gray-700 px-4 py-3 rounded">
                <ul>
                    @foreach ($libres as $sala)
                        <li>{{ $sala -> id }}</li>
                    @endforeach
                </ul>
            </div>

        </div>
    </main>

</x-layout>
