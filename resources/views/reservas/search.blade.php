<x-layout>
    <x-slot:title>
        Nueva Reserva
    </x-slot>
    <main class="flex max-w-[335px] w-full flex-col-reverse lg:max-w-4xl lg:flex-row">
        <div class="text-[13px] leading-[20px] flex-1 p-6 pb-12 lg:p-20 bg-white dark:bg-[#161615] dark:text-[#EDEDEC] shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] rounded-bl-lg rounded-br-lg lg:rounded-tl-lg lg:rounded-br-none">
            <h1 class="mb-4 font-medium">DETALLES RESERVA:</h1>
            <div class="bg-white dark:bg-[#1c1c1c] text-black dark:text-white border border-gray-400 px-4 py-3 rounded">
                Fecha: {{$fecha}} - Hora: {{$hora}} - Número Personas: {{$numpersonas}}
            </div>

            <h1 class="mb-4 mt-5 font-medium">Salas Disponibles:</h1>

            <div class="space-y-4">
                @foreach ($libres as $sala)
                    <div class="flex justify-between items-center bg-white dark:bg-[#1c1c1c] text-black dark:text-white border border-gray-400 px-4 py-4 rounded shadow-sm">

                        <div>
                            <div class="flex justify-between">
                                <h3 class="font-semibold text-[15px]">
                                    Sala {{ $sala->id }}
                                </h3>
                            </div>

                            <div class="mt-2 text-sm space-y-1">
                                <p><span class="font-semibold">Tipo Sala:</span> {{ $sala->tipo }}</p>
                                <p><span class="font-semibold">Capacidad:</span> {{ $sala->capacidad }}</p>
                                <p><span class="font-semibold">Equipamiento:</span> {{ $sala->equipamiento }}</p>
                            </div>
                        </div>

                        <div>

                            <form action="{{route('reservas.store')}}" method="POST">
                                @csrf
                                <!-- Datos de la reserva -->
                                <input type="hidden" name="sala_id" value="{{ $sala->id }}">
                                <input type="hidden" name="fecha" value="{{ $fecha }}">
                                <input type="hidden" name="hora" value="{{ $hora }}">
                                <input type="hidden" name="numpersonas" value="{{ $numpersonas }}">
                                <input type="hidden" name="telefono" value="{{ $telefono }}">

                                <button type="submit" class="text-[15px] leading-[20px] inline-flex p-1 lg:p-2 bg-white dark:bg-[#161615] dark:text-[#EDEDEC] shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] rounded-bl-lg rounded-br-lg lg:rounded-tl-lg lg:rounded-br-none">
                                    Reservar
                                    <svg class="w-4 h-4 ms-1.5 rtl:rotate-180 -me-0.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4"/></svg>
                                </button>
                            </form>
                        </div>


                    </div>
                @endforeach
            </div>

        </div>
    </main>

</x-layout>
