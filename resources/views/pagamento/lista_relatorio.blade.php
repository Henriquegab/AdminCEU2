@extends('adminlte::page')

@section('title', 'Relatório de Pagamentos')

@section('content_header')





@stop

@section('content')

    <br>


    @php
    use App\Models\Categoria;
    use App\Models\Aluno;
    use App\Models\Pagamento;
    use Carbon\Carbon;

    $heads = [
        ['label' => 'Id', 'width' => 5],
        ['label' => 'Nome', 'width' => 20],
        ['label' => 'CPF', 'width' => 20], 
        ['label' => 'Data', 'width' => 10],
        ['label' => 'Categoria', 'width' => 20],
        ['label' => 'Mês Referencia', 'width' => 10],
        ['label' => 'Mensalidade', 'width' => 18], 
        ['label' => 'Valor Pago', 'width' => 20],
        
        ];
   

    $config = [
        'paging' => true,
        'filter' => true,

        'order' => [[0, 'asc']],
        'columns' => [['orderable' => true],['orderable' => true], ['orderable' => true], ['orderable' => true], ['orderable' => true], ['orderable' => true], ['orderable' => true], ['orderable' => true]],
    ];
    // dd($pagamentos->get());

    $total = 0;
    @endphp

    

    <x-adminlte-datatable id="table" :heads="$heads" head-theme="dark" :config="$config" theme="light" striped hoverable
        with-buttons beautify>
        
        


        @foreach ($pagamentos->get() as $pagamento)
                
                @php

                    $total += $pagamento->valor_pago;
                
                    $pagamento->data = new Carbon($pagamento->data);
                    $pagamento->data = $pagamento->data->isoFormat('DD/MM/YYYY');
                    $pagamento->periodo_fiscal = new Carbon($pagamento->periodo_fiscal);
                    $pagamento->periodo_fiscal = $pagamento->periodo_fiscal->isoFormat('MM-YYYY');
                    if ($pagamento->mensalidade > $pagamento->valor_pago && $pagamento->valor_pago != 0) {
                            $cor = '#FFBA41';
                        }
                        elseif ($pagamento->mensalidade <= $pagamento->valor_pago) {
                            $cor = 'LimeGreen';
                        }
                        else {
                            $cor = 'purple';
                        }

                    // dd(Aluno::find($pagamento->aluno_id)->nome);

                @endphp
            <tr>
                

                <td>{{ $pagamento->id }}</td>
                <td>{{ Aluno::withTrashed()->find($pagamento->aluno_id)->nome }}</td>
                <td>{{ Aluno::withTrashed()->find($pagamento->aluno_id)->cpf }}</td>
                <td>{{ $pagamento->data }}</td>
                <td>{{ $pagamento->categoria }}</td>
                <td>{{ $pagamento->periodo_fiscal }}</td>
                <td>{{ 'R$ ' . number_format($pagamento->mensalidade, 2) }}</td>
                <td style="color: {{ $cor }}">{{ 'R$ ' . number_format($pagamento->valor_pago, 2) }}</td>
                
                    
                    
                
            </tr>
        @endforeach
        
        
        
        
        
    </x-adminlte-datatable>

    
    
    <div class="row">
        
        <div class="col-md-6">
            <x-adminlte-info-box title="Mensalidades Pagas" text="{{ $pagamentos->count() }}" icon="fas fa-lg fa-wallet text-white" theme="gradient-teal"/> 
            
        </div>
        <div class="col-md-6">
            <x-adminlte-info-box title="Subtotal" text="{{ 'R$ '.number_format($total, 2) }}" icon="fas fa-lg fa-dollar-sign text-white" theme="gradient-teal"/> 

        </div>
        
        

    </div>

    <center>
        <button class="btn btn-primary hidden-print" onclick="printar()"><span class="glyphicon glyphicon-print" aria-hidden="true"></span>Imprimir</button>
   </center>



    








@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">

@stop

@section('js')

<script>
    function printar() {
    window.print();
}
</script>

@stop

@section('footer')
    <h6 align="center" style=""></a>AdminCEU - <a href="https://www.linkedin.com/in/henrique-gabriel-siqueira-da-cruz-0826a4146/">Henrique gabriel</a>  Todos os Direitos Reservados <a href="https://github.com/Henriquegab" class="fa fa-github"></a></h6>
    
@stop
