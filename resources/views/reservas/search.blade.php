<x-layout>
    <x-slot:title>
        Nueva Reserva
    </x-slot>
    <main class="flex max-w-[335px] w-full flex-col-reverse lg:max-w-4xl lg:flex-row">
        <div class="text-[13px] leading-[20px] flex-1 p-6 pb-12 lg:p-20 bg-white dark:bg-[#161615] dark:text-[#EDEDEC] shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] rounded-bl-lg rounded-br-lg lg:rounded-tl-lg lg:rounded-br-none">
            <h1 class="mb-4 font-medium">DETALLES RESERVA:</h1>
            <div class="bg-white dark:bg-[#1c1c1c] text-black dark:text-white border border-gray-400 px-4 py-3 rounded">
                Fecha: {{$fecha}} - Hora: {{$hora}} - Número Personas: {{$num_personas}}
            </div>

            <h1 class="mb-4 mt-5 font-medium">Mesas Disponibles:</h1>

            <div class="space-y-4">
                @foreach ($libres as $sala)
                    <div class="bg-white dark:bg-[#1c1c1c] text-black dark:text-white border border-gray-400 px-4 py-4 rounded shadow-sm">

                        <div class="flex justify-between">
                            <h3 class="font-semibold text-[15px]">
                                Mesa {{ $sala->id }}
                            </h3>
                        </div>

                        <div class="mt-2 text-sm space-y-1">
                            <p><span class="font-semibold">Tipo Sala:</span> {{ $sala->tipo }}</p>
                            <p><span class="font-semibold">Capacidad:</span> {{ $sala->capacidad }}</p>
                            <p><span class="font-semibold">Equipamiento:</span> {{ $sala->equipamiento }}</p>
                        </div>

                    </div>
                @endforeach
            </div>

        </div>
    </main>

</x-layout>
