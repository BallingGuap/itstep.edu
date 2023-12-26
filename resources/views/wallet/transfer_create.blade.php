@extends('app')

@section('content')
    <div class='container mx-auto bg-white'>
        <div class='w-1/5 mx-auto py-16'>
            <h1 class="text-lg text-rose-500">Перевод средств</h1>
            <form method='post' action="{{ route('wallet.transfer_save', ['current_wallet_id' => $current_wallet->id]) }}">
                @csrf
                <div class="flex flex-col mt-2">
                    <label>Откуда:</label>
                    <input type='text' value='{{$current_wallet->name}}' class='rounded-md border py-2 px-4' readonly />
                </div>
                <div class="flex flex-col mt-2">
                    <label>Доступно: {{$current_wallet->balance}}{{$current_wallet->currency->symbol}}</label>
                </div>
                <div class="flex flex-col mt-2">
                    <label>Куда:</label>
                    <select name='wallet_id' class='rounded-md border py-2 px-4' required>
                        @foreach($wallets as $wallet)
                            <option value="{{$wallet->id}}">{{$wallet->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex flex-col mt-2">
                    <label>Сумма перевода: ({{$current_wallet->currency->symbol}})</label>
                    <input type='number' name='sum'  class='rounded-md border py-2 px-4' />
                </div>
                <div class="mt-4">
                    <input type='submit' name='transfer_save' class='rounded-md border py-2 px-4' />
                </div>
            </form>
            @if ($errors->any())
            <div class="alert alert-danger mt-6 text-rose-500">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>

@endif
        </div>
    </div>
@endsection