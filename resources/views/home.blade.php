@extends('adminlte::page')



@section('title', 'Menu')

@section('content_header')
@stop

@section('content')
@php
        
        use Carbon\Carbon;
        use App\Models\Pagamento;
        use App\Models\Periodofiscal;
        use App\Models\Aluno;
        $periodofiscal = Periodofiscal::all()->last()->data;
        

        $data = new Carbon($periodofiscal);
        

        


        
        
        
    @endphp
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    

<x-adminlte-card class="mt-3" title="Menu Principal - Período fiscal atual: {{ $data->isoFormat('MM/YYYY') }}" theme="dark" icon="far fa-fw fa-compass">



    @if (isset($notification))

    @component('_components.modal.modalNotification', ['notification' => $notification])
    
    @endcomponent
    
    @endif

   
    


    

    

    
    <div class="row">

        <div class="col-md-4">

            <x-adminlte-info-box title="Alunos Cadastrados" text="{{ Aluno::count() }}" icon="fas fa-lg fa-user" theme="gray"/>
        </div>
        <div class="col-md-4">
        
            <x-adminlte-info-box title="Valor Arrecadado em {{ $data->monthName }}" text="{{ 'R$ ' . number_format($total, 2) }}" icon="fas fa-lg fa-dollar-sign text-green" theme="gray"/>

            
        </div>

        <div class="col-md-4">
            <x-adminlte-info-box title="Mensalidades Pagas" text="{{ Pagamento::where('periodo_fiscal', '=', $periodofiscal)->count() }}" icon="fas fa-lg fa-user-plus text-gray"
            theme="gray" icon-theme="white"/>

            
        </div>

    </div>

    <x-adminlte-card title="Valores arrecadados nos ultimos 6 meses" theme="gray" icon="fas fa-lg fa-dollar-sign text-green" removable collapsible >
        
        
            <canvas id="myChart" width="200" height="50"></canvas>
                <script>
                    const ctx = document.getElementById('myChart').getContext('2d');
                    const myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho'],
                            datasets: [{
                                label: 'Quantia',
                                data: [1, 2, 3, 4, 5, 6],
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
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
                </script>
        


    </x-adminlte-card>

    





</x-adminlte-card>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop

@section('footer')
    <h6 align="center">Happy System - <a href="https://github.com/Henriquegab">Henrique gabriel</a> Todos os Direitos Reservados</h6>
    
@stop