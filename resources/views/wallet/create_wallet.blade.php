@extends('app')

@section('styles')
    <style>
        .container{
           min-height: 750px;
        }
    </style>
@endsection



@section('content')
    <div class='container mx-auto bg-white'>
        <div class='w-1/5 mx-auto py-16'>
            <h1 class="text-lg text-rose-500">Новый кошелек</h1>
            <form method='post' action="{{ route('wallet.save')}}">
                @csrf
                <div class="flex flex-col mt-2">
                    <label>Название кошелька:</label>
                    <input type='text' name='name'  class='rounded-md border py-2 px-4' />
                </div>
                <div class="flex flex-col mt-2">
                    <label>Валюта:</label>
                    <select name='currency_id' class='rounded-md border py-2 px-4' required>
                        @foreach($currencies as $currency)
                            <option value="{{$currency->id}}">{{$currency->symbol}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex flex-col mt-2">
                    <label>Баланс:</label>
                    <input type='text' name='balance' class='rounded-md border py-2 px-4' />
                </div>
                <div class="mt-4">
                    <input type='submit' name='wallet_save' class='rounded-md border py-2 px-4' />
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