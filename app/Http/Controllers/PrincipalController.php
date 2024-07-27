<?php

namespace App\Http\Controllers;

use App\Mail\SendMailUser;
use App\Model\ChatMessage;
use App\Model\ChatUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class PrincipalController extends Controller
{

    private $chat_users;
    private $chat_messages;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ChatUser $chat_users, ChatMessage $chat_messages)
    {
        $this->chat_users = $chat_users;
        $this->chat_messages = $chat_messages;
    }

    public function get(Request $request)
    {
        $idiomas = DB::table('frase')->orderBy('id')->paginate(20);
        return response()->json($idiomas);
        //return view('teste', array('idiomas' => $idiomas));
    }

    public function post()
    {
        $idiomas = DB::table('idioma')->orderBy('id')->paginate(20);
        return response()->json($idiomas);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        return view('principal');
    }

    public function apresentacao()
    {
        return view('apresentacao');
    }

    public function instrucao()
    {
        return view('instrucao');
    }

    public function contato()
    {
        return view('contato');
    }

    public function libratos()
    {
        return view('libratos');
    }

    public function libror()
    {
        return view('libror');
    }

    public function unifrazinho()
    {
        return view('unifrazinho');
    }

    public function biblioteca()
    {
        return view('biblioteca');
    }

    public function links()
    {
        return view('links');
    }

    public function store(Request $request)
    {
        debugDie($request->all());
    }

    public function home()
    {
        $idiomas = DB::table('idioma')->where('status', '=', 'A')->orderBy('nome')->get();        
        $session = session('chat_users');

        return view('principal', compact('idiomas', 'session'));
    }

    public function fetch(Request $request)
    {
        $data = $request->all();
        $tabela = DB::table('frase')
            ->where('idioma', '=', $data['idiomaEntrada'])
            ->where('texto', 'ILIKE', "%{$data['texto']}%")
            ->where('status', '=', 'A')
            ->take(6)
            ->get();

        $output = null;
        if (count($tabela) > 0):
            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
            foreach ($tabela as $row) {
                $output .= '<li><a href="#" onclick="pegaValor(this);" value="' . $row->codigo . '">' . $row->texto . '</a></li>';
            }
            $output .= '</ul>';
        endif;

        echo $output;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function idiomaLink(Request $request)
    {
        $data = $request->all();
        $idiomas = DB::table('idioma')
            ->where('idioma.id', '=', $data['idioma'])
            ->orderBy('nome')
            ->first();

        return response()->json($idiomas);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function idiomapesquisado(Request $request)
    {
        $data = $request->all();
        $idiomas = DB::table('idioma')->join('frase', 'idioma.id', '=', 'frase.idioma')
            ->select('idioma.id', 'idioma.nome', 'idioma.imagem')
            ->where('frase.codigo', '=', $data['codigo'])
            ->where('frase.status', '=', 'A')
            ->where('idioma.id', '!=', $data['idiomaEntrada'])
            ->groupBy('idioma.id', 'idioma.nome')
            ->orderBy('nome')
            ->get();

        return response()->json($idiomas);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function idiomatraduzir(Request $request)
    {
        $data = $request->all();

        $frase = DB::table('frase')
            ->where('frase.status', '=', 'A')
            ->where('frase.texto', 'ILIKE', '%' . $data['texto'] . '%')
            ->first();

        $frases = array();
        if ($frase->codigo):
            $frases = DB::table('frase')->join('idioma', 'idioma.id', '=', 'frase.idioma')
                ->where('frase.status', '=', 'A')
                ->where('frase.idioma', '=', $data['idiomaSaida'])
                ->where('frase.codigo', '=', $frase->codigo)
                ->first();
        endif;

        return response()->json($frases);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function enviarfraseemail(Request $request)
    {
        $data = $request->all();
        $mail = new PHPMailer(true);
        try {
            $desRemetente = $data['desRemetente'];
            $texto = $data['texto'];
            $resultado = $data['resultado'];
            $idiomaSaidaTexto = $data['idiomaSaidaTexto'];
            $idiomaEntradaTexto = $data['idiomaEntradaTexto'];
            $assunto = 'UNIFRASES';
            $desEmail = $data['desEmail'];

            $mail->isSMTP();
            $mail->CharSet = 'utf-8';
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = env('MAIL_ENCRYPTION');
            $mail->Host = env('MAIL_HOST');
            $mail->Port = env('MAIL_PORT');
            $mail->Username = env('MAIL_USERNAME_NOREPLY');
            $mail->Password = env('MAIL_PASSWORD_NOREPLY');
            $mail->setFrom(env('MY_EMAIL_NOREPLY'), env('MY_NAME_NOREPLY'));
            $mail->Subject = $assunto;

            $mensagemConteudo = "Frase enviada por: $desRemetente <br/>";
            $mensagemConteudo .= "Frase (Original) - $idiomaEntradaTexto: $texto <br/>";
            $mensagemConteudo .= "Frase (Comutada/Traduzida) - $idiomaSaidaTexto: $resultado <br/>";

            $mail->MsgHTML($mensagemConteudo);
            $mail->addAddress($desEmail, $desRemetente);
            $mail->send();
        } catch (Exception $e) {
            $result = array('result' => 'error', 'title' => $e->getMessage());
            return response()->json($result);
        } catch (Exception $e) {
            $result = array('result' => 'error', 'title' => $e->getMessage());
            return response()->json($result);
        }

        if ($mail):
            $result = array('result' => 'success', 'title' => 'Contato enviado com sucesso!');
        else:
            $result = array('result' => 'error', 'title' => 'Erro ao enviar as frases');
        endif;

        return response()->json($result);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function enviarcontato(Request $request)
    {
        $data = $request->all();
        $mail = new PHPMailer(true);
        try {
            $nome = $data['nome'];
            $email = $data['email'];
            $assunto = $data['assunto'];
            $mensagem = $data['mensagem'];

            $mail->isSMTP();
            $mail->CharSet = 'utf-8';
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = env('MAIL_ENCRYPTION');
            $mail->Host = env('MAIL_HOST');
            $mail->Port = env('MAIL_PORT');
            $mail->Username = env('MAIL_USERNAME');
            $mail->Password = env('MAIL_PASSWORD');
            $mail->setFrom(env('MY_EMAIL'), env('MY_NAME'));
            $mail->Subject = $data['assunto'];

            $mensagemConteudo = "Nome do Contato: $nome <br/>";
            $mensagemConteudo .= "Email do Contato: $email <br/>";
            $mensagemConteudo .= "Assunto: $assunto <br/>";
            $mensagemConteudo .= "Mensagem: $mensagem <br/>";

            $mail->MsgHTML($mensagemConteudo);
            $mail->addAddress(env('MY_EMAIL'), env('MY_NAME'));
            $mail->send();
        } catch (Exception $e) {
            return redirect()->route('principal.contato')->withInput()->with(['result' => 'error', 'title' => $e->getMessage()]);
        } catch (Exception $e) {
            return redirect()->route('principal.contato')->withInput()->with(['result' => 'error', 'title' => $e->getMessage()]);
        }

        if ($mail):
            return redirect()->route('principal.contato')->withInput()->with(['result' => 'success', 'title' => 'Contato enviado com sucesso!']);
        else:
            return redirect()->route('principal.contato')->withInput()->with(['result' => 'error', 'title' => 'Erro ao enviar mensagem!']);
        endif;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function entrarchat(Request $request)
    {
        $data = $request->all();
        if ($data['nickname']):
            $user = $this->chat_users->where('nickname', '=', $data['nickname'])->first();

            if ($user && $user->nickname == $data['nickname']):
                return response()->json(array('erro' => 'nickname já existe'));
            endif;
            $this->chat_users->nickname = $data['nickname'];
            $result = $this->chat_users->save();
            if ($result) :
                $request->session()->push('chat_users', $this->chat_users->nickname);
                return response()->json($this->chat_users);
            endif;
        endif;

        return response()->json(array('erro' => 'informe nickname'));
    }

    public function sairchat(Request $request)
    {
        $data = $request->all();

        $chat_users = $this->chat_users->where('nickname', '=', $data['chat_users_session']);
        $usuario = $chat_users->first();
        $request->session()->forget('chat_users');
        if ($chat_users->delete()) :
            $chat_messages = $this->chat_messages->where('to_nickname', '=', $usuario->id);
            $chat_messages->delete();
            $chat_messages = $this->chat_messages->where('from_nickname', '=', $usuario->id);
            $chat_messages->delete();
            return response()->json(array('ok', 'ok'));
        endif;

        return response()->json(array('erro' => 'erro'));
    }

    public function verificarusuarioonline()
    {
        $session = session('chat_users');
        $html = null;
        if ($session):
            $chat_users = $this->chat_users->where('nickname', '!=', current($session))->get();

            $qtd_user_online = $chat_users->count() + count($session);
            $html = "<button type='button' class='list-group-item list-group-item-action active'><span class='badge badge-primary badge-pill'>Usuários online ({$qtd_user_online})</span></button>";
            foreach ($chat_users as $key => $value):
                if(session('chat_users_nickname_escolhido') && current(session('chat_users_nickname_escolhido')) == $value->id):
                    $marcaUsuario = 'list-group-item list-group-item-success';
                else:
                    $marcaUsuario = 'list-group-item list-group-item-action';
                endif;
                $html .= "<button type='button' class='{$marcaUsuario}' onclick='conversaUsuario({$value->id})' id='idUserOnline' name='idUserOnline' value='{$value->id}'>{$value->nickname}</button>";
            endforeach;
        endif;

        $usuarios = $this->chat_users->where('id', '>=', 1)->get();
        if($usuarios->count() > 0):
            foreach($usuarios as $usuario):
                $date1 = Carbon::createFromFormat('Y-m-d H:i:s', $usuario->created_at);
                $date2 = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::parse()->format('Y-m-d H:i:s'));
                $qtdDias = $date2->diffInDays($date1);
                if($qtdDias > 1):
                    $chat_message_from = $this->chat_messages->where('from_nickname', '=', $usuario->id);
                    $chat_message_from->delete();
                    $chat_message_to = $this->chat_messages->where('to_nickname', '=', $usuario->id);
                    $chat_message_to->delete();
                    $chat_users = $this->chat_users->where('id', '=', $usuario->id);
                    $chat_users->delete();
                endif;
            endforeach;
        endif;

        return response()->json($html);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function enviamensagemchat(Request $request)
    {
        $data = $request->all();
        $session = session('chat_users');
        $chat_users = $this->chat_users
            ->where('nickname', '=', current($session))
            ->first();

        $chat_users_session = $this->chat_users
            ->where('id', '=', $data['idNicknameEscolhido'])
            ->first();
        $request->session()->forget('chat_users_nickname_escolhido');
        $request->session()->push('chat_users_nickname_escolhido', $data['idNicknameEscolhido']);

        $html = "<li><strong class='control-label'>" . $chat_users->nickname . "</strong> conversa com <strong class='control-label'>{$chat_users_session->nickname}</strong></li><input type='hidden' name='idNicknameEscolhido' id='idNicknameEscolhido' value='{$data['idNicknameEscolhido']}'>";

        $messages = $this->chat_messages
            ->where('from_nickname', '=', $chat_users->id)
            ->orWhere('to_nickname', '=', $chat_users->id)
            ->get();

        $arMessages = array();
        foreach ($messages as $value):
            if ($data['idNicknameEscolhido'] == $value->to_nickname):
                $arMessages[$value->id] = array('from_nickname' => $value->from_nickname, 'to_nickname' => $value->to_nickname, 'message' => $value->message);
            endif;
            if ($data['idNicknameEscolhido'] == $value->from_nickname):
                $arMessages[$value->id] = array('from_nickname' => $value->from_nickname, 'to_nickname' => $value->to_nickname, 'message' => $value->message);
            endif;
        endforeach;

        foreach ($arMessages as $message):
            $html .= "<li><strong class='control-label'>" . $this->getNicknameChatMessage($message['from_nickname']) . "</strong> fala para <strong class='control-label'>" . $this->getNicknameChatMessage($message['to_nickname']) . "</strong>: " . $message['message'] . "</li>";
        endforeach;

        return response()->json($html);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getNicknameChatMessage($id)
    {
        $result = $this->chat_users
            ->where('id', '=', $id)
            ->first();

        return $result->nickname;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function gravarmensagemchat(Request $request)
    {
        $data = $request->all();
        if ($data['idNicknameEscolhido'] && $data['chat_users_session']):
            $user = $this->chat_users->where('nickname', '=', $data['chat_users_session'])->first();
            $idNicknameFrom = $user->id;
            $this->chat_messages->from_nickname = $idNicknameFrom;
            $this->chat_messages->to_nickname = $data['idNicknameEscolhido'];
            $this->chat_messages->message = $data['resultado'];
            $this->chat_messages->status = 1;
            $result = $this->chat_messages->save();
            if ($result) :
                return response()->json($this->chat_messages);
            endif;
        endif;

        return response()->json(array('erro' => 'informe para quem você vai enviar mensagem'));
    }

}
