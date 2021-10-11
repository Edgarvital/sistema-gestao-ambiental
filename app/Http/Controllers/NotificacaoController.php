<?php

namespace App\Http\Controllers;

use App\Http\Requests\NotificacaoRequest;
use App\Models\Empresa;
use App\Models\FotoNotificacao;
use App\Models\Notificacao;
use App\Notifications\NotificacaoCriadaNotification;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

class NotificacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Empresa $empresa
     *
     * @return View
     */
    public function index(Empresa $empresa)
    {
        return view('notificacao.index', ['empresa' => $empresa]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Empresa $empresa
     *
     * @return View
     */
    public function create(Empresa $empresa)
    {
        return view('notificacao.create')->with('empresa', $empresa);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param NotificacaoRequest $request
     * @param Empresa $empresa
     *
     * @return View
     */
    public function store(NotificacaoRequest $request, Empresa $empresa)
    {
        $notificacao = new Notificacao();
        $data = $request->validated();
        $notificacao->fill($data);
        $notificacao->empresa_id = $empresa->id;
        $notificacao->save();
        if (array_key_exists("imagem", $data))
        {
            for ($i = 0; $i < count($data['imagem']); $i++) {
                $foto_notificacao = new FotoNotificacao();
                $foto_notificacao->notificacao_id = $notificacao->id;
                $foto_notificacao->comentario = $data['comentario'][$i] ?? "";

                $nomeImg = $data['imagem'][$i]->getClientOriginalName();
                $path = 'notificacoes/' . $notificacao->id . '/';
                Storage::putFileAs('public/' . $path, $data['imagem'][$i], $nomeImg);
                $foto_notificacao->caminho = $path . $nomeImg;
                $foto_notificacao->save();
            }
        }
        Notification::send($empresa->user, new NotificacaoCriadaNotification($notificacao, $empresa));
        return view('notificacao.index', ['empresa' => $empresa])->with('success', 'Notificação criada com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param Notificacao $notificacao
     * @return View
     */
    public function show(Notificacao $notificacao)
    {
        return view('notificacao.show', ['notificacao' => $notificacao]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Notificacao $notificacao
     * @return \Illuminate\Http\Response
     */
    public function edit(Notificacao $notificacao)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param NotificacaoRequest $request
     * @param Notificacao $notificacao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notificacao $notificacao)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Notificacao $notificacao
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notificacao $notificacao)
    {
        //
    }
}
