<?php

namespace App\Http\Controllers;

use App\Model\Idiomas;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class IdiomasController extends Controller
{
    private $idiomas;

    public function __construct(Idiomas $idiomas)
    {
        $this->middleware('auth');
        $this->idiomas = $idiomas;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
        $idiomas = $this->idiomas->orderByRaw('idioma.nome')->paginate(10);
        $count = $idiomas->count();

        return view('idiomas.show', compact('idiomas', 'count'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|View
     */
    public function pesquisa(Request $request)
    {
        $idiomas = $this->idiomas->where('nome', 'ilike', '%' . $request->input('idioma') . '%')->orderByRaw('idioma.nome')->paginate(10);
        $count = $idiomas->count();
        $inputs = $request->all();
        return view('idiomas.show', compact('idiomas', 'count', 'inputs'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('idiomas.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validador = Validator::make($request->all(), [
            'nome' => 'required'
        ]);

        if ($validador->fails()):
            return redirect()->route('idiomas.create')
                ->withErrors($validador)
                ->withInput();
        else:
            $result = Idiomas::create([
                'imagem' => $request->input('imagem'),
                'nome' => $request->input('nome'),
                'encoding' => $request->input('encoding'),
                'collateaux' => $request->input('collateaux'),
                'status' => $request->input('status') ? $request->input('status') : 'A'
            ]);

            if ($result):
                return redirect()->route('idiomas.show')
                    ->withInput()
                    ->with(['inser' => true, 'idioma' => $request->input('nc')]);
            endif;
        endif;

        return redirect()->route('idiomas.show')
            ->withInput()
            ->with(['error' => true, 'idioma' => 'Erro ao inserir o idioma']);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function edit($id)
    {
        $idioma = $this->idiomas->find($id);

        if (empty($idioma)) :
            return "Aconteceu um erro";
        endif;

        return view('idiomas.edit', compact('idioma'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $idioma = $this->idiomas->find($request->input('id'));

        $validador = Validator::make($request->all(), [
            'nome' => 'required'
        ]);

        if ($validador->fails()):
            return redirect()->to($this->getRedirectUrl())
                ->withErrors($validador)
                ->withInput($request->all());
        else:

            DB::beginTransaction();
            try {
            $idioma->imagem = $request->input('imagem');
            $idioma->nome = $request->input('nome');
            $idioma->encoding = $request->input('encoding');
            $idioma->collateaux = $request->input('collateaux');
            $idioma->status = 'A';

            if ($idioma->save()):
                DB::commit();
                return redirect()->route('idiomas.show')
                    ->withInput()
                    ->with(['update' => true, 'idioma' => $idioma->nome]);
            endif;
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->route('idiomas.show')
                    ->withInput()
                    ->with(['error' => true, 'idioma' => $e->getMessage()]);
            }
        endif;

        return redirect()->route('idiomas.show')
            ->withInput()
            ->with(['error' => true, 'idioma' => 'Erro ao atualizar o idioma']);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $idioma = $this->idiomas->find($id);
        $idioma->status = 'I';

        if ($idioma->save()) :
            return redirect()->route('idiomas.show')
                ->withInput()
                ->with(['delete' => true, 'idioma' => $idioma->nome]);
        endif;

        return redirect()->route('idiomas.show')
            ->withInput()
            ->with(['error' => true, 'idioma' => 'Erro ao excluir o idioma']);
    }
}
