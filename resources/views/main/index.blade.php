@extends('app')

@section('content')

<div class="mt-8 mx-auto max-w-2xl bg-white p-8 rounded-lg shadow-md">
    <h1 class="text-3xl font-bold mb-4">Курс обмена валют</h1>
    <table class="w-full bg-gray-100 rounded-lg overflow-hidden">
        <thead class="bg-gray-300">
            <tr>
                <th class="py-2 px-4 border-b text-left">Валюта</th>
                <th class="py-2 px-4 border-b text-left">Символ</th>
                <th class="py-2 px-4 border-b text-left">Курс обмена</th>
                <th class="py-2 px-4 border-b text-left text-gray-300"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($currencyRates as $rate)
                <tr>
                    <td class="py-2 px-4 border-b">{{$rate->name}}</td>
                    <td class="py-2 px-4 border-b">{{$rate->symbol}}</td>
                    <td class="py-2 px-4 border-b">{{$rate->exchangeRateToTenge}}</td>
                    <td class="py-2 px-4 border-b">
                        <a href="{{ route('main.currency_edit', ['currency_id' => $rate->id]) }}" class="text-blue-500 hover:underline">Изменить курс</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection