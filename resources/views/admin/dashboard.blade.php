@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2 text-dark mb-0">Преглед контролне табле</h1>
        <div class="date text-muted">
            <i class="fas fa-calendar-alt me-2"></i>{{ now()->format('d.m.Y.') }}
        </div>
    </div>
    
    <div class="row g-4">
        <!-- Statistics Cards -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase text-muted mb-2">Укупно корисника</h6>
                            <h2 class="mb-0 text-dark">{{ \App\Models\User::count() }}</h2>
                        </div>
                        <div class="icon-shape bg-primary bg-opacity-10 text-primary rounded-3 p-3">
                            <i class="fas fa-users fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase text-muted mb-2">Укупно производа</h6>
                            <h2 class="mb-0 text-dark">{{ \App\Models\Product::count() }}</h2>
                        </div>
                        <div class="icon-shape bg-success bg-opacity-10 text-success rounded-3 p-3">
                            <i class="fas fa-box fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase text-muted mb-2">Укупно наруџбина</h6>
                            <h2 class="mb-0 text-dark">{{ \App\Models\Order::count() }}</h2>
                        </div>
                        <div class="icon-shape bg-info bg-opacity-10 text-info rounded-3 p-3">
                            <i class="fas fa-shopping-cart fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase text-muted mb-2">Укупан приход</h6>
                            <h2 class="mb-0 text-dark">{{ number_format(\App\Models\Order::sum('total_amount'), 2) }} RSD</h2>
                        </div>
                        <div class="icon-shape bg-warning bg-opacity-10 text-warning rounded-3 p-3">
                            <i class="fas fa-money-bill fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row g-4 mt-4">
        <!-- Orders Status Distribution -->
        <div class="col-xl-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3 border-0">
                    <h5 class="mb-0 text-dark">Статус наруџбина</h5>
                </div>
                <div class="card-body">
                    @if(!$hasOrders)
                        <div class="text-center text-muted py-5">
                            <i class="fas fa-shopping-cart fa-3x mb-3"></i>
                            <h6>Нема наруџбина за приказ</h6>
                        </div>
                    @else
                        <div id="orderStatusChart" style="height: 300px;"></div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Category Distribution -->
        <div class="col-xl-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white py-3 border-0">
                    <h5 class="mb-0 text-dark">Категорије производа</h5>
                </div>
                <div class="card-body">
                    @if(empty($categoryData) || (count($categoryData) === 1 && $categoryData[0][1] === 0))
                        <div class="text-center text-muted py-5">
                            <i class="fas fa-tags fa-3x mb-3"></i>
                            <h6>Нема категорија за приказ</h6>
                        </div>
                    @else
                        <div id="categoryChart" style="height: 300px;"></div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Orders -->
    <div class="card border-0 shadow-sm mt-4">
        <div class="card-header bg-white py-3 border-0">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 text-dark">Недавне наруџбине</h5>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-primary">
                    Прегледај све наруџбине
                </a>
            </div>
        </div>
        @if($recentOrders->isEmpty())
            <div class="card-body text-center text-muted py-5">
                <i class="fas fa-inbox fa-3x mb-3"></i>
                <h6>Нема недавних наруџбина</h6>
            </div>
        @endif
    </div>
</div>

@push('scripts')
<script src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawCharts);

    function drawCharts() {
        @if($hasOrders)
        // Orders Status Chart
        var orderStatusData = new google.visualization.DataTable();
        orderStatusData.addColumn('string', 'Status');
        orderStatusData.addColumn('number', 'Count');
        orderStatusData.addRows(@json($orderStatusData));

        var orderStatusOptions = {
            pieHole: 0.4,
            chartArea: { width: '85%', height: '85%' },
            colors: ['#ffc107', '#0dcaf0', '#198754', '#dc3545'], // warning, info, success, danger
            legend: { position: 'right', textStyle: { color: '#6c757d' } },
            backgroundColor: 'transparent',
            pieSliceText: 'percentage',
            tooltip: { text: 'value' }
        };

        var orderStatusChart = new google.visualization.PieChart(document.getElementById('orderStatusChart'));
        orderStatusChart.draw(orderStatusData, orderStatusOptions);
        @endif

        @if(!empty($categoryData) && !(count($categoryData) === 1 && $categoryData[0][1] === 0))
        // Category Distribution Chart
        var categoryData = new google.visualization.DataTable();
        categoryData.addColumn('string', 'Category');
        categoryData.addColumn('number', 'Products');
        categoryData.addRows(@json($categoryData));

        var categoryOptions = {
            pieHole: 0.4,
            chartArea: { width: '85%', height: '85%' },
            colors: ['#0d6efd', '#198754', '#ffc107', '#dc3545', '#6610f2', '#0dcaf0'],
            legend: { position: 'right', textStyle: { color: '#6c757d' } },
            backgroundColor: 'transparent',
            pieSliceText: 'percentage',
            tooltip: { text: 'value' }
        };

        var categoryChart = new google.visualization.PieChart(document.getElementById('categoryChart'));
        categoryChart.draw(categoryData, categoryOptions);
        @endif
    }

    // Redraw charts on window resize
    window.addEventListener('resize', function() {
        if (typeof drawCharts === 'function') {
            drawCharts();
        }
    });
</script>
@endpush
@endsection 