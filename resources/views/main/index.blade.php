@extends('app')

@section('content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="container mx-auto bg-white p-8 mt-8">
    <h1 class="text-3xl font-bold mb-4">Кошельки пользователя</h1>

    <div class="mb-8">
        @if($wallets->isEmpty())
            <p class="text-gray-500">Пока у вас нет кошельков.</p>
            <a href="{{ route('wallet.create') }}" class="text-blue-500 hover:underline mt-4">Создать новый кошелек</a>
        @else
            <ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($wallets as $wallet)
                    <li class="bg-blue-100 p-4 rounded-md shadow-md">
                        <span class="font-bold text-lg">{{ $wallet->name }}</span> 
                        <p class="text-black-500 pb-4">Баланс кошелька: {{ $wallet->balance }} {{ $wallet->currency->symbol }}</p>
                        <a href="{{ route('wallet.main', ['id' => $wallet->id]) }}" class="text-blue-500 hover:underline">Подробнее</a>
                        <button class="bg-green-500 text-white px-2 py-1 rounded-md ml-2" onclick="generateOperation({{ $wallet->id }})">Генерировать операцию</button>
                    </li>
                @endforeach
            </ul>
            <a href="{{ route('wallet.create') }}" class="text-blue-500 hover:underline mt-4">Создать новый кошелек</a>
        @endif
    </div>

    <div class="mt-8 mx-auto max-w-2xl bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4">Курс обмена валют</h2>

        <div class="overflow-x-auto">
            <table class="w-full bg-gray-100 rounded-lg border shadow">
                <thead class="bg-gray-300">
                    <tr>
                        <th class="py-3 px-6 border-b text-left">Валюта</th>
                        <th class="py-3 px-6 border-b text-left">Символ</th>
                        <th class="py-3 px-6 border-b text-left">Курс обмена</th>
                        <th class="py-3 px-6 border-b text-left"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($currencyRates as $rate)
                        <tr>
                            <td class="py-2 px-6 border-b">{{ $rate->name }}</td>
                            <td class="py-2 px-6 border-b">{{ $rate->symbol }}</td>
                            <td class="py-2 px-6 border-b">{{ $rate->exchange_rate_to_tenge }}</td>
                            <td class="py-2 px-6 border-b">
                                <a href="{{ route('main.currency_edit', ['currency_id' => $rate->id]) }}" class="text-blue-500 hover:underline">Изменить курс</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection


