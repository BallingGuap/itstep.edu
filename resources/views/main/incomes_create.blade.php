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
            <h1 class="text-lg text-green-500">Новая категория доходов</h1>
            <form method='post' action="{{ route('main.incomes_save')}}">
                @csrf
                <div class="flex flex-col mt-2">
                    <label>Название категории:</label>
                    <input type='text' name='name'  class='rounded-md border py-2 px-4' />
                </div>
                <div class="mt-4">
                    <input type='submit' name='incomes_save' class='rounded-md border py-2 px-4' />
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