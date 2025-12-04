<x-layout xmlns:x-slot="http://www.w3.org/1999/xlink">

    <x-slot:title>
        Mis Reservas
    </x-slot>
    <main class="flex max-w-[335px] w-full flex-col lg:max-w-4xl">

        <div class="flex-1 p-6 pb-12 lg:p-20 bg-[#161615] text-[#EDEDEC] shadow-[inset_0px_0px_0px_1px_#fffaed2d] rounded-lg text-[14px] leading-[22px]">

            <h1 class="mb-6 text-2xl font-semibold text-center">
                Mis Reservas
            </h1>

            <form class="mb-4 row-cols-2 d-flex" method="POST" action="{{route('reservas.filtrar')}}">
                @csrf
                <x-input label="Fecha" type="date" name="fecha" required />

                <div>
                    <label class="block text-sm font-medium mb-1" for="hora">Hora</label>
                    <select name="estado" id="estado" required class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-[#1c1c1c] text-black dark:text-white focus:outline-none focus:ring-2 focus:ring-gray-800">
                        <option value="todas">Todas</option>
                        <option value="pendiente">Pendiente</option>
                        <option value="confirmada">Confirmada</option>
                        <option value="cancelada">Cancelada</option>

                    </select>
                </div>

                <button type="submit" class="w-full bg-black text-white py-2 rounded-lg hover:bg-gray-800 transition">
                    Filtrar
                </button>
            </form>

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
                            <a class="mx-5" href="{{route('reservas.confirmar', [ 'reserva' => $reserva->id ] )}}">Confirmar</a>
                            <a href="{{route('reservas.cancelar', [ 'reserva' => $reserva->id ] )}}">Cancelar</a>
                        </div>

                    </li>
                @endforeach
            </ul>


        </div>

    </main>

</x-layout>

