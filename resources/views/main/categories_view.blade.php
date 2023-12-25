@extends('app')

@section('content')
<div class="container mx-auto bg-white p-8 mt-8">
    <h1 class="text-3xl font-bold mb-4">Категории доходов и расходов</h1>

    <div class="grid grid-cols-2 gap-8">
        <div>
            <h2 class="text-xl font-bold mb-2">Категории доходов</h2>
            @if($incomeCategories->isEmpty())
                <p class="text-gray-500">Список категорий доходов пуст</p>
            @else
                <ul class="list-disc pl-4">
                    @foreach($incomeCategories as $incomeCategory)
                        <li class="text-green-500">{{ $incomeCategory->name }}</li>
                    @endforeach
                </ul>
            @endif
            <a href="{{ route('main.incomes_create') }}" class="bg-green-500 text-white py-2 px-4 rounded-md inline-block mt-4 hover:bg-green-600">Добавить категорию доходов</a>
        </div>

        <div>
            <h2 class="text-xl font-bold mb-2">Категории расходов</h2>
            @if($outcomeCategories->isEmpty())
                <p class="text-gray-500">Список категорий расходов пуст</p>
            @else
                <ul class="list-disc pl-4">
                    @foreach($outcomeCategories as $outcomeCategory)
                        <li class="text-red-500">{{ $outcomeCategory->name }}</li>
                    @endforeach
                </ul>
            @endif
            <a href="{{ route('main.outcomes_create') }}" class="bg-red-500 text-white py-2 px-4 rounded-md inline-block mt-4 hover:bg-red-600">Добавить категорию расходов</a>
        </div>
    </div>
</div>
@endsection
