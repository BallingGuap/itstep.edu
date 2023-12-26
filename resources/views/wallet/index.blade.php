@extends('app') 

@section('content')
<div class="flex  justify-center h-screen">
    <div class="bg-white p-8">
        <div class="mb-8">
            <ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <li class="bg-blue-100 p-6 rounded-md shadow-md text-center">
                    <span class="font-bold text-lg">{{ $wallet->name }}</span> 
                    <p class="text-gray-600 mb-4">Валюта кошелька: {{ $wallet->currency->symbol }}</p>
                    <p class="text-gray-600 mb-4">Баланс кошелька: {{ $wallet->balance }}</p>
                    <a href="{{ route('wallet.transfer_create', ['current_wallet_id' => $wallet->id]) }}" class="block bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition duration-300 mb-2">Перевести средства</a>
                    <form action="{{ route('wallet.save_random_income', ['wallet_id' => $wallet->id]) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md ml-2 hover:bg-green-700 transition duration-300">Генерировать доход</button>
                    </form>
                    
                    <!-- Форма для генерации случайного расхода -->
                    <form action="{{ route('wallet.save_random_outcome', ['wallet_id' => $wallet->id]) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md ml-2 hover:bg-red-700 transition duration-300">Генерировать расход</button>
                    </form>
                </li>
            </ul>
            <div class="row">
                <div class="card chart-container col-4">
                    <canvas id="chart_pie"></canvas>
                </div>
                <div class="card chart-container col-4">
                    <canvas id="chart_bar_1"></canvas>
                </div>
                <div class="card chart-container col-4">
                    <canvas id="chart_bar_2"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('chart-scripts')
<script>
    const ctx_pie = document.getElementById("chart_pie").getContext('2d');
    const myChartPie = new Chart(ctx_pie, {
      type: 'pie',
      data: {
        labels: ['incomes','outcomes'],
        datasets: [{
          label: 'incomes/ountcomes',
          backgroundColor: 'rgba(161, 198, 247, 1)',
          borderColor: 'rgb(47, 128, 237)',
          data: @json([$totalIncome,$totalOutcome]),
        }]
      },
    });

    const ctx_bar_1 = document.getElementById("chart_bar_1").getContext('2d');
    const myChartBar_1 = new Chart(ctx_bar_1, {
        type: 'bar',
        data: {
          labels: @json([array_keys($incomeTotalsWithCategory)]),
          datasets: [{
            label: 'Incomes categories',
            backgroundColor: 'rgba(161, 198, 247, 1)',
            borderColor: 'rgb(47, 128, 237)',
            data: @json([array_values($incomeTotalsWithCategory)]),
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
      
    const ctx_bar_2 = document.getElementById("chart_bar_2").getContext('2d');
    const myChartBar_2 = new Chart(ctx_bar_2, {
        type: 'bar',
        data: {
          labels: @json([array_keys($outcomeTotalsWithCategory)]),
          datasets: [{
            label: 'Outcomes categories',
            backgroundColor: 'rgba(161, 198, 247, 1)',
            borderColor: 'rgb(47, 128, 237)',
            data: @json([array_values($outcomeTotalsWithCategory)]),
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

