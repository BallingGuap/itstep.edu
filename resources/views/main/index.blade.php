@extends('app')

@section('content')

<div class="container mx-auto bg-white p-8 mt-8">
    <h1 class="text-3xl font-bold mb-4 text-center">Кошельки пользователя</h1>

    <div class="row m-10">
        <div class="col-5 cmt-8 mx-auto max-w-2xl bg-white p-8 rounded-lg shadow-md">
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
        <div class="card chart-container col-6">
            <canvas id="chart_bar_wallets"></canvas>
        </div>
    </div>

    <div class="mb-8">
        @if($wallets->isEmpty())
            <p class="text-gray-500">Пока у вас нет кошельков.</p>
            <a href="{{ route('wallet.create') }}" class="text-blue-500 hover:underline mt-4">Создать новый кошелек</a>
        @else
            <ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                
                <a href="{{ route('wallet.create') }}" class="flex text-blue-300 justify-center border-blue-300 border-5 border-dashed p-4 rounded-md shadow-md hover:border-blue-400 hover:text-blue-400">
                    <span class="inline-block align-middle">Создать новый кошелек</a></span>
                </a>
                

                @foreach($wallets as $wallet)
                    <li class="bg-blue-100 p-4 rounded-md shadow-md">
                        <span class="font-bold text-lg">{{ $wallet->name }}</span> 
                        <p class="text-black-500 pb-4">Валюта кошелька: {{ $wallet->currency->symbol }}</p>
                        <p class="text-black-500 pb-4">Баланс кошелька: {{ $wallet->balance }}</p>
                        <a href="{{ route('wallet.main', ['id' => $wallet->id]) }}" class="text-blue-500 hover:underline">Подробнее</a>
                        <form action="{{ route('wallet.save_random_income', ['wallet_id' => $wallet->id]) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="bg-green-500 text-white px-2 py-1 rounded-md ml-2">Генерировать доход</button>
                        </form>
                        
                        <!-- Форма для генерации случайного расхода -->
                        <form action="{{ route('wallet.save_random_outcome', ['wallet_id' => $wallet->id]) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded-md ml-2">Генерировать расход</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    
</div>

@endsection

@push('chart-scripts')

<script>
    const ctx_chart_bar_wallets = document.getElementById("chart_bar_wallets").getContext('2d');
    const myChartBarWallets = new Chart(ctx_chart_bar_wallets, {
        type: 'bar',
        data: {
          labels: @json(array_keys($walletsBalance)),//,['Wallet0', 'Wallet', 'Wallet2', 'wallet3']
          datasets: [{
            label: 'Баланс кошельков',
            backgroundColor: 'rgba(161, 198, 247, 1)',
            borderColor: 'rgb(47, 128, 237)',
            data: @json(array_values($walletsBalance)),//,[7053, 113, 10, 123]
          }]
        },
        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true,
              }
            }]
          }
        },
      });
</script>

@endpush
