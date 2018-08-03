
@extends('template.app')

@section('main_title', 'Listagem de Entregas')

@section('content')
    
    
    @include('includes.alerts')
    
    
    <p class="text-right">
        <a href="{{ route('deliveries.create') }}" class="btn btn-primary">
            <i class="fa fa-plus-circle"></i> Cadastrar Novo
        </a>
    </p>
    
    
    <table class="table table-striped table-bordered" id="tb1" cellspacing="10px">
        <tr>
            <th width="25%">Cliente</th>
            <th width="9%" class="text-center">Data entrega</th>
            <th>Ponto de partida</th>
            <th>Ponto de destino</th>
            <th width="130px" class="text-center" >
                <i class="fa fa-cog"></i>
            </th>
        </tr>
        
        @forelse($deliveries as $delivery)
            <tr >
                <td style="vertical-align: middle;"> 
                    <a href="{{ route('deliveries.edit', $delivery->id) }}">
                        {{ $delivery->client }} 
                    </a>
                </td>
                <td class="text-center" style="vertical-align: middle;"> {{ $delivery->delivery_date }}</td>
                <td style="vertical-align: middle;"> {{ $delivery->starting_point }}</td>
                <td style="vertical-align: middle;"> {{ $delivery->endpoint }}</td>
                <td class="text-center" style="vertical-align: middle;">
                 
                    <a href="{{ route('deliveries.edit', $delivery->id) }}" class="btn btn-primary btn-sm" 
                        data-toggle="tooltip" title="editar">
                        <i class="fa fa-edit"></i>
                    </a>
                    
                    <button data-link="{{ route('deliveries.destroy', $delivery->id) }}" 
                        data-resource="{{ $delivery->client }}" class="btn btn-danger btn-sm btn-remover" 
                        data-toggle="tooltip" title="remover">
                            <i class="fa fa-trash"></i> 
                    </button>
                    
                    <a href="{{ route('deliveries.show', $delivery->id) }}" class="btn btn-info btn-sm" 
                        data-toggle="tooltip" title="Traçar rota">
                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                    </a>
                </td>
            </tr>
        @empty
        
            <tr>
                <td colspan='5' style='text-align: center;'>Nenhum registro encontrado!</td>            
            </tr>
            
        @endforelse
    </table>
    
    <div id="pageNav" class="text-center" ></div>
    
    <div class="modal fade" id="modal-remover">
        <div class="modal-dialog">
            <div class="modal-content">
            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Remover Entrega</h4>
                </div>
                
                <div class="modal-body">
                    <p>Deseja realmente remover a entrega do cliente "<span id='name_resource'></span>" ?</p>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <a href="#" class="btn btn-danger" id="link-remover">Remover</a>
                </div>
                
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    
    
    
    <!-- Formulário necessário para se excluir um registro via método DELETE -->
    {!! Form::open(['route' => ['deliveries.destroy', 1], 'id' => 'form_delete',
        'method' => 'DELETE']) !!}
        
    {!! Form::close() !!}
    
    
@endsection


@push('scripts')

    <script type="text/javascript">
        $(document).ready(function() {
            
             $('[data-toggle="tooltip"]').tooltip();

             
             $('.btn-remover').on('click', function () {
                 
                 var link = $(this).data('link');
                 var resource = $(this).data('resource');

                 $('#name_resource').html(resource);
                 $('#modal-remover').modal('show');
                 
                 $('#form_delete').attr('action', link);
             });

             
         	 //Warning Message
             $('#link-remover').click(function(e){
                 
            	  $('#form_delete').submit();
                 
             });
        });
     </script>
     
@endpush