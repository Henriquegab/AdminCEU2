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

        $valormes = [];



        for ($i=0; $i < 12 ; $i++) {
            $calculos = Pagamento::where('periodo_fiscal', $data->subMonth($i));

            $total = 0;


            foreach ($calculos->get() as $calculo) {
                $total += $calculo->valor_pago;

            }
            array_push($valormes, $total);
            $data->addMonth($i);
        }





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

            <x-adminlte-info-box title="Valor Arrecadado em {{ $data->monthName }}" text="{{ 'R$ ' . number_format($valormes[0], 2) }}" icon="fas fa-lg fa-dollar-sign text-green" theme="gray"/>


        </div>

        <div class="col-md-4">
            <x-adminlte-info-box title="Mensalidades Pagas" text="{{ Pagamento::where('periodo_fiscal', '=', $periodofiscal)->count() }}" icon="fas fa-lg fa-user-plus text-gray"
            theme="gray" icon-theme="white"/>


        </div>

    </div>

    {{-- <x-adminlte-card title="Valores arrecadados nos ultimos 12 meses" theme="gray" icon="fas fa-lg fa-dollar-sign text-green" removable collapsible >


            <canvas id="myChart" width="200" height="50"></canvas>
                <script>
                    const ctx = document.getElementById('myChart').getContext('2d');
                    const myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ['<?php echo $data->subMonth(11)->monthName; $data->addMonth(11); ?> de <?php echo $data->subMonth(11)->year; $data->addMonth(11); ?>',
                            '<?php echo $data->subMonth(10)->monthName; $data->addMonth(10); ?> de <?php echo $data->subMonth(10)->year; $data->addMonth(10); ?>',
                            '<?php echo $data->subMonth(9)->monthName; $data->addMonth(9); ?> de <?php echo $data->subMonth(9)->year; $data->addMonth(9); ?>',
                            '<?php echo $data->subMonth(8)->monthName; $data->addMonth(8); ?> de <?php echo $data->subMonth(8)->year; $data->addMonth(8); ?>',
                            '<?php echo $data->subMonth(7)->monthName; $data->addMonth(7); ?> de <?php echo $data->subMonth(7)->year; $data->addMonth(7); ?>',
                            '<?php echo $data->subMonth(6)->monthName; $data->addMonth(6); ?> de <?php echo $data->subMonth(6)->year; $data->addMonth(6); ?>',
                            '<?php echo $data->subMonth(5)->monthName; $data->addMonth(5); ?> de <?php echo $data->subMonth(5)->year; $data->addMonth(5); ?>',
                            '<?php echo $data->subMonth(4)->monthName; $data->addMonth(4); ?> de <?php echo $data->subMonth(4)->year; $data->addMonth(4); ?>',
                            '<?php echo $data->subMonth(3)->monthName; $data->addMonth(3); ?> de <?php echo $data->subMonth(3)->year; $data->addMonth(3); ?>',
                            '<?php echo $data->subMonth(2)->monthName; $data->addMonth(2); ?> de <?php echo $data->subMonth(2)->year; $data->addMonth(2); ?>',
                            '<?php echo $data->subMonth(1)->monthName; $data->addMonth(1); ?> de <?php echo $data->subMonth(1)->year; $data->addMonth(1); ?>',
                            '<?php echo $data->monthName ?> de <?php echo $data->year ?>'],
                            datasets: [{
                                label: 'Quantia',
                                data: [
                                '<?php echo $valormes[11] ?>',
                                '<?php echo $valormes[10] ?>',
                                '<?php echo $valormes[9] ?>',
                                '<?php echo $valormes[8] ?>',
                                '<?php echo $valormes[7] ?>',
                                '<?php echo $valormes[6] ?>',
                                '<?php echo $valormes[5] ?>',
                                '<?php echo $valormes[4] ?>',
                                '<?php echo $valormes[3] ?>',
                                '<?php echo $valormes[2] ?>',
                                '<?php echo $valormes[1] ?>',
                                '<?php echo $valormes[0] ?>'],
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)',
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
                                    'rgba(255, 159, 64, 1)',
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



    </x-adminlte-card> --}}







</x-adminlte-card>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop

@section('footer')
    <h6 align="center" style=""></a>AdminCEU - <a href="https://www.linkedin.com/in/henrique-gabriel-siqueira-da-cruz-0826a4146/">Henrique gabriel</a>  Todos os Direitos Reservados <a href="https://github.com/Henriquegab" class="fa fa-github"></a></h6>

@stop
