<x-app-layout>
    @section('content')
    <div class="container" style="padding-top: 3rem; padding-bottom: 6rem;">
        <div class="form-row justify-content-center">
            <div class="col-md-9">
                <div class="form-row">
                    <div class="col-md-8">
                        <h4 class="card-title">Grupos cadastrados no sistema</h4>
                    </div>
                    <div class="col-md-4" style="text-align: right">
                        <a title="Novo grupo" href="{{route('setores.create')}}">
                            <img class="icon-licenciamento add-card-btn" src="{{asset('img/Grupo 1666.svg')}}" alt="Icone de adicionar grupo">
                        </a>
                    </div>
                </div>
                <div class="card card-borda-esquerda" style="width: 100%;">
                    <div class="card-body">
                        <div div class="form-row">
                            @if(session('success'))
                                <div class="col-md-12" style="margin-top: 5px;">
                                    <div class="alert alert-success" role="alert">
                                        <p>{{session('success')}}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div div class="form-row">
                            @error('error')
                                <div class="col-md-12" style="margin-top: 5px;">
                                    <div class="alert alert-danger" role="alert">
                                        <p>{{$message}}</p>
                                    </div>
                                </div>
                            @enderror
                        </div>
                        <div class="table-responsive">
                        <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nome</th>
                                        <th scope="col">Opções</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($setores as $i => $setor)
                                        <tr>
                                            <td scope="row">{{$i+1}}</td>
                                            <td>{{$setor->nome}}</td>
                                            <td>
                                                @if(Auth::user()->role == \App\Models\User::ROLE_ENUM['secretario'])
                                                    <a title="Visualizar cnaes do grupo" href="{{route('setores.show', ['setore' => $setor->id])}}"><img class="icon-licenciamento" width="20px;" src="{{asset('img/Visualizar.svg')}}" alt="Icone de visualizar setor"></a>
                                                    <a title="Editar grupo" href="{{route('setores.edit', ['setore' => $setor->id])}}"><img class="icon-licenciamento" src="{{asset('img/edit-svgrepo-com.svg')}}" alt="Icone de editar setor"></a>
                                                    <a title="Deletar grupo" data-toggle="modal" data-target="#modalStaticDeletarSetor_{{$setor->id}}" style="cursor: pointer;"><img class="icon-licenciamento" src="{{asset('img/trash-svgrepo-com.svg')}}" alt="Icone de deletar setor"></a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                        </table>
                        </div>
                    </div>
                </div>
                <div class="form-row justify-content-center">
                    <div class="col-md-10">
                        {{$setores->links()}}
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="col-md-12 shadow-sm p-2 px-3" style="background-color: #f8f9fa; border-radius: 00.5rem; margin-top: 2.6rem;">
                    <div style="font-size: 21px;" class="tituloModal">
                        Legenda
                    </div>
                    <ul class="list-group list-unstyled">
                        <li>
                            <div title="Adicionar grupo" class="d-flex align-items-center my-1 pt-0 pb-1" style="border-bottom:solid 2px #e0e0e0;">
                                <img class="aling-middle" style="border-radius: 50%;" width="20" src="{{asset('img/Grupo 1666.svg')}}" alt="Icone de adicionar grupo">
                                <div style="font-size: 15px;" class="aling-middle mx-3">
                                    Adicionar grupo
                                </div>
                            </div>
                        </li>
                        <li>
                            <div title="Visualizar grupo" class="d-flex align-items-center my-1 pt-0 pb-1" style="border-bottom:solid 2px #e0e0e0;">
                                <img class="aling-middle" width="20" src="{{asset('img/Visualizar.svg')}}" alt="Visualizar grupo">
                                <div style="font-size: 15px;" class="aling-middle mx-3">
                                    Visualizar grupo
                                </div>
                            </div>
                        </li>
                        <li>
                            <div title="Editar grupo" class="d-flex align-items-center my-1 pt-0 pb-1" style="border-bottom:solid 2px #e0e0e0;">
                                <img class="aling-middle" width="20" src="{{asset('img/edit-svgrepo-com.svg')}}" alt="Editar grupo">
                                <div style="font-size: 15px;" class="aling-middle mx-3">
                                    Editar grupo
                                </div>
                            </div>
                        </li>
                        <li>
                            <div title="Deletar grupo" class="d-flex align-items-center my-1 pt-0 pb-1" style="border-bottom:solid 2px #e0e0e0;">
                                <img class="aling-middle" width="20" src="{{asset('img/trash-svgrepo-com.svg')}}" alt="Deletar grupo">
                                <div style="font-size: 15px;" class="aling-middle mx-3">
                                    Deletar grupo
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    @foreach ($setores as $setor)
    <!-- Modal deletar setor -->
    <div class="modal fade" id="modalStaticDeletarSetor_{{$setor->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #dc3545;">
                    <h5 class="modal-title" id="staticBackdropLabel" style="color: white;">Confirmação</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="deletar-setor-form-{{$setor->id}}" method="POST" action="{{route('setores.destroy', ['setore' => $setor])}}">
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">
                        Tem certeza que deseja deletar o grupo {{$setor->nome}}?
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger submeterFormBotao" form="deletar-setor-form-{{$setor->id}}">Sim</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @endsection
</x-app-layout>
