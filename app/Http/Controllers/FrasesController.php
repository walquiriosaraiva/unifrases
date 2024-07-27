<?php

namespace App\Http\Controllers;

use App\Model\Frases;
use App\Model\Idiomas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FrasesController extends Controller
{
    private $frases;
    private $idiomas;

    public function __construct(Frases $frases, Idiomas $idiomas)
    {
        $this->middleware('auth');
        $this->frases = $frases;
        $this->idiomas = $idiomas;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
        $idiomas = $this->idiomas->orderByRaw('nome')->orderBy('nome', 'ASC')->get();

        $frases = $this->frases
            ->join('idioma', 'idioma.id', '=', 'frase.idioma')
            ->select(
                'frase.id',
                'frase.idioma as ididioma',
                'frase.texto',
                'frase.status',
                'frase.codigo',
                'idioma.nome as idioma')
            ->orderByRaw('frase.codigo')->paginate(10);
        $count = $frases->count();

        return view('frases.show', compact('frases', 'count', 'idiomas'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|View
     */
    public function pesquisa(Request $request)
    {
        //debugDie($request->get('codigo'), $request->get('idioma'), $request->get('texto'));
        $idiomas = $this->idiomas->orderByRaw('nome')->orderBy('nome', 'ASC')->get();

        $frases = $this->frases
            ->join('idioma', 'idioma.id', '=', 'frase.idioma')
            ->select(
                'frase.id',
                'frase.idioma as ididioma',
                'frase.texto',
                'frase.status',
                'frase.codigo',
                'idioma.nome as idioma');
        if ($request->get('codigo')):
            $frases->where('frase.codigo', '=', $request->get('codigo'));
        endif;

        if ($request->get('texto')):
            $frases->where('frase.texto', 'ilike', '%' . $request->get('texto') . '%');
        endif;

        if ($request->get('idioma')):
            $frases->where('idioma.id', '=', $request->get('idioma'));
        endif;

        $frases = $frases->orderByRaw('frase.codigo')->paginate(10);
        $count = $frases->count();
        $inputs = $request->all();

        return view('frases.show', compact('frases', 'count', 'idiomas', 'inputs'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $idiomas = $this->idiomas->get();
        return view('frases.create', compact('idiomas'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $extension = $request->file('planilha')->getClientOriginalExtension();

        if ($extension !== 'xls'):
            return redirect()->route('frases.create')
                ->withErrors(false)
                ->withInput();
        endif;

        if ($request->file('planilha')) :
            $extension = $request->file('planilha')->getClientOriginalExtension();
            $dir = 'uploads/';
            $filename = 'unifrases.' . $extension;
            $request->file('planilha')->move($dir, $filename);

            return redirect()->route('frases.show')
                ->withInput()
                ->with(['planilha' => true, 'frase' => 'planilha foi importada com sucesso, clique no botão processar planilha.']);
        else:
            $validador = Validator::make($request->all(), [
                'nome' => 'required'
            ]);

            if ($validador->fails()):
                return redirect()->route('frases.create')
                    ->withErrors($validador)
                    ->withInput();
            else:
                $result = Frases::create([
                    'imagem' => $request->input('imagem'),
                    'nome' => $request->input('nome'),
                    'encoding' => $request->input('encoding'),
                    'collateaux' => $request->input('collateaux'),
                    'status' => $request->input('status') ? $request->input('status') : 'A'
                ]);

                if ($result):
                    return redirect()->route('frases.show')
                        ->withInput()
                        ->with(['inser' => true, 'idioma' => $request->input('nc')]);
                endif;
            endif;
        endif;

        return redirect()->route('frases.show')
            ->withInput()
            ->with(['success' => true, 'frase' => 'inserir o frase']);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \PHPExcel_Exception
     * @throws \PHPExcel_Reader_Exception
     */
    public function processa(Request $request)
    {
        $filename = 'uploads/unifrases.xls';
        $excelReader = \PHPExcel_IOFactory::createReaderForFile($filename);
        $excelReader->setReadDataOnly();
        $excelReader->setLoadAllSheets();
        $excelObj = $excelReader->load($filename);
        $excelObj->getActiveSheet()->toArray(null, true, true, true);
        $worksheetNames = $excelObj->getSheetNames($filename);
        $insert = array();

        DB::insert('delete from frase where id > 0');
        foreach ($worksheetNames as $key => $sheetName):
            $excelObj->setActiveSheetIndexByName($sheetName);
            $abas = $excelObj->getActiveSheet()->toArray(null, true, true, true);
            foreach ($abas as $abaskey => $value):
                foreach ($value as $abakey => $aba):
                    if ($abakey == 'A' and $aba != ''):
                        $codigo = str_replace(array('/', '.', ' '), '', $aba);
                    endif;

                    if ($abakey == 'B' and $aba != '' && trim($aba) != 'INGLES'):
                        $aba = str_replace("'", "''", $aba);
                        $insert[] = "insert into frase (idioma, codigo, status, texto) values (3, '{$codigo}', 'A', '{$aba}');";
                    endif;

                    if ($abakey == 'C' and $aba != '' && trim($aba) != 'ESPANHOL'):
                        $aba = str_replace("'", "''", $aba);
                        $insert[] = "insert into frase (idioma, codigo, status, texto) values (4, '{$codigo}', 'A', '{$aba}');";
                    endif;

                    if ($abakey == 'D' and $aba != '' && trim($aba) != 'PORTUGUES'):
                        $aba = str_replace("'", "''", $aba);
                        $insert[] = "insert into frase (idioma, codigo, status, texto) values (2, '{$codigo}', 'A', '{$aba}');";
                    endif;

                    if ($abakey == 'E' and $aba != '' && trim($aba) != 'FRANCES'):
                        $aba = str_replace("'", "''", $aba);
                        $insert[] = "insert into frase (idioma, codigo, status, texto) values (6, '{$codigo}', 'A', '{$aba}');";
                    endif;

                    if ($abakey == 'F' and $aba != '' && trim($aba) != 'ITALIANO'):
                        $aba = str_replace("'", "''", $aba);
                        $insert[] = "insert into frase (idioma, codigo, status, texto) values (5, '{$codigo}', 'A', '{$aba}');";
                    endif;

                    if ($abakey == 'G' and $aba != '' && trim($aba) != 'RUSSO'):
                        $aba = str_replace("'", "''", $aba);
                        $insert[] = "insert into frase (idioma, codigo, status, texto) values (1, '{$codigo}', 'A', '{$aba}');";
                    endif;

                    if ($abakey == 'H' and $aba != '' && trim($aba) != 'CHINES'):
                        $aba = str_replace("'", "''", $aba);
                        $insert[] = "insert into frase (idioma, codigo, status, texto) values (9, '{$codigo}', 'A', '{$aba}');";
                    endif;

                    if ($abakey == 'I' and $aba != '' && trim($aba) != 'JAPONES'):
                        $aba = str_replace("'", "''", $aba);
                        $insert[] = "insert into frase (idioma, codigo, status, texto) values (10, '{$codigo}', 'A', '{$aba}');";
                    endif;

                    if ($abakey == 'J' and $aba != '' && trim($aba) != 'ALEMAO'):
                        $aba = str_replace("'", "''", $aba);
                        $insert[] = "insert into frase (idioma, codigo, status, texto) values (7, '{$codigo}', 'A', '{$aba}');";
                    endif;

                    if ($abakey == 'K' and $aba != '' && trim($aba) != 'ARABE'):
                        $aba = str_replace("'", "''", $aba);
                        $insert[] = "insert into frase (idioma, codigo, status, texto) values (74, '{$codigo}', 'A', '{$aba}');";
                    endif;

                    if ($abakey == 'L' and $aba != '' && trim($aba) != 'AFRIKAANS'):
                        $aba = str_replace("'", "''", $aba);
                        $insert[] = "insert into frase (idioma, codigo, status, texto) values (75, '{$codigo}', 'A', '{$aba}');";
                    endif;

                    if ($abakey == 'N' and $aba != '' && trim($aba) != 'INDIANO'):
                        $aba = str_replace("'", "''", $aba);
                        $insert[] = "insert into frase (idioma, codigo, status, texto) values (76, '{$codigo}', 'A', '{$aba}');";
                    endif;

                    if ($abakey == 'O' and $aba != '' && trim($aba) != 'MANDARIN'):
                        $aba = str_replace("'", "''", $aba);
                        $insert[] = "insert into frase (idioma, codigo, status, texto) values (11, '{$codigo}', 'A', '{$aba}');";
                    endif;

                    if ($abakey == 'P' and $aba != '' && trim($aba) != 'INDONESIO'):
                        $aba = str_replace("'", "''", $aba);
                        $insert[] = "insert into frase (idioma, codigo, status, texto) values (15, '{$codigo}', 'A', '{$aba}');";
                    endif;

                    if ($abakey == 'Q' and $aba != '' && trim($aba) != 'TURCO'):
                        $aba = str_replace("'", "''", $aba);
                        $insert[] = "insert into frase (idioma, codigo, status, texto) values (14, '{$codigo}', 'A', '{$aba}');";
                    endif;

                    if ($abakey == 'R' and $aba != '' && trim($aba) != 'COREANO'):
                        $aba = str_replace("'", "''", $aba);
                        $insert[] = "insert into frase (idioma, codigo, status, texto) values (13, '{$codigo}', 'A', '{$aba}');";
                    endif;

                    if ($abakey == 'S' and $aba != '' && trim($aba) != 'TAILANDES'):
                        $aba = str_replace("'", "''", $aba);
                        $insert[] = "insert into frase (idioma, codigo, status, texto) values (12, '{$codigo}', 'A', '{$aba}');";
                    endif;

                    if ($abakey == 'T' and $aba != '' && trim($aba) != 'POLONES'):
                        $aba = str_replace("'", "''", $aba);
                        $insert[] = "insert into frase (idioma, codigo, status, texto) values (16, '{$codigo}', 'A', '{$aba}');";
                    endif;

                    if ($abakey == 'U' and $aba != '' && trim($aba) != 'DINAMARQUES'):
                        $aba = str_replace("'", "''", $aba);
                        $insert[] = "insert into frase (idioma, codigo, status, texto) values (17, '{$codigo}', 'A', '{$aba}');";
                    endif;

                    if ($abakey == 'V' and $aba != '' && trim($aba) != 'FINLANDES'):
                        $aba = str_replace("'", "''", $aba);
                        $insert[] = "insert into frase (idioma, codigo, status, texto) values (18, '{$codigo}', 'A', '{$aba}');";
                    endif;

                    if ($abakey == 'W' and $aba != '' && trim($aba) != 'TCHECO'):
                        $aba = str_replace("'", "''", $aba);
                        $insert[] = "insert into frase (idioma, codigo, status, texto) values (19, '{$codigo}', 'A', '{$aba}');";
                    endif;

                    if ($abakey == 'X' and $aba != '' && trim($aba) != 'UKRANIANO'):
                        $aba = str_replace("'", "''", $aba);
                        $insert[] = "insert into frase (idioma, codigo, status, texto) values (20, '{$codigo}', 'A', '{$aba}');";
                    endif;

                    if ($abakey == 'Y' and $aba != '' && trim($aba) != 'SUECO'):
                        $aba = str_replace("'", "''", $aba);
                        $insert[] = "insert into frase (idioma, codigo, status, texto) values (8, '{$codigo}', 'A', '{$aba}');";
                    endif;

                    if ($abakey == 'Z' and $aba != '' && trim($aba) != 'MALAIO'):
                        $aba = str_replace("'", "''", $aba);
                        $insert[] = "insert into frase (idioma, codigo, status, texto) values (77, '{$codigo}', 'A', '{$aba}');";
                    endif;

                    if ($abakey == 'AA' and $aba != '' && trim($aba) != 'HOLANDES'):
                        $aba = str_replace("'", "''", $aba);
                        $insert[] = "insert into frase (idioma, codigo, status, texto) values (22, '{$codigo}', 'A', '{$aba}');";
                    endif;

                    if ($abakey == 'AB' and $aba != '' && trim($aba) != 'NORUEGUES'):
                        $aba = str_replace("'", "''", $aba);
                        $insert[] = "insert into frase (idioma, codigo, status, texto) values (23, '{$codigo}', 'A', '{$aba}');";
                    endif;

                    if ($abakey == 'AC' and $aba != '' && trim($aba) != 'GREGO'):
                        $aba = str_replace("'", "''", $aba);
                        $insert[] = "insert into frase (idioma, codigo, status, texto) values (24, '{$codigo}', 'A', '{$aba}');";
                    endif;

                    if ($abakey == 'AD' and $aba != '' && trim($aba) != 'HEBRAICO'):
                        $aba = str_replace("'", "''", $aba);
                        $insert[] = "insert into frase (idioma, codigo, status, texto) values (25, '{$codigo}', 'A', '{$aba}');";
                    endif;

                    if ($abakey == 'AE' and $aba != '' && trim($aba) != 'FILIPINO'):
                        $aba = str_replace("'", "''", $aba);
                        $insert[] = "insert into frase (idioma, codigo, status, texto) values (29, '{$codigo}', 'A', '{$aba}');";
                    endif;

                    if ($abakey == 'AF' and $aba != '' && trim($aba) != 'VIETNAMITA'):
                        $aba = str_replace("'", "''", $aba);
                        $insert[] = "insert into frase (idioma, codigo, status, texto) values (26, '{$codigo}', 'A', '{$aba}');";
                    endif;

                    if ($abakey == 'AG' and $aba != '' && trim($aba) != 'HUNGARO'):
                        $aba = str_replace("'", "''", $aba);
                        $insert[] = "insert into frase (idioma, codigo, status, texto) values (27, '{$codigo}', 'A', '{$aba}');";
                    endif;

                    if ($abakey == 'AH' and $aba != '' && trim($aba) != 'ROMENO'):
                        $aba = str_replace("'", "''", $aba);
                        $insert[] = "insert into frase (idioma, codigo, status, texto) values (28, '{$codigo}', 'A', '{$aba}');";
                    endif;

                    if ($abakey == 'AI' and $aba != '' && trim($aba) != 'ESLOVACO'):
                        $aba = str_replace("'", "''", $aba);
                        $insert[] = "insert into frase (idioma, codigo, status, texto) values (30, '{$codigo}', 'A', '{$aba}');";
                    endif;

                    if ($abakey == 'AJ' and $aba != '' && trim($aba) != 'ESLOVENO'):
                        $aba = str_replace("'", "''", $aba);
                        $insert[] = "insert into frase (idioma, codigo, status, texto) values (78, '{$codigo}', 'A', '{$aba}');";
                    endif;

                    if ($abakey == 'AK' and $aba != '' && trim($aba) != 'POMERANO'):
                        $aba = str_replace("'", "''", $aba);
                        $insert[] = "insert into frase (idioma, codigo, status, texto) values (52, '{$codigo}', 'A', '{$aba}');";
                    endif;

                    if ($abakey == 'AM' and $aba != '' && trim($aba) != 'ESPERANTO'):
                        $aba = str_replace("'", "''", $aba);
                        $insert[] = "insert into frase (idioma, codigo, status, texto) values (54, '{$codigo}', 'A', '{$aba}');";
                    endif;

                    if ($abakey == 'AN' and $aba != '' && trim($aba) != 'PERSA'):
                        $aba = str_replace("'", "''", $aba);
                        $insert[] = "insert into frase (idioma, codigo, status, texto) values (56, '{$codigo}', 'A', '{$aba}');";
                    endif;

                    if ($abakey == 'AO' and $aba != '' && trim($aba) != 'TUPI'):
                        $aba = str_replace("'", "''", $aba);
                        $insert[] = "insert into frase (idioma, codigo, status, texto) values (57, '{$codigo}', 'A', '{$aba}');";
                    endif;

                    if ($abakey == 'AR' and $aba != '' && trim($aba) != 'ZAPARA'):
                        $aba = str_replace("'", "''", $aba);
                        $insert[] = "insert into frase (idioma, codigo, status, texto) values (60, '{$codigo}', 'A', '{$aba}');";
                    endif;

                    if ($abakey == 'AS' and $aba != '' && trim($aba) != 'QUICHUA'):
                        $aba = str_replace("'", "''", $aba);
                        $insert[] = "insert into frase (idioma, codigo, status, texto) values (61, '{$codigo}', 'A', '{$aba}');";
                    endif;

                    if ($abakey == 'AT' and $aba != '' && trim($aba) != 'SHUAR'):
                        $aba = str_replace("'", "''", $aba);
                        $insert[] = "insert into frase (idioma, codigo, status, texto) values (62, '{$codigo}', 'A', '{$aba}');";
                    endif;

                    if ($abakey == 'AU' and $aba != '' && trim($aba) != 'SILETZ-DEE-NI'):
                        $aba = str_replace("'", "''", $aba);
                        $insert[] = "insert into frase (idioma, codigo, status, texto) values (63, '{$codigo}', 'A', '{$aba}');";
                    endif;

                    if ($abakey == 'AV' and $aba != '' && trim($aba) != 'MATUKAR-PANAU'):
                        $aba = str_replace("'", "''", $aba);
                        $insert[] = "insert into frase (idioma, codigo, status, texto) values (64, '{$codigo}', 'A', '{$aba}');";
                    endif;

                    if ($abakey == 'AW' and $aba != '' && trim($aba) != 'REMO'):
                        $aba = str_replace("'", "''", $aba);
                        $insert[] = "insert into frase (idioma, codigo, status, texto) values (65, '{$codigo}', 'A', '{$aba}');";
                    endif;

                    if ($abakey == 'AX' and $aba != '' && trim($aba) != 'BANIWA'):
                        $aba = str_replace("'", "''", $aba);
                        $insert[] = "insert into frase (idioma, codigo, status, texto) values (66, '{$codigo}', 'A', '{$aba}');";
                    endif;

                    if ($abakey == 'AY' and $aba != '' && trim($aba) != 'SORA'):
                        $aba = str_replace("'", "''", $aba);
                        $insert[] = "insert into frase (idioma, codigo, status, texto) values (67, '{$codigo}', 'A', '{$aba}');";
                    endif;

                    if ($abakey == 'AZ' and $aba != '' && trim($aba) != 'HO'):
                        $aba = str_replace("'", "''", $aba);
                        $insert[] = "insert into frase (idioma, codigo, status, texto) values (68, '{$codigo}', 'A', '{$aba}');";
                    endif;

                    if ($abakey == 'BA' and $aba != '' && trim($aba) != 'TALIAN'):
                        $aba = str_replace("'", "''", $aba);
                        $insert[] = "insert into frase (idioma, codigo, status, texto) values (69, '{$codigo}', 'A', '{$aba}');";
                    endif;

                    if ($abakey == 'BB' and $aba != '' && trim($aba) != 'HUNRUCKISCH'):
                        $aba = str_replace("'", "''", $aba);
                        $insert[] = "insert into frase (idioma, codigo, status, texto) values (70, '{$codigo}', 'A', '{$aba}');";
                    endif;

                    if ($abakey == 'BC' and $aba != '' && trim($aba) != 'TUVAN'):
                        $aba = str_replace("'", "''", $aba);
                        $insert[] = "insert into frase (idioma, codigo, status, texto) values (71, '{$codigo}', 'A', '{$aba}');";
                    endif;

                    if ($abakey == 'BG' and $aba != '' && trim($aba) != 'NHEENGATU'):
                        $aba = str_replace("'", "''", $aba);
                        $insert[] = "insert into frase (idioma, codigo, status, texto) values (73, '{$codigo}', 'A', '{$aba}');";
                    endif;

                    if ($abakey == 'BH' and $aba != '' && trim($aba) != 'LATIN'):
                        $aba = str_replace("'", "''", $aba);
                        $insert[] = "insert into frase (idioma, codigo, status, texto) values (72, '{$codigo}', 'A', '{$aba}');";
                    endif;

                    if ($abakey == 'BK' and $aba != '' && trim($aba) != 'YANOMAMI'):
                        $aba = str_replace("'", "''", $aba);
                        $insert[] = "insert into frase (idioma, codigo, status, texto) values (53, '{$codigo}', 'A', '{$aba}');";
                    endif;

                    if ($abakey == 'BL' and $aba != '' && trim($aba) != 'CHAMACOCO'):
                        $aba = str_replace("'", "''", $aba);
                        $insert[] = "insert into frase (idioma, codigo, status, texto) values (58, '{$codigo}', 'A', '{$aba}');";
                    endif;

                    if ($abakey == 'BM' and $aba != '' && trim($aba) != 'SANSCRITO'):
                        $aba = str_replace("'", "''", $aba);
                        $insert[] = "insert into frase (idioma, codigo, status, texto) values (55, '{$codigo}', 'A', '{$aba}');";
                    endif;

                    if ($abakey == 'BN' and $aba != '' && trim($aba) != 'ANDOA-EQUATORIANO'):
                        $aba = str_replace("'", "''", $aba);
                        $insert[] = "insert into frase (idioma, codigo, status, texto) values (59, '{$codigo}', 'A', '{$aba}');";
                    endif;
                    /*


                    if ($abakey == 'M' and $aba != '' && trim($aba) != 'TUPI-GUARANI'):
                        $aba = str_replace("'", "''", $aba);
                        $insert[] = "insert into frase (idioma, codigo, status, texto) values (2, '{$codigo}', 'A', '{$aba}');";
                    endif;

                    if ($abakey == 'AL' and $aba != '' && trim($aba) != 'GALEGO'):
                        $aba = str_replace("'", "''", $aba);
                        $insert[] = "insert into frase (idioma, codigo, status, texto) values (2, '{$codigo}', 'A', '{$aba}');";
                    endif;

                    if ($abakey == 'AP' and $aba != '' && trim($aba) != 'ESTONIANO'):
                        $aba = str_replace("'", "''", $aba);
                        $insert[] = "insert into frase (idioma, codigo, status, texto) values (2, '{$codigo}', 'A', '{$aba}');";
                    endif;

                    if ($abakey == 'AQ' and $aba != '' && trim($aba) != 'CRIOULO-DE-CABO-VERDE'):
                        $aba = str_replace("'", "''", $aba);
                        $insert[] = "insert into frase (idioma, codigo, status, texto) values (2, '{$codigo}', 'A', '{$aba}');";
                    endif;

                    if ($abakey == 'BD' and $aba != '' && trim($aba) != 'IRLANDES'):
                        $aba = str_replace("'", "''", $aba);
                        $insert[] = "insert into frase (idioma, codigo, status, texto) values (2, '{$codigo}', 'A', '{$aba}');";
                    endif;

                    if ($abakey == 'BE' and $aba != '' && trim($aba) != 'ISLANDES'):
                        $aba = str_replace("'", "''", $aba);
                        $insert[] = "insert into frase (idioma, codigo, status, texto) values (2, '{$codigo}', 'A', '{$aba}');";
                    endif;

                    if ($abakey == 'BF' and $aba != '' && trim($aba) != 'MACEDONIO'):
                        $aba = str_replace("'", "''", $aba);
                        $insert[] = "insert into frase (idioma, codigo, status, texto) values (2, '{$codigo}', 'A', '{$aba}');";
                    endif;

                    if ($abakey == 'BI' and $aba != '' && trim($aba) != 'XHOSA'):
                        $aba = str_replace("'", "''", $aba);
                        $insert[] = "insert into frase (idioma, codigo, status, texto) values (2, '{$codigo}', 'A', '{$aba}');";
                    endif;

                    if ($abakey == 'BJ' and $aba != '' && trim($aba) != 'ZULU'):
                        $aba = str_replace("'", "''", $aba);
                        $insert[] = "insert into frase (idioma, codigo, status, texto) values (2, '{$codigo}', 'A', '{$aba}');";
                    endif;

                    if ($abakey == 'BO' and $aba != '' && trim($aba) != 'ANGUNES'):
                        $aba = str_replace("'", "''", $aba);
                        $insert[] = "insert into frase (idioma, codigo, status, texto) values (2, '{$codigo}', 'A', '{$aba}');";
                    endif;

                    if ($abakey == 'BP' and $aba != '' && trim($aba) != 'BANTAS'):
                        $aba = str_replace("'", "''", $aba);
                        $insert[] = "insert into frase (idioma, codigo, status, texto) values (2, '{$codigo}', 'A', '{$aba}');";
                    endif;

                    if ($abakey == 'BQ' and $aba != '' && trim($aba) != 'CRIOULO-DA-GUINE-BISSAU'):
                        $aba = str_replace("'", "''", $aba);
                        $insert[] = "insert into frase (idioma, codigo, status, texto) values (2, '{$codigo}', 'A', '{$aba}');";
                    endif;
                    */
                endforeach;
            endforeach;
            //debugDie($insert);
        endforeach;
        foreach ($insert as $valores):
            $frases = DB::insert($valores);
        endforeach;

        if ($frases):
            unlink($filename);
        endif;

        return response()->json($frases ? $frases : null);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function edit($id)
    {
        $idiomas = $this->idiomas->get();
        $frase = $this->frases->where('id', '=', $id)->get()->first();
        $frases = $this->frases->where('codigo', '=', $frase->codigo)->get();

        if (empty($frases)) :
            return "Aconteceu um erro";
        endif;

        return view('frases.edit', compact('frases', 'frase', 'idiomas'));
    }

    /**
     * @param $codigo
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function editar($codigo)
    {
        $idiomas = $this->idiomas->get();
        //$frases = $this->frases->where('codigo', '=', $codigo)->get();
        $frases = $this->frases->where('codigo', '=', $codigo)
            ->join('idioma', 'idioma.id', '=', 'frase.idioma')
            ->select(
                'frase.id',
                'frase.idioma as ididioma',
                'frase.texto',
                'frase.status',
                'frase.codigo',
                'idioma.id',
                'idioma.nome',
                'idioma.nome as idioma')
            ->orderByRaw('frase.codigo')->limit(100)->get();

        $frase = $frases->first();

        if (empty($frases)) :
            return "Aconteceu um erro";
        endif;

        return view('frases.edit', compact('frases', 'frase', 'idiomas'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $frases = $this->frases->find($request->input('id'));
        debugDie($frases);
        $validador = Validator::make($request->all(), [
            'nome' => 'required'
        ]);

        if ($validador->fails()):
            return redirect()->to($this->getRedirectUrl())
                ->withErrors($validador)
                ->withInput($request->all());
        else:

            $frases->imagem = $request->input('imagem');
            $frases->nome = $request->input('nome');
            $frases->encoding = $request->input('encoding');
            $frases->collateaux = $request->input('collateaux');
            $frases->status = 'A';

            if ($frases->save()):
                return redirect()->route('frases.show')
                    ->withInput()
                    ->with(['update' => true, 'idioma' => $frases->nome]);
            endif;
        endif;

        return redirect()->route('frases.show')
            ->withInput()
            ->with(['error' => true, 'idioma' => 'Erro ao atualizar a frase']);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $frase = $this->frases->find($id);
        $frase->status = 'I';

        if ($frase->save()) :
            return redirect()->route('frases.show')
                ->withInput()
                ->with(['delete' => true, 'idioma' => $frase->texto]);
        endif;

        return redirect()->route('frases.show')
            ->withInput()
            ->with(['error' => true, 'idioma' => 'Erro ao excluir a frase']);
    }
}
