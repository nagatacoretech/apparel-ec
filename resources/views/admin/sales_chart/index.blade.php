<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sales Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {{-- タブのリンク --}}
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="monthly-tab" data-bs-toggle="tab" data-bs-target="#monthly" type="button" role="tab" aria-controls="monthly" aria-selected="true">サイト開設後の売上推移</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="yearly-tab" data-bs-toggle="tab" data-bs-target="#yearly" type="button" role="tab" aria-controls="yearly" aria-selected="false">年別売上</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="user-tab" data-bs-toggle="tab" data-bs-target="#user" type="button" role="tab" aria-controls="user" aria-selected="false">会員数増数</button>
                        </li>
                    </ul>
                    {{-- タブにリンクされてるグラフの描写のやつ --}}
                    <div class="tab-content mt-3" id="myTabContent">
                        <div class="tab-pane fade show active" id="monthly" role="tabpanel" aria-labelledby="monthly-tab">
                            <div style="width:80%; margin:auto;">
                                <canvas id="monthlySalesChart"></canvas>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="yearly" role="tabpanel" aria-labelledby="yearly-tab">
                            <div style="width:80%; margin:auto;">
                                <canvas id="yearlySalesChart"></canvas>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="user" role="tabpanel" aria-labelledby="user-tab">
                            <div style="width:80%; margin:auto;">
                                <canvas id="userChart"></canvas>
                            </div>
                        </div>
                    </div>
                    {{-- 会員数とか在庫とかのやつ --}}
                    <div>
                        {{-- 在庫 --}}
                        <div>
                            <a href="{{route("admin.stockout")}}">在庫切れ商品{{$stockout}}</a>
                        </div>
                        {{-- 会員数 --}}
                        <div>
                            総会員数{{$total_members}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const monthlySalesData = @json($monthlySales);
        const yearlySalesData = @json($yearlySales);
        const labels = @json($labels);
        const data = @json($data);

        initializeCharts();

        var myTab = new bootstrap.Tab(document.getElementById('myTab'));

        document.getElementById('monthly-tab').addEventListener('click', function (event) {
            event.preventDefault();
            myTab.show(document.getElementById('monthly-tab'));
            initializeCharts();
        });

        document.getElementById('yearly-tab').addEventListener('click', function (event) {
            event.preventDefault();
            myTab.show(document.getElementById('yearly-tab'));
            initializeCharts();
        });

        document.getElementById('user-tab').addEventListener('click', function (event) {
            event.preventDefault();
            myTab.show(document.getElementById('user-tab'));
            initializeCharts();
        });

        function initializeCharts() {
            // 月のやつ
            const ctxMonthly = document.getElementById('monthlySalesChart').getContext('2d');
            const monthlySalesChart = new Chart(ctxMonthly, {
                type: 'bar',
                data: {
                    labels: monthlySalesData.map(data => `${data.Year}-${data.Month}`),
                    datasets: [{
                        label: 'Monthly Sales',
                        data: monthlySalesData.map(data => data.total_sales),
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // 年別売り上げ
            const ctxYearly = document.getElementById('yearlySalesChart').getContext('2d');
            const yearlySalesChart = new Chart(ctxYearly, {
                type: 'bar',
                data: {
                    labels: yearlySalesData.map(data => data.Year),
                    datasets: [{
                        label: 'Yearly Sales',
                        data: yearlySalesData.map(data => data.total_sales),
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            //ユーザー数推移
            const ctxUsers = document.getElementById('userChart').getContext('2d');
            const usersChart = new Chart(ctxUsers, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'User Growth',
                        data: data,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    });
</script>

