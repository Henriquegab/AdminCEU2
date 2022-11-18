@extends('adminlte::page')

@section('title', 'Edição de Inscrição')

@section('content_header')

@stop

@section('content')

@php
    use Carbon\Carbon;
    $hoje = Carbon::now();
    // dd($aluno->observacao);
@endphp

<script>
// função pra limitar campo de cpf pra ter apenas digitos
    function onlyNumberKey(evt) {

        // Only ASCII character in that range allowed
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
            return false;
        return true;
    }
</script>

<script>
    // função javascript pra evitar de fazer o submit caso haja campos invládios pelo frontend
    (function() {
      'use strict';
      window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
          form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
        });
      }, false);
    })();
    </script>

<x-adminlte-card class="mt-3" title="Ficha de Inscrição" theme="dark" icon="far fa-fw fa-file">
    <form method="post" action="{{ route('alunos.update', ['aluno' => $aluno]) }}">
        @csrf
        @method('PUT')
        <div class="form-row">


            <div class="col-md-6 mb-3">
                <label for="nome">Nome*</label>
                <input type="text" class="form-control @error('nome') is-invalid @enderror" value="{{ isset($aluno) ? $aluno['nome'] : old('nome') }}" name="nome" placeholder="Henrique Gabriel" required>
                @error('nome') <div class="invalid-feedback">{{ $errors->first('nome') }}</div> @enderror
            </div>

            <div class="col-md-2 mb-3">
                <label for="cpf">CPF*</label>
                <input type="text" value="{{ isset($aluno) ? $aluno['cpf'] : old('cpf') }}" class="form-control @error('cpf') is-invalid @enderror" name="cpf" placeholder="111.444.777-99" data-mask="000.000.000-00" required>
                @error('cpf') <div class="invalid-feedback">{{ $errors->first('cpf') }}</div> @enderror
            </div>

            <div class="col-md-4 mb-3">
                <label for="nascimento">Data de Nascimento*</label>
                <input type="date" value="{{ isset($aluno) ? $aluno['nascimento'] : old('nascimento') }}" class="form-control @error('nascimento') is-invalid @enderror" name="nascimento" placeholder="12/12/2012" required required max = {{ date(now()) }}>
                @error('nascimento') <div class="invalid-feedback">{{ $errors->first('nascimento') }}</div> @enderror
            </div>







        </div>
        <div class="form-row">

            <div class="col-md-6 mb-3">
                <label for="pai">Pai</label>
                <input type="text" class="form-control" name="pai" value="{{ isset($aluno) ? $aluno['pai'] : old('pai') }}" placeholder="Roberto Silveira">

            </div>
            <div class="col-md-6 mb-3">
                <label for="mae">Mãe</label>
                <input type="text" class="form-control" name="mae" value="{{ isset($aluno) ? $aluno['mae'] : old('mae') }}" placeholder="Maria do Carmo">

            </div>


        </div>

        <div class="form-row">

            <div class="col-md-4 mb-3">
                <label for="endereco">Endereço*</label>
                <input type="text" value="{{ isset($aluno) ? $aluno['endereco'] : old('endereco') }}" class="form-control @error('endereco') is-invalid @enderror" name="endereco" placeholder="Rua do Cristal" required>
                @error('endereco') <div class="invalid-feedback">{{ $errors->first('endereco') }}</div> @enderror
            </div>

            <div class="col-md-2 mb-3">
                <label for="numero">Número*</label>
                <input type="text" value="{{ isset($aluno) ? $aluno['numero'] : old('numero') }}" class="form-control @error('numero') is-invalid @enderror" name="numero" placeholder="123" required>
                @error('numero') <div class="invalid-feedback">{{ $errors->first('numero') }}</div> @enderror
            </div>

            <div class="col-md-2 mb-3">
                <label for="telefone">Telefone</label>
                <input type="text" value="{{ isset($aluno) ? $aluno['telefone'] : old('telefone') }}" class="form-control" name="telefone" placeholder="(38) 94002-8922" data-mask="(00) 000000000">

            </div>

            @php
                $optionsc = [];

                    foreach ($categorias as $categoria) {
                        $optionsc += [$categoria->id => $categoria->categoria];
                    }
            @endphp
            <x-adminlte-select2 enable-old-support required label="Categoria*" name="categoria_id" fgroup-class="col-md-4">
                <x-adminlte-options

                        empty-option="Selecione uma opção"
                        :options="$optionsc"
                        :selected="isset($aluno) ? $aluno['categoria_id'] : '' "

                        />
            </x-adminlte-select2>


        </div>

        <div class="form-row">

            {{-- <x-adminlte-select enable-old-support required label="Modalidade*" name="modalidade" fgroup-class="col-md-4">

                                    <option selected value="" disabled>Selecione uma opção</option>
                                    <option>Natação</option>
                                    <option>Hidroginástica</option>
                                    <option>Tênis</option>

            </x-adminlte-select> --}}



            {{-- <div class="col-md-2 mb-3">
                <label for="inicio">Início*</label>
                <input type="time" value="{{ old('inicio') }}" class="form-control @error('inicio') is-invalid @enderror" name="inicio" placeholder="11:45" required>
                @error('inicio') <div class="invalid-feedback">{{ $errors->first('inicio') }}</div> @enderror
            </div>
            <div class="col-md-2 mb-3">

                    <label for="termino">Término*</label>
                    <input type="time" value="{{ old('termino') }}" class="form-control @error('termino') is-invalid @enderror" name="termino" placeholder="12:45" required>
                    @error('termino') <div class="invalid-feedback">{{ $errors->first('termino') }}</div> @enderror




            </div> --}}

            <div class="col-md-4 mb-3">
                <label for="data_atestado">Data do atestado*</label>
                <input type="date" value="{{ isset($aluno) ? $aluno['data_atestado'] : old('data_atestado') }}" class="form-control @error('data_atestado') is-invalid @enderror" name="data_atestado" placeholder="12/12/2012" required required max = {{ date(now()) }}>
                @error('data_atestado') <div class="invalid-feedback">{{ $errors->first('data_atestado') }}</div> @enderror
            </div>

            <div class="col-md-8 mb-3">
                <label for="observacao">Observações</label>
                <x-adminlte-textarea name="observacao" placeholder="Insira aqui suas observações">{{ isset($aluno) ? $aluno['observacao'] : old('observacao') }}</x-adminlte-textarea>

            </div>


        </div>

        <div class="form-row">


            {{-- <div class="col-md-1 mb-3">
                <label for="segunda">Segunda</label>
                <input type="checkbox" class="input-group" name="segunda" {{ old('segunda') ? 'checked' : ''}}/>
            </div>
            <div class="col-md-1 mb-3">
                <label for="terca">Terça</label>
                <input type="checkbox" class="input-group" name="terca"  {{ old('terca') ? 'checked' : ''}}/>
            </div>
            <div class="col-md-1 mb-3">
                <label for="quarta">Quarta</label>
                <input type="checkbox" class="input-group" name="quarta"  {{ old('quarta') ? 'checked' : ''}}/>
            </div>
            <div class="col-md-1 mb-3">
                <label for="quinta">Quinta</label>
                <input type="checkbox" class="input-group" name="quinta"  {{ old('quinta') ? 'checked' : ''}}/>
            </div>
            <div class="col-md-1 mb-3">
                <label for="sexta">Sexta</label>
                <input type="checkbox" class="input-group" name="sexta"  {{ old('sexta') ? 'checked' : ''}}/>
            </div> --}}








        </div>
        <div class="form-row">

            <hr>

        </div>


        {{-- <input type="hidden" value="{{ $hoje }}" name="data">
        <input type="hidden" value="" name="dias"> --}}

        <button class="btn btn-primary" type="submit">Cadastrar</button>









