<x-layout xmlns:x-slot="http://www.w3.org/1999/xlink">

    <x-slot:title>
        Mis Reservas
    </x-slot>
    <main class="flex max-w-[335px] w-full flex-col-reverse lg:max-w-4xl lg:flex-row">
        <div class="text-[13px] leading-[20px] flex-1 p-6 pb-12 lg:p-20 bg-white dark:bg-[#161615] dark:text-[#EDEDEC] shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] rounded-bl-lg rounded-br-lg lg:rounded-tl-lg lg:rounded-br-none">
            <h1 class="mb-1 font-medium">Mis Reservas</h1>
            <ul class="max-w-md divide-y divide-default mb-4">
                @foreach($reservas as $reserva)
                <li class="pb-3 sm:pb-4">

                    {{$user->name}} - {{$user->email}} - {{$reserva->telefono}} <br>
                    {{$reserva->fecha}} - {{$reserva->hora}} - {{$reserva->sala->id}} - {{$reserva->numpersonas}}
                </li>
                @endforeach
            </ul>
        </div>

        <x-button_w link="{{route('nueva-reserva')}}" texto="Haz una reserva ahora"/>

    </main>
</x-layout>

