@extends('adminlte::page')

@section('title', 'Cadastro de Categoria')

@section('content_header')
    
@stop

@section('content')

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

<div class="row justify-content-center align-self-center">

    <x-adminlte-card class="mt-3" style="width: 35rem;" title="Cadastro de Categoria" theme="dark" icon="far fa-fw fa-file">
    
        <form method="post" action="{{ route('categorias.update', ['categoria' => $categoria]) }}">
            @csrf
            @method('PUT')
            
            <div class="form-row">
    
    
                <div class="col-md-8 mb-3">
                    <label for="categoria">Nome da categoria</label>
                    <input type="text" class="form-control @error('categoria') is-invalid @enderror" name="categoria" placeholder="Acadêmico" value="{{ old('categoria') ? old('categoria') : $categoria->categoria}}" required>
                    @error('categoria') <div class="invalid-feedback">{{ $errors->first('categoria') }}</div> @enderror
                    
                    
                </div>
    
                
    
                <div class="col-md-4 mb-3">
                    <label for="preco">Preço (em reais)</label>
                    <input type="number" class="form-control @error('preco') is-invalid @enderror" name="preco" data-mask="000000" maxlength="6" placeholder="40" value="{{ old('preco') ? old('preco') : $categoria->preco}}" required>
                    @error('preco') <div class="invalid-feedback">{{ $errors->first('preco') }}</div> @enderror
                    
                </div>
    
                
    
    
    
    
    
            </div>
            
    
    
            
    
            <button class="btn btn-primary" type="submit">Salvar</button>
            
               
           
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