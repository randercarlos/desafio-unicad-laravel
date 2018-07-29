
@extends('template.app')

@section('main_title', 'Militares')


@push('styles')
    <link rel="stylesheet" 
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="{{ asset('assets/libs/datepicker/dist/datepicker.min.css') }}">
@endpush


@section('content')
    
    @include('includes.errors')
    
    
    @if (isset($militar))
        {!! Form::model($militar, ['route' => ['militares.update', $militar->id], 'method' => 'PUT']) !!}
    @else
        {!! Form::open(['route' => 'militares.store']) !!}
    @endif
    

    <div class="row">
    
        <div class="form-group col-md-10 {{ $errors->has('nome') ? 'has-error' : '' }}">
            <label class="control-label" for="nome">Nome completo:</label>
            {!! Form::text('nome', null, ['class' => 'form-control altura', 
                'placeholder' => 'Informe o nome do militar...', 'maxlength' => '100']) !!}
            <span class="help-block"> {{ $errors->first('nome') }}</span>
        </div>
                 
        <div class="form-group col-md-2 {{ $errors->has('data_nascimento') ? 'has-error' : '' }}">
            <label class="control-label" for="data_nascimento">Data de nascimento:</label>
            {!! Form::text('data_nascimento', null, ['class' => 'form-control altura', 
                'placeholder' => 'Informe o nascimento...', 'maxlength' => '10']) !!}
             <span class="help-block"> {{ $errors->first('data_nascimento') }}</span>
        </div>
                   
    </div>
    
    
    <div class="row">
    
        <div class="form-group col-md-4 {{ $errors->has('servico_militar_obrigatorio') ? 'has-error' : '' }}">
            <label class="control-label" for="servico_militar_obrigatorio">Prestou serviço militar obrigatório ?</label>
            
            {!! Form::select('servico_militar_obrigatorio', ['1' => 'Sim', '0' => 'Não'], 
                isset($militar) ? intval($militar->servico_militar_obrigatorio) : 0, 
                ['class' => 'form-control altura', 
                'style' => 'padding: 0px 0px 0px 10px']) !!}
            <span class="help-block"> {{ $errors->first('servico_militar_obrigatorio') }}</span>
            
        </div>
                 
        <div class="form-group col-md-4 {{ $errors->has('patente') ? 'has-error' : '' }}">
            <label class="control-label" for="patente">Patente:</label>
            {!! Form::select('patente', $patentes, null, ['placeholder' => 'Selecione a patente...', 
                'class' => 'form-control altura', 'style' => 'padding: 0px 0px 0px 10px']) !!}
            <span class="help-block"> {{ $errors->first('patente') }}</span>
        </div>
        
        <div class="form-group col-md-4 {{ $errors->has('identidade') ? 'has-error' : '' }}">
            <label class="control-label" for="identidade">Identidade:</label>
            {!! Form::text('identidade', null, ['class' => 'form-control altura', 
                'placeholder' => 'Informe a identidade...', 'maxlength' => '20']) !!}
            <span class="help-block"> {{ $errors->first('identidade') }}</span>
        </div>
                   
    </div>
    
    <br/>
    
    <div class="row">    
        <div class="text-right col-xs-12">
            <div class="hidden-xs">
                <a href="{{ route('militares.index') }}" class="btn btn-warning"> Voltar para listagem</a>
                <button type="submit" class="btn btn-primary"><i class="fa fa-refresh"></i> Salvar dados</button>
            </div>
        </div>
    </div>
    
    
    {!! Form::close() !!}    

@endsection


@push('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
    <script src="{{ asset('assets/js/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datepicker/dist/datepicker.min.js') }}"></script>
    <script type="text/javascript">

        $(document).ready(function(){ 
            
        	//$('input[name="identidade"]').mask('000000000000');


            $('input[name="data_nascimento"]').datepicker({
                language: 'pt-BR',
                format: 'dd/mm/yyyy'
            });

            
            $('select[name="servico_militar_obrigatorio"]').change(function() {

                var patentes_com_servico_militar = ['Soldado', 'Cabo', 'Sargento'];
                var patentes_sem_servico_militar = ['Soldado', 'Cabo', 'Sargento', 'Subtenente', 'Tenente', 'Capitão', 
                    'General'];
                var options = '';


                // se prestou serviço militar obrigatório, atribui somente as patentes relacionadas('Soldado', 'Cabo', 
                // 'Sargento'). Caso contrário, atribui todas as patente
                if ($(this).find(':selected').val().toString() == "1") {
                    options = patentes_com_servico_militar;
                } else {
                	options = patentes_sem_servico_militar;
                }


                // remove todas as options com exceção da primeira(Selecione a patente...)
                $('select[name="patente"]').find('option:not(:first)').remove();

                // transforma o array de patentes em options para ser adicionado dentro do select de patentes                
                $(options).each(function(texto, valor){
                	$('select[name="patente"]').append($("<option>", { value: valor, html: valor }));
            	});

            });


            // executa a função de seleção de patentes ao carregar a página. 
            // OBS: A função trigger deve vir depois do evento que ela chama, senão não funciona.
            $('select[name="servico_militar_obrigatorio"]').trigger("change");

            // correção de bug na select de patentes ao editar militar
            $('select[name="patente"] option[value="{{ isset($militar) ? $militar->patente : '' }}"]')
            .attr('selected','selected');
            
        });
        
     </script>
     
@endpush