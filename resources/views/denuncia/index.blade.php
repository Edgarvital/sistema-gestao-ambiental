<x-app-layout>

    <div class="container" style="padding-top: 5rem; padding-bottom: 8rem;">
        <div class="form-row justify-content-center">
            <div class="col-md-10">
                <div class="form-row">
                    <div class="col-md-8">
                        <h4 class="card-title">Denúncias</h4>
                    </div>
                </div>
                <div div class="form-row">
                    @if(session('success'))
                        <div class="col-md-12" style="margin-top: 5px;">
                            <div class="alert alert-success" role="alert">
                                <p>{{session('success')}}</p>
                            </div>
                        </div>
                    @endif
                </div>
                <ul class="nav nav-tabs nav-tab-custom" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="denuncias-pendentes-tab" data-toggle="tab" href="#denuncias-pendentes"
                            type="button" role="tab" aria-controls="denuncias-pendentes" aria-selected="true">Pendentes</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button id="link-denuncias-aprovados" class="nav-link" id="denuncias-aprovadas-tab" data-toggle="tab" role="tab" type="button"
                            aria-controls="denuncias-aprovadas" aria-selected="false" href="#denuncias-aprovadas">Aprovadas</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" type="button" id="denuncias-arquivadas-tab" data-toggle="tab" role="tab"
                            aria-controls="denuncias-arquivadas" aria-selected="false" href="#denuncias-arquivadas">Arquivadas</button>
                    </li>
                </ul>
                <div class="card" style="width: 100%;">
                    <div class="card-body">
                        <div class="tab-content tab-content-custom" id="myTabContent">
                            <div class="tab-pane fade show active" id="denuncias-pendentes" role="tabpanel" aria-labelledby="denuncias-pendentes-tab">
                                <table class="table mytable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col" style="text-align: center">Empresa/serviço</th>
                                            <th scope="col" style="text-align: center">Endereço</th>
                                            <th scope="col" style="text-align: center">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($denuncias_registradas as $i => $denuncia)
                                            <tr>
                                                <td>{{($i+1)}}</td>
                                                <td style="text-align: center">{{ $denuncia->empresa_id ? $denuncia->empresa->nome : $denuncia->empresa_nao_cadastrada }}</td>
                                                <td style="text-align: center">
                                                    {{ $denuncia->empresa_id ? $denuncia->empresa->endereco->enderecoSimplificado() : $denuncia->endereco }}
                                                </td>
                                                <td style="text-align: center">
                                                    <div class="btn-group">
                                                        @can('isSecretario', \App\Models\User::class)
                                                            <a data-toggle="modal" data-target="#modal-atribuir" onclick="adicionarIdAtribuir({{$denuncia->id}})" style="cursor: pointer; margin-left: 2px; margin-right: 2px;"><img  width="25" src="{{asset('img/task-svgrepo-com.svg')}}"  alt="Atribuir a um analista"></a>
                                                            <a id="btn-criar-visita-{{$denuncia->id}}" style="cursor: pointer; margin-left: 2px; margin-right: 2px;"
                                                                data-toggle="modal" data-target="#modal-avaliar-{{$denuncia->id}}"><img width="25" src="{{asset('img/file-warning-svgrepo-com.svg')}}"  alt="Avaliar"></a>
                                                        @endcan
                                                        <a data-toggle="modal" data-target="#modal-texto-{{$denuncia->id}}" style="cursor: pointer; margin-left: 2px; margin-right: 2px;"><img width="25" src="{{asset('img/eye.svg')}}"  alt="Descrição"></a>
                                                        <a data-toggle="modal" data-target="#modal-imagens-{{$denuncia->id}}" style="cursor: pointer; margin-left: 2px; margin-right: 2px;"><img width="25" src="{{asset('img/media.svg')}}"  alt="Mídia"></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="denuncias-aprovadas" role="tabpanel" aria-labelledby="denuncias-aprovadas-tab">
                                <table class="table mytable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col" style="text-align: center">Empresa/serviço</th>
                                            <th scope="col" style="text-align: center">Endereço</th>
                                            <th scope="col" style="text-align: center">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($denuncias_aprovadas as $i => $denuncia)
                                            <tr>
                                                <td>{{($i+1)}}</td>
                                                <td style="text-align: center">{{ $denuncia->empresa_id ? $denuncia->empresa->nome : $denuncia->empresa_nao_cadastrada }}</td>
                                                <td style="text-align: center">
                                                    {{ $denuncia->empresa_id ? $denuncia->empresa->endereco->enderecoSimplificado() : $denuncia->endereco }}
                                                </td>
                                                <td style="text-align: center">
                                                    <div class="btn-group">
                                                        @can('isSecretario', \App\Models\User::class)
                                                            <a data-toggle="modal" data-target="#modal-atribuir" onclick="adicionarIdAtribuir({{$denuncia->id}})" style="cursor: pointer; margin-left: 2px; margin-right: 2px;"><img  width="25" src="{{asset('img/task-svgrepo-com.svg')}}"  alt="Atribuir a um analista"></a>
                                                            <a id="btn-criar-visita-{{$denuncia->id}}" style="cursor: pointer; margin-left: 2px; margin-right: 2px;"
                                                                    data-toggle="modal" data-target="#modal-agendar-visita" onclick="adicionarId({{$denuncia->id}})"><img width="25" src="{{asset('img/agenda-svgrepo-com.svg')}}"  alt="Agendar uma visita"></a>
                                                        @endcan
                                                        <a data-toggle="modal" data-target="#modal-texto-{{$denuncia->id}}" style="cursor: pointer; margin-left: 2px; margin-right: 2px;"><img width="25" src="{{asset('img/eye.svg')}}"  alt="Descrição"></a>
                                                        <a data-toggle="modal" data-target="#modal-imagens-{{$denuncia->id}}" style="cursor: pointer; margin-left: 2px; margin-right: 2px;"><img width="25" src="{{asset('img/media.svg')}}"  alt="Mídia"></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="denuncias-arquivadas" role="tabpanel" aria-labelledby="denuncias-arquivadas-tab">
                                <table class="table mytable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col" style="text-align: center">Empresa/serviço</th>
                                            <th scope="col" style="text-align: center">Endereço</th>
                                            <th scope="col" style="text-align: center">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($denuncias_arquivadas as $i => $denuncia)
                                            <tr>
                                                <td>{{($i+1)}}</td>
                                                <td style="text-align: center">{{ $denuncia->empresa_id ? $denuncia->empresa->nome : $denuncia->empresa_nao_cadastrada }}</td>
                                                <td style="text-align: center">
                                                    {{ $denuncia->empresa_id ? $denuncia->empresa->endereco->enderecoSimplificado() : $denuncia->endereco }}
                                                </td>
                                                <td style="text-align: center">
                                                    <div class="btn-group">
                                                        @can('isSecretario', \App\Models\User::class)
                                                            <a data-toggle="modal" data-target="#modal-atribuir" onclick="adicionarIdAtribuir({{$denuncia->id}})" style="cursor: pointer; margin-left: 2px; margin-right: 2px;"><img  width="25" src="{{asset('img/task-svgrepo-com.svg')}}"  alt="Atribuir a um analista"></a>
                                                            <a id="btn-criar-visita-{{$denuncia->id}}" style="cursor: pointer; margin-left: 2px; margin-right: 2px;"
                                                                data-toggle="modal" data-target="#modal-avaliar-{{$denuncia->id}}"><img width="25" src="{{asset('img/file-warning-svgrepo-com.svg')}}"  alt="Avaliar"></a>
                                                        @endcan
                                                        <a data-toggle="modal" data-target="#modal-texto-{{$denuncia->id}}" style="cursor: pointer; margin-left: 2px; margin-right: 2px;"><img width="25" src="{{asset('img/eye.svg')}}"  alt="Descrição"></a>
                                                        <a data-toggle="modal" data-target="#modal-imagens-{{$denuncia->id}}" style="cursor: pointer; margin-left: 2px; margin-right: 2px;"><img width="25" src="{{asset('img/media.svg')}}"  alt="Mídia"></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach ($denuncias as $denuncia)
        <div class="modal fade" id="modal-texto-{{$denuncia->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color:#2a9df4;">
                            <img src="{{ asset('img/logo_atencao3.png') }}" width="30px;" alt="Logo" style=" margin-right:15px; margin-top:10px;"/>
                                <h5 class="modal-title" id="exampleModalLabel2" style="font-size:20px; margin-top:7px; color:white;
                                    font-weight:bold; font-family: 'Roboto', sans-serif;">
                                    Descrição
                                </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="formRequerimento" method="POST" action="">
                        @csrf
                        <div class="modal-body">
                            <div class="row form-row">
                                <div id="avisoReq" class="col-12" style="font-family: 'Roboto', sans-serif; margin-bottom:10px;">Relato descrito pelo denunciante:</div>
                                <div class="col-md-12 form-group">
                                    <div class="texto-denuncia">
                                        {!! $denuncia->texto !!}
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                @if ($denuncia->denunciante != null)
                                    <div class="col-md-12 form-group">
                                        <label for="denunciante">{{__('Denunciante')}}</label>
                                        <input class="form-control" type="text" value="{{$denuncia->denunciante}}" disabled>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade bd-example-modal-lg" id="modal-imagens-{{$denuncia->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelC" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color:#2a9df4;">
                            <img src="{{ asset('img/logo_atencao3.png') }}" alt="Logo" style=" margin-right:15px;"/>
                                <h5 class="modal-title" style="font-size:20px; color:white; font-weight:bold; font-family: 'Roboto', sans-serif;">
                                    Mídias da Denúncia
                                </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12" style="font-family: 'Roboto', sans-serif;">Imagens anexadas junto a denúncia:</div>
                        </div>
                        <br>
                        <div class="row">
                            @foreach ($denuncia->fotos as $foto)
                                <div class="col-md-6">
                                    <div class="card" style="width: 100%;">
                                        <img src="{{asset('storage/' . $foto->caminho)}}" class="card-img-top" alt="...">
                                        @if ($foto->comentario != null)
                                            <div class="card-body">
                                                <p class="card-text">{{$foto->comentario}}</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        @if ($denuncia->videos->first() != null)
                            <div class="row">
                                <div class="col-12" style="font-family: 'Roboto', sans-serif;">Vídeos anexados junto a denúncia:</div>
                            </div>
                            <br>
                            <div class="row">
                                @foreach ($denuncia->videos as $video)
                                    <div class="col-md-6">
                                        <video width="320" height="240" controls>
                                            <source src="{{asset('storage/' . $video->caminho)}}" >
                                            Seu navegador não suporta o tipo de vídeo.
                                        </video>
                                        <div class="card" style="width: 100%;">
                                            @if ($video->comentario != null)
                                                <div class="card-body">
                                                    <p class="card-text">{{$video->comentario}}</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-avaliar-{{$denuncia->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-imagens-{{$denuncia->id}}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color:#2a9df4;">
                            <img src="{{ asset('img/logo_atencao3.png') }}" alt="Logo" style=" margin-right:15px;"/>
                                <h5 class="modal-title" style="font-size:20px; color:white; font-weight:bold;
                                    font-family: 'Roboto', sans-serif;">
                                Avaliar Denúncia
                            </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12" style="font-family: 'Roboto', sans-serif;">
                                Você deseja aprovar ou arquivar esta denúncia
                                <label id="nomeDoEstabelecimento" style="font-weight:bold; font-family: 'Roboto', sans-serif;"></label>?
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <form method="POST" action="{{route('denuncias.avaliar')}}">
                            @csrf
                            <input type="hidden" name="denunciaId" id="denunciaId" value="{{$denuncia->id}}">
                            <input type="hidden" name="aprovar" id="inputAprovar" value="">
                            <div class="form-row">
                                <div class="col-md-6 form-group" style="padding-right: 20px">
                                    <button type="submit" class="btn btn-success botao-form" style="width:100%" onclick="atualizarInputAprovar()">Aprovar</button>
                                </div>
                                <div class="col-md-6 form-group">
                                    <button type="submit" class="btn btn-danger botao-form" style="width:100px;" onclick="atualizarInputReprovar()">Arquivar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <div class="modal fade" id="modal-agendar-visita" tabindex="-1" role="dialog" aria-labelledby="modal-imagens" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agendar visita para a denúcia</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form id="form-criar-visita-denuncia" method="POST" action="{{route('denuncias.visita.create')}}">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-12 form-group">
                                <label for="data">{{__('Data da visita')}}</label>
                                <input type="date" name="data" id="data" class="form-control @error('data') is-invalid @enderror" value="{{old('data')}}">

                                @error('data')
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 form-group">
                                 <input type="hidden" name="denuncia_id" id="denuncia_id" value="">
                                <label for="analista">{{__('Selecione o analista da visita')}}</label>
                                <select name="analista" id="analista" class="form-control @error('analista') is-invalid @enderror">
                                    <option value="" selected disabled>-- {{__('Selecione o analista da visita')}} --</option>
                                    @foreach ($analistas as $analista)
                                        <option @if(old('analista') == $analista->id) selected @endif value="{{$analista->id}}">{{$analista->name}}</option>
                                    @endforeach
                                </select>

                                @error('analista')
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Cancelar</button>
                    <button type="submit" class="btn btn-success" form="form-criar-visita-denuncia">Criar</button>
                </div>
            </div>
        </div>
    </div>
    @can('isSecretario', \App\Models\User::class)
        <div class="modal fade" id="modal-atribuir" tabindex="-1" role="dialog" aria-labelledby="modal-imagens" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Atribuir denúcia a um analista</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form id="form-atribuir-analista-denuncia" method="POST" action="{{route('denuncias.atribuir.analista')}}">
                            @csrf
                            <div class="form-row">
                                <div class="col-md-12 form-group">
                                    <input type="hidden" name="denuncia_id_analista" id="denuncia_id_analista" value="">
                                    <label for="analista">{{__('Selecione o analista')}}</label>
                                    <select name="analista" id="analista" class="form-control @error('analista') is-invalid @enderror">
                                        <option value="" selected disabled>-- {{__('Selecione o analista')}} --</option>
                                        @foreach ($analistas as $analista)
                                            <option @if(old('analista') == $analista->id) selected @endif value="{{$analista->id}}">{{$analista->name}}</option>
                                        @endforeach
                                    </select>

                                    @error('analista')
                                        <div id="validationServer03Feedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Cancelar</button>
                        <button type="submit" id="submeterFormBotao" class="btn btn-success" form="form-atribuir-analista-denuncia">Criar</button>
                    </div>
                </div>
            </div>
        </div>
    @endcan
    @if (old('denuncia_id') != null)
        <script>
            $(document).ready(function() {
                $('#link-denuncias-aprovados').click();
                $("#btn-criar-visita-{{old('denuncia_id')}}").click();
            });
        </script>
    @endif
    <script>
        function adicionarId(id) {
            document.getElementById('denuncia_id').value = id;
        }

        function adicionarIdAtribuir(id) {
            document.getElementById('denuncia_id_analista').value = id;
        }

        function atualizarInputAprovar(){
            document.getElementById('inputAprovar').value = true;
        }

        function atualizarInputReprovar(){
            document.getElementById('inputAprovar').value = false;
        }
    </script>
</x-app-layout>
