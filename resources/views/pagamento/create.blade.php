@extends('adminlte::page')

@section('title', 'Pagamentos - Seleção de Aluno')

@section('content_header')
    
@stop

@section('content')

@php
    
@endphp

<div class="row justify-content-center align-self-center">

    <x-adminlte-card class="mt-3" style="width: 50rem;" title="Pagamentos - Seleção de Aluno" theme="dark" icon="far fa-fw fa-file">
    
        <form method="post" action="{{ route('pagamentos.create2') }}">
            @csrf
            
            <div class="form-row">


                @php

                

                


                $optionsc = [];
               
        
                    foreach ($alunos as $aluno) {

                        if (!$aluno->pagamento_id) {
                            $optionsc += [$aluno->id => $aluno->nome.' ('.$aluno->cpf.')'];
                        }
                        
                    }
            @endphp
            <x-adminlte-select2 enable-old-support required label="Aluno" name="aluno_id" fgroup-class="col-md-12" id="aluno">
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
    <h6 align="center" style=""></a>Happy System - <a href="https://www.linkedin.com/in/henrique-gabriel-siqueira-da-cruz-0826a4146/">Henrique gabriel</a>  Todos os Direitos Reservados <a href="https://github.com/Henriquegab" class="fa fa-github"></a></h6>
    
@stop