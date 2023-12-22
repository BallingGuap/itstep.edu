@extends('app')

@section('content')

<div class="mt-8 mx-auto max-w-2xl bg-white p-8 rounded-lg shadow-md">
    <h1 class="text-3xl font-bold mb-4">Изменить текущий курс</h1>

    <form action="{{ route('main.currency_update', ['currency_id' => $currency->id]) }}" method="post">
        @csrf
        @method('put')
        
        <div class="mb-4">
            <label for="exchange_rate" class="block text-sm font-medium text-gray-600">Новый курс для {{ $currency->symbol }}</label>
            <input type="text" name="exchangeRateToTenge" id="exchange_rate" value="{{ $currency->exchangeRateToTenge }}" class="mt-1 p-2 border rounded-md w-full" required>
        </div>

        <div class="flex items-center">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">
                Изменить курс
            </button>
        </div>
    </form>
</div>

@endsection