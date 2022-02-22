@extends('adminlte::page')

@section('title', 'Cadastro de Categoria')

@section('content_header')
    
@stop

@section('content')



<div class="row justify-content-center align-self-center">

    <x-adminlte-card class="mt-3" style="width: 50rem;" title="Cadastro de Categoria" theme="dark" icon="far fa-fw fa-file">
    
        <form method="post" action="{{ route('pagamentos.store') }}">
            @csrf
            
            <div class="form-row">


                @php
                $optionsc = [];
        
                    foreach ($alunos as $aluno) {
                        $optionsc += [$aluno->id => $aluno->nome.' ('.$aluno->cpf.')'];
                    }
            @endphp
            <x-adminlte-select2 enable-old-support required label="Aluno" name="aluno_id" fgroup-class="col-md-4" id="aluno">
                <x-adminlte-options

                        empty-option="Selecione uma opção"        
                        :options="$optionsc" 
                        
                        />
            </x-adminlte-select2>
            

    
                <div class="col-md-2 mb-3">
                    <label for="aluno">Preço a pagar</label>
                    <input type="text" class="form-control" name="valor_pretendido" disabled value=" {{ 'R$ '.number_format($aluno->categoria->preco, 2) }} " required id="valor">
                    
                    {{-- {{ 'R$ '.number_format($aluno->categoria->preco, 2) }} --}}
                    
                </div>
            
                <script type="text/javascript">
                var valor = "<?php echo 'R$ '.number_format($aluno->categoria->preco, 2) ?>"
                    $('#aluno').on('change',function(){

                    var valor = $(this).find('option:selected').val();
                    // var valor = "<?php echo 'R$ '.number_format($aluno->categoria->preco, 2) ?>"
                    document.getElementById("valor").setAttribute('value', valor);
                
                });
                </script>
    
                
    
                <div class="col-md-4 mb-3">
                    <label for="preco">Valor Pago</label>
                    <input type="text" class="form-control @error('preco') is-invalid @enderror" name="preco" data-mask="R$ 00,00" maxlength="6" placeholder="40" value="{{ old('preco') }}" required>
                    @error('preco') <div class="invalid-feedback">{{ $errors->first('preco') }}</div> @enderror
                    
                </div>
    
                
    
    
    
    
    
            </div>
            
    
    
            
    
            <button class="btn btn-primary" type="submit">Cadastrar</button>
            
               
           
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