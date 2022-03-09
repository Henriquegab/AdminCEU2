@extends('adminlte::page')

@section('title', 'Pagamentos - Seleção de Mês')

@section('content_header')
    
@stop

@section('content')

@php
    use Carbon\Carbon;
@endphp

<div class="row justify-content-center align-self-center">

    <x-adminlte-card class="mt-3" style="width: 50rem;" title="Pagamentos - Seleção de mês" theme="dark" icon="far fa-fw fa-file">
    
        <form method="get" action="{{ route('pagamentos.lista_relatorio') }}">
            @csrf
            
            <div class="form-row">


                @php

                

                


                $optionsc = [];
                
        
                    foreach ($periodofiscal as $mes) {

                        $mes->data = new Carbon($mes->data);
                        $mes->data = $mes->data->isoFormat('MM-YYYY');
                            $optionsc += [$mes->id => $mes->data];
                        
                        
                    }
            @endphp
            <x-adminlte-select2 enable-old-support required label="Mês de Referência" name="periodofiscal" fgroup-class="col-md-12" id="periodofiscal">
                <x-adminlte-options

                empty-option="Selecione uma opção"    
                        :options="$optionsc" 
                        
                        />
            </x-adminlte-select2>
            

    
                
    
                
    
    
    
    
    
            </div>
            
    
    
            
    
            <button class="btn btn-primary" type="submit">Continuar</button>
            
               
           
       </form>
    
    
    </x-adminlte-card>

</div>



    
        




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