@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="row">
            <div class="col-12">
                <!-- Graphique de barre pour les articles -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Quantité d'articles</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="articleQuantityChart" style="height: 400px; width: 100%;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="row">
            <div class="col-md-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $userCount }}</h3>
                        <p>Utilisateurs</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <a href="{{ route('admin.utilisateur') }}" class="small-box-footer">Voir plus <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $articleCount }}</h3>
                        <p>Articles</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-boxes"></i>
                    </div>
                    <a href="{{ route('admin.article') }}" class="small-box-footer">Voir plus <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $stock_entrer }}</h3>
                        <p>Bons d'entrée</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-warehouse"></i>
                    </div>
                    <a href="{{ route('stock_entrer.index') }}" class="small-box-footer">Voir plus <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $stock_sortie }}</h3>
                        <p>Bons de sortie</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-warehouse"></i>
                    </div>
                    <a href="{{ route('stock-sorties.index') }}" class="small-box-footer">Voir plus <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var ctx = document.getElementById('articleQuantityChart').getContext('2d');
        var articleQuantityChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($labels) !!},
                datasets: [{
                    label: 'Quantité',
                    data: {!! json_encode($quantities) !!},
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Quantité'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Articles'
                        }
                    }
                }
            }
        });
    });
</script>
@stop
