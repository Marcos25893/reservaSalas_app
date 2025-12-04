<x-layout xmlns:x-slot="http://www.w3.org/1999/xlink">

    <x-slot:title>
        Mis Reservas
    </x-slot>
    <main class="flex max-w-[335px] w-full flex-col lg:max-w-4xl">

        <div class="flex-1 p-6 pb-12 lg:p-20 bg-[#161615] text-[#EDEDEC] shadow-[inset_0px_0px_0px_1px_#fffaed2d] rounded-lg text-[14px] leading-[22px]">

            <h1 class="mb-6 text-2xl font-semibold text-center">
                Mis Reservas
            </h1>

            <ul class="space-y-4">
                @foreach($reservas as $reserva)
                    <li class="p-4 rounded-md bg-[#1f1f1f] flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-300">
                                Sala: {{$reserva->sala->id}} - Personas: {{$reserva->numpersonas}}<br>
                                Fecha: {{$reserva->fecha}} - Hora: {{$reserva->hora}}<br>
                                Estado: <span class="
                                @if($reserva->estado == 'cancelada') text-red-500
                                @elseif($reserva->estado == 'pendiente') text-yellow-500
                                @else text-green-500
                                @endif">
                                    {{$reserva->estado}}
                                </span>
                            </p>
                        </div>
                        <div class="text-sm text-gray-300">
                            <a href="{{route('reservas.cancelar', [ 'reserva' => $reserva->id ] )}}">Cancelar</a>
                        </div>

                    </li>
                @endforeach
            </ul>

            <div class="mt-8 flex justify-center">
                <x-button_w link="{{ route('nueva-reserva')}}" texto="Haz una reserva ahora" />
            </div>

        </div>

    </main>

</x-layout>

