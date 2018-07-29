
@extends('template.app')

@section('main_title', 'Gestão de Militares')

@section('content')
    
    
    @include('includes.alerts')
    
    
    <p class="text-right">
        <a href="{{ route('militares.create') }}" class="btn btn-primary">
            <i class="fa fa-plus-circle"></i> Cadastrar Novo
        </a>
    </p>
    
    
    <table class="table table-striped table-bordered" id="tb1">
        <tr>
            <th>Nome</th>
            <th width="10%" class="text-center">Nascimento</th>
            <th width="17%" class="text-center">Prestou serviço militar ?</th>
            <th width="12%" class="text-center">Patente</th>
            <th width="11%" class="text-center">Identidade</th>
            <th class="text-center" width="10%">
                <i class="fa fa-cog"></i>
            </th>
        </tr>
        
        @forelse($militares as $militar)
            <tr>
                <td> 
                    <a href="{{ route('militares.edit', $militar->id) }}">
                        {{ $militar->nome }} 
                    </a>
                </td>
                <td class="text-center"> {{ $militar->data_nascimento }}</td>
                <td class="text-center"> {{ $militar->servico_militar_obrigatorio }}</td>
                <td class="text-center"> <span class="label label-success">{{ $militar->patente }}</span> </td>
                <td class="text-center"> {{ $militar->identidade }}</td>
                <td class="text-center">
                 
                    <a href="{{ route('militares.edit', $militar->id) }}" class="btn btn-primary btn-sm" 
                        data-toggle="tooltip" title="editar">
                        <i class="fa fa-edit"></i>
                    </a>
                    
                    <button data-link="{{ route('militares.destroy', $militar->id) }}" 
                        data-resource="{{ $militar->nome }}" class="btn btn-danger btn-sm btn-remover" 
                        data-toggle="tooltip" title="remover">
                            <i class="fa fa-trash"></i> 
                    </button>
                </td>
            </tr>
        @empty
        
            <tr>
                <td colspan='6' style='text-align: center;'>Nenhum registro encontrado!</td>            
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
                    <h4 class="modal-title">Remover militar</h4>
                </div>
                
                <div class="modal-body">
                    <p>Deseja realmente remover o militar "<span id='name_resource'></span>" ?</p>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <a href="#" class="btn btn-danger" id="link-remover">Remover</a>
                </div>
                
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    
    
    
    <!-- Formulário necessário para se excluir um registro via método DELETE -->
    {!! Form::open(['route' => ['militares.destroy', 1], 'id' => 'form_delete',
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