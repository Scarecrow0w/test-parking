@extends('layouts.app')

@section('content')
    @guest()
        <form action="{{ route('scan-card', $parking) }}" method="POST">
            @csrf

            <input required name="card_id" type="text" placeholder="Номер карты">

            @error('card_id')
                <span class="text-red-500">{{ $message }}</span>
            @enderror

            <button class="border px-2 py-1 border-black rounded-md">Сканировать</button>
        </form>
    @else
        <div x-data="parking" x-cloak class="flex flex-col justify-center items-center max-w-2xl p-5 mx-auto border border-gray-600 rounded-lg">
            <form class="flex ml-auto" action="{{ route('logout') }}" method="POST">
                @csrf

                <button class="border px-2 py-1 border-black rounded-md">Выйти</button>
            </form>

            @if ($user->activeSession)
                <div x-show="screen === 'start'" class="flex flex-col gap-1">

                    <p>Ваше время {{ $user->activeSession->started_at->diffInRealMinutes() }} мин.</p>

                    <p>Стоимость {{ $user->activeSession->started_at->diffInRealMinutes() * $parking->tariff }} рублей</p>

                    <p>Время начала {{ $user->activeSession->started_at->format('d.m.y H:i') }}</p>

                    <button @click="finish" type="button" class="bg-green-500 text-white px-2 py-1 border-black rounded-md">Забрать машину</button>

                </div>

                <div x-show="screen === 'bye'" class="flex flex-col gap-1">
                    <p>Хорошей дороги :)</p>
                </div>
            @else
                <div x-show="screen === 'start'" class="flex flex-col gap-1">

                    <p>Тариф {{ $parking->tariff }} р / минута</p>

                    @php
                        $free_spots = $parking->carSpots->where('is_busy', false)->count();
                    @endphp

                    <p>Свободных мест {{ $free_spots ?: 'нет' }}</p>

                    @if ($free_spots)
                        <button @click="start" type="button" class="bg-green-500 text-white px-2 py-1 border-black rounded-md">Припарковаться</button>
                    @endif
                </div>

                <div x-show="screen === 'welcome'" class="flex flex-col gap-1">
                    <p x-text="'проезжайте, ваше место ' + carSpot"></p>
                </div>

            @endif

        </div>
    @endguest
@endsection

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('parking', () => ({
                screen: 'start',
                carSpot: '',

                start() {
                    axios.post('{{ route("parking.start", $parking) }}')
                        .then(response => {
                            this.carSpot = response.data.car_spot;

                            this.$nextTick(() => this.screen = 'welcome');
                        });
                },

                finish() {
                    axios.post('{{ route("parking.finish", $parking) }}')
                       .then(() => {
                            this.screen = 'bye';
                        });
                }
            }))
        })
    </script>
@endpush
