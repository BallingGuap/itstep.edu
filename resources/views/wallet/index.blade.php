

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
    wallet info
    <div class="row">
        <div class="card chart-container col-4">
            <canvas id="chart"></canvas>
        </div>
    </div>


</div>

@endsection

@push('chart-scripts')
<script>
    const ctx = document.getElementById("chart").getContext('2d');
    const myChart = new Chart(ctx, {
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
</script>
@endpush