</x-adminlte-card>

{{-- Componente de seleção de horários --}}

<div class="card card-dark card-outline">
    <div class="card-body table-responsive px-10 pt-10">
        <table class="table table-bordered table-striped dataTable dtr-inline">
            <thead>

                <th style="width:10%">Dia da Semana</th>
                <th>Início</th>
                <th>Término</th>
                <th style="width:15%">Ações</th>

            </thead>
            <tbody>

            @php
                $dia = [];

                $cont = 0;
                foreach($aluno->horarios as $horarios){
                    if ($horarios->dia == 'segunda') {
                        $segunda = $horarios;
                    }
                    if ($horarios->dia == 'terca') {
                        $terca = $horarios;
                    }
                    if ($horarios->dia == 'quarta') {
                        $quarta = $horarios;
                    }
                    if ($horarios->dia == 'quinta') {
                        $quinta = $horarios;
                    }
                    if ($horarios->dia == 'sexta') {
                        $sexta = $horarios;
                    }

                    $cont++;
                }

            @endphp

                <tr>

                    <td>Segunda</td>
                    <td>

                        <input id="inicio_segunda" type="time" value="{{ isset($segunda) ? $segunda->entrada : '' }}" class="form-control @error('inicio_segunda') is-invalid @enderror" name="inicio_segunda" placeholder="11:45">
                        @error('inicio_segunda') <div class="invalid-feedback">{{ $errors->first('inicio_segunda') }}</div> @enderror
                    </td>
                    <td>

                        <input id="termino_segunda" type="time" value="{{ isset($segunda) ? $segunda->saida : '' }}" class="form-control @error('termino_segunda') is-invalid @enderror" name="termino_segunda" placeholder="12:45">
                        @error('termino_segunda') <div class="invalid-feedback">{{ $errors->first('termino_segunda') }}</div> @enderror

                    </td>
                    <td>

                        <button type="button" class="btn btn-danger" id="remover_segunda">Remover</button>


                    </td>

                </tr>
                <tr>

                    <td>Terça</td>
                    <td>

                        <input type="time" id="inicio_terca" value="{{ isset($terca) ? $terca->entrada : '' }}" class="form-control @error('inicio_terca') is-invalid @enderror" name="inicio_terca" placeholder="11:45">
                        @error('inicio_terca') <div class="invalid-feedback">{{ $errors->first('inicio_terca') }}</div> @enderror
                    </td>
                    <td>

                        <input type="time" id="termino_terca" value="{{ isset($terca) ? $terca->saida : '' }}" class="form-control @error('termino_terca') is-invalid @enderror" name="termino_terca" placeholder="12:45">
                        @error('termino_terca') <div class="invalid-feedback">{{ $errors->first('termino_terca') }}</div> @enderror

                    </td>
                    <td>

                        <button type="button" class="btn btn-danger" id="remover_terca">Remover</button>


                    </td>

                </tr>
                <tr>

                    <td>Quarta</td>
                    <td>

                        <input type="time" id="inicio_quarta" value="{{ isset($quarta) ? $quarta->entrada : '' }}" class="form-control @error('inicio_quarta') is-invalid @enderror" name="inicio_quarta" placeholder="11:45">
                        @error('inicio_quarta') <div class="invalid-feedback">{{ $errors->first('inicio_quarta') }}</div> @enderror
                    </td>
                    <td>

                        <input type="time" id="termino_quarta" value="{{ isset($quarta) ? $quarta->saida : '' }}" class="form-control @error('termino_quarta') is-invalid @enderror" name="termino_quarta" placeholder="12:45">
                        @error('termino_quarta') <div class="invalid-feedback">{{ $errors->first('termino_quarta') }}</div> @enderror

                    </td>
                    <td>

                        <button type="button" class="btn btn-danger" id="remover_quarta">Remover</button>


                    </td>

                </tr>
                <tr>

                    <td>Quinta</td>
                    <td>

                        <input type="time" id="inicio_quinta" value="{{ isset($quinta) ? $quinta->entrada : '' }}" class="form-control @error('inicio_quinta') is-invalid @enderror" name="inicio_quinta" placeholder="11:45">
                        @error('inicio_quinta') <div class="invalid-feedback">{{ $errors->first('inicio_quinta') }}</div> @enderror
                    </td>
                    <td>

                        <input type="time" id="termino_quinta" value="{{ isset($quinta) ? $quinta->saida : '' }}" class="form-control @error('termino_quinta') is-invalid @enderror" name="termino_quinta" placeholder="12:45">
                        @error('termino_quinta') <div class="invalid-feedback">{{ $errors->first('termino_quinta') }}</div> @enderror

                    </td>
                    <td>

                        <button type="button" class="btn btn-danger" id="remover_quinta">Remover</button>


                    </td>

                </tr>
                <tr>

                    <td>Sexta</td>
                    <td>

                        <input type="time" id="inicio_sexta" value="{{ isset($sexta) ? $sexta->entrada : '' }}" class="form-control @error('inicio_sexta') is-invalid @enderror" name="inicio_sexta" placeholder="11:45">
                        @error('inicio_sexta') <div class="invalid-feedback">{{ $errors->first('inicio_sexta') }}</div> @enderror
                    </td>
                    <td>

                        <input type="time" id="termino_sexta" value="{{ isset($sexta) ? $sexta->saida : '' }}" class="form-control @error('termino_sexta') is-invalid @enderror" name="termino_sexta" placeholder="12:45">
                        @error('termino_sexta') <div class="invalid-feedback">{{ $errors->first('termino_sexta') }}</div> @enderror

                    </td>
                    <td>

                        <button type="button" class="btn btn-danger" id="remover_sexta">Remover</button>


                    </td>

                </tr>

            </tbody>

        </form>
        </table>
       {{-- <div class="form-row">
            <select class="form-select-lg mb-3" name="horarios">
                <option selected disabled hidden value="">...</option>
                <option>Segunda</option>
                <option>Terça</option>
                <option>Quarta</option>
                <option>Quinta</option>
                <option>Sexta</option>

            </select>
       </div> --}}
    </div>

</div>







@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>

    remover_segunda.onclick = function(){
        document.getElementById("inicio_segunda").value = "";
        document.getElementById("termino_segunda").value = "";
    };
    remover_terca.onclick = function(){
        document.getElementById("inicio_terca").value = "";
        document.getElementById("termino_terca").value = "";
    };
    remover_quarta.onclick = function(){
        document.getElementById("inicio_quarta").value = "";
        document.getElementById("termino_quarta").value = "";
    };
    remover_quinta.onclick = function(){
        document.getElementById("inicio_quinta").value = "";
        document.getElementById("termino_quinta").value = "";
    };
    remover_sexta.onclick = function(){
        document.getElementById("inicio_sexta").value = "";
        document.getElementById("termino_sexta").value = "";
    };






</script>
@stop

@section('footer')
<h6 align="center" style=""></a>AdminCEU - <a href="https://www.linkedin.com/in/henrique-gabriel-siqueira-da-cruz-0826a4146/">Henrique gabriel</a>  Todos os Direitos Reservados <a href="https://github.com/Henriquegab" class="fa fa-github"></a></h6>

@stop
