<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Documento') }}
        </h2>
    </x-slot>
    <div class="container" style="padding-top: 5rem; padding-bottom: 8rem;">
        <div class="form-row justify-content-center">
            <div class="col-md-10">
                <div class="card" style="width: 100%;">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col-md-8">
                                <h5 class="card-title">Editar documento</h5>
                                <h6 class="card-subtitle mb-2 text-muted">Documentos > Editar documento</h6>
                            </div>
                        </div>
                        <form method="POST" id="cria-documento" action="{{route('documentos.update', $documento->id)}}" enctype="multipart/form-data">
                            @csrf
                            @method("PUT")
                            <div class="form-row">
                                <div class="col-md-6 form-group">
                                    <label for="nome">{{ __('Nome') }}</label>
                                    <input id="nome" class="form-control apenas_letras @error('nome') is-invalid @enderror" type="text" name="nome" 
                                        value="{{ $documento->nome }}" required autofocus autocomplete="nome">
                                
                                    @error('nome')
                                        <div id="validationServer03Feedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="documento_modelo">{{ __('Modelo do documento') }}</label>
                                    <input id="documento_modelo" class="form-control @error('documento_modelo') is-invalid @enderror" type="file" accept=".pdf" 
                                        name="documento_modelo" value="{{old('documento_modelo')}}" required autofocus autocomplete="documento_modelo">
                                
                                    @error('documento_modelo')
                                        <div id="validationServer03Feedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <div class="form-row">
                            <div class="col-md-6"></div>
                            <div class="col-md-6" style="text-align: right">
                                <button type="submit" class="btn btn-success" form="cria-documento" style="width: 100%">Salvar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
    $("#documento_modelo").change(function(){
        if(this.files[0].size > 2097152){
            alert("O arquivo deve ter no máximo 2MB!");
            this.value = "";
        };
    });
</script>
</x-app-layout>