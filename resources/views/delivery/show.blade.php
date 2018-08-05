
@extends('template.app')

@section('main_title', 'Visualizar rota de entrega')


@section('content')
    
    <div class="row">
    
        <div class="col-md-8">
            <h3 class="text-left"><b>Cliente:</b> {{ $delivery->client }}</h3>
        </div>
        
        <div class="col-md-4">
            <h3 class="text-right"><b>Data de entrega:</b> {{ $delivery->delivery_date }}</h3>
        </div>
        
    </div>
    
    
    <div class="row" style="margin-bottom: 20px">
    
        <div class="col-md-6">
            <h3 class="text-left">
            
                <div>
                    <b>Ponto de partida(<span class="text-danger">Ponto A</span>):</b> 
                </div>
                 
                <div>
                    {{ $delivery->starting_point }}
                </div>
            </h3>
        </div>
        
        <div class="col-md-6">
            <h3 class="text-right">
                <div>
                    <b>Ponto de destino(<span class="text-warning">Ponto B</span>):</b> 
                </div>
                
                <div>
                    {{ $delivery->endpoint }}
                </div>
            </h3>
        </div>
        
    </div>
    
    <div id="map" style="margin-right: 20px; float:left; width:68%; height:800px"></div>
    <div id="panel-direction" style="float:right; width:30%; height 800px; margin: -10px; margin-bottom: 30px;"></div>
    
    
    <div class="row">    
        <div class="text-right col-xs-12">
            <div class="hidden-xs">
                <a href="{{ route('deliveries.index') }}" class="btn btn-warning"> Voltar para listagem</a>
            </div>
        </div>
    </div>
    
@endsection


@push('scripts')
    <script type="text/javascript" 
        src="https://maps.googleapis.com/maps/api/js?key=COLOCAR_SUA_API_KEY_DO_GOOGLE_MAPS"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
    <script src="{{ asset('assets/js/googlemap.js') }}"></script>
    
    <script type="text/javascript">

        // chama a API do google maps e exibe o mapa. Recebe os pontos/endereços de início e destino.
        bytutorialMap.getGeolocationData('{{ $delivery->starting_point }}', '{{ $delivery->endpoint }}');
   
    </script>
     
@endpush
