@extends('adminlte::page')

@section('title', 'Edição de Pagamento')

@section('content_header')

@stop

@section('content')

@php

@endphp

<div class="row justify-content-center align-self-center">

    <x-adminlte-card class="mt-3" style="width: 90%;" title="Edição de Pagamento" theme="dark" icon="far fa-fw fa-file">

        <form method="post" action="{{ route('pagamentos.update', $pagamento) }}">
            @csrf
            @method('PUT')

        <div class="form-row">

            {{-- <input type="hidden" value="{{ $aluno->id }}" name="aluno_id"> --}}

                <div class="col-md-6 mb-3">
                    <label for="aluno">Nome</label>

                        <input type="text" class="form-control" disabled value="{{ $aluno->nome }}">

                </div>
                <div class="col-md-2">
                    <label for="cpf">CPF</label>

                        <input type="text" class="form-control" disabled value="{{ $aluno->cpf }}">

                </div>
                {{-- <div class="col-md-2 mb-3">
                    <label for="modalidade">Modalidade</label>

                        <input type="text" class="form-control" disabled value="{{ $aluno->modalidade }}">

                </div> --}}
                <div class="col-md-4 mb-3">
                    <label for="categoria">Categoria</label>

                        <input type="text" class="form-control" disabled value="{{ $aluno->categoria->categoria }}">

                </div>
        </div>



                    <div class="form-row">


                <div class="col-md-2 mb-3">
                    <label for="aluno">Preço a pagar</label>

                        <input type="text" class="form-control" name="valor_pretendido" disabled value="{{ 'R$ '.number_format($aluno->categoria->preco, 2) }}">




                    {{-- {{ 'R$ '.number_format($aluno->categoria->preco, 2) }} --}}

                </div>





                <div class="col-md-4 mb-3">
                    <label for="valor_pago">Valor Pago em Reais</label>
                    <input type="text" class="form-control @error('valor_pago') is-invalid @enderror" name="valor_pago" data-mask="0000" maxlength="6" placeholder="40" value="{{ old('valor_pago') }}" required>
                    @error('valor_pago') <div class="invalid-feedback">{{ $errors->first('valor_pago') }}</div> @enderror

                </div>









            </div>














            <button class="btn btn-primary" type="submit" title="Confirmar">Confirmar Pagamento

            </button>










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
    <h6 align="center" style=""></a>AdminCEU - <a href="https://www.linkedin.com/in/henrique-gabriel-siqueira-da-cruz-0826a4146/">Henrique gabriel</a>  Todos os Direitos Reservados <a href="https://github.com/Henriquegab" class="fa fa-github"></a></h6>

@stop
