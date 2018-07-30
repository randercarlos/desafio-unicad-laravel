
@extends('template.app')

@section('main_title')
    {{ isset($delivery) ? 'Editar Entrega' : 'Nova Entrega' }}
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/libs/datepicker/dist/datepicker.min.css') }}">
@endpush


@section('content')
    
    @include('includes.errors')
    
    
    @if (isset($delivery))
        {!! Form::model($delivery, ['route' => ['deliveries.update', $delivery->id], 'method' => 'PUT']) !!}
    @else
        {!! Form::open(['route' => 'deliveries.store']) !!}
    @endif
    

    <div class="row">
    
        <div class="form-group col-md-10 {{ $errors->has('client') ? 'has-error' : '' }}">
            <label class="control-label" for="client">Nome do cliente:</label>
            
            {!! Form::text('client', null, ['class' => 'form-control altura', 
                'placeholder' => 'Informe o nome do cliente...', 'maxlength' => '100']) !!}
                
            <span class="help-block"> {{ $errors->first('client') }}</span>
        </div>
                 
        <div class="form-group col-md-2 {{ $errors->has('delivery_date') ? 'has-error' : '' }}">
            <label class="control-label" for="delivery_date">Data de entrega:</label>
            
            {!! Form::text('delivery_date', null, ['class' => 'form-control altura', 
                'placeholder' => 'Informe a data de entrega...', 'maxlength' => '10']) !!}
                
            <span class="help-block"> {{ $errors->first('delivery_date') }}</span>
        </div>
                   
    </div>
    
    
    <div class="row">
    
        <div class="form-group col-md-6 {{ $errors->has('starting_point') ? 'has-error' : '' }}">
            <label class="control-label" for="starting_point">Ponto de partida:</label>
            
           {!! Form::text('starting_point', null, ['class' => 'form-control altura', 
                'placeholder' => 'Informe o ponto de partida...', 'maxlength' => '200']) !!}
                
            <span class="help-block"> {{ $errors->first('starting_point') }} </span>
            
        </div>
                 
        <div class="form-group col-md-6 {{ $errors->has('endpoint') ? 'has-error' : '' }}">
            <label class="control-label" for="endpoint">Ponto de destino:</label>
            
            {!! Form::text('endpoint', null, ['class' => 'form-control altura', 
                'placeholder' => 'Informe o ponto de destino...', 'maxlength' => '200']) !!}
                
            <span class="help-block"> {{ $errors->first('endpoint') }} </span>
        </div>
                   
    </div>
    
    <br/>
    
    <div class="row">    
        <div class="text-right col-xs-12">
            <div class="hidden-xs">
                <a href="{{ route('deliveries.index') }}" class="btn btn-warning"> Voltar para listagem</a>
                <button type="submit" class="btn btn-primary"><i class="fa fa-refresh"></i> Salvar dados</button>
            </div>
        </div>
    </div>
    
    
    {!! Form::close() !!}    

@endsection


@push('scripts')

    <script src="{{ asset('assets/libs/datepicker/dist/datepicker.min.js') }}"></script>
    <script type="text/javascript">

        $(document).ready(function(){ 
            
            $('input[name="delivery_date"]').datepicker({
                language: 'pt-BR',
                format: 'dd/mm/yyyy',
                autoHide: true
            });

        });
        
     </script>
     
@endpush