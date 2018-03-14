<?php

namespace App\Http\Controllers\Candidato;

use App\Models\Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Inscricao;
use App\Models\Usuario;
use Auth;

class DaeController extends Controller{

    private $configs;

    public function __construct(){
        $this->configs = Config::all()->first();
    }

    public function index($inscricao_id){

        function modulo11($numero){

            $mult = 2;
            $dig = 0;

            for ($i = strlen($numero) - 1; $i >= 0; $i--) {
                $dig = $dig + (substr($numero, $i, 1) * $mult);
                //	echo substr($numero,$i,1)."*".$mult." = ".(substr($numero,$i,1)*$mult)."<br>";
                $mult = $mult + 1;

                if ($mult > 11) {
                    $mult = 2;
                }
            }

            $dig = $dig % 11;

            if ($dig == 0) {
                $dig = 1;
            } else if ($dig == 1) {
                $dig = 0;
            } else {
                $dig = 11 - $dig;
                if ($dig > 9) {
                    $dig = 0;
                }
            }

            return $dig;
        }

        function modulo10($numero){

            $mult = 2;
            $somador = 0;
            $dig = 0;
            for ($i = strlen($numero) - 1; $i >= 0; $i--) {
                $somador = (substr($numero, $i, 1) * $mult);
                //	echo substr($numero,$i,1)."*".$mult." = ";
                if ($somador > 9) {
                    for ($j = 0; $j < strlen($somador); $j++) {
                        $dig = $dig + substr($somador, $j, 1);
                        //			 echo substr($somador,$j,1)."<br>";
                    }
                } else {
                    $dig = $dig + $somador;
                    //		 echo $somador."<br>";
                }
                if ($mult == 2) {
                    $mult = 1;
                } else {
                    $mult = 2;
                }
            }

            $dig = $dig % 10;
            $dig = 10 - $dig;
            if ($dig > 9) {
                $dig = 0;
            }

            return $dig;
        }

        function dgnossonum($numero){

            $dg10 = modulo10($numero);
            $dg11 = modulo11($numero . $dg10);

            return $dg10 . $dg11;
        }

        $inscricao = Inscricao::find($inscricao_id);

        $servico = "71";
        // Tem-se 9 digitos para usar no boleto
        $nossonumero = str_pad($servico, 2, "0", STR_PAD_LEFT) . str_pad($inscricao_id, 9, "0", STR_PAD_LEFT); // numero do DAE
        $nossonumero = $nossonumero . dgnossonum($nossonumero);//numero do DAE
        $inscricao->num_dae = $nossonumero;
        // Se o candidato pediu isenção e foi indeferido
        if(date('Y-m-d H:i') > formatarDataHoraExtensoUSA($this->configs->termino_pagamento_dae) AND $inscricao->pediu_isencao == 1 AND ($inscricao->status_pedido_isencao == 1 OR empty($inscricao->status_pedido_isencao))){
            $inscricao->vencimento = '2018-01-22';
        }else{
            $inscricao->vencimento = '2018-01-15';
        }
        $inscricao->mes_referencia = date('Y-m-d');
        $inscricao->save();

        return redirect()->route('candidato.dae.show');
    }

    public function show(){

        function esquerda($entra, $comp)
        {
            return substr($entra, 0, $comp);
        }

        function direita($entra, $comp)
        {
            return substr($entra, strlen($entra) - $comp, $comp);
        }

        function modulo10($numero)
        {
            $mult = 2;
            $somador = 0;
            $dig = 0;
            for ($i = strlen($numero) - 1; $i >= 0; $i--) {
                $somador = (substr($numero, $i, 1) * $mult);
                //	echo substr($numero,$i,1)."*".$mult." = ";
                if ($somador > 9) {
                    for ($j = 0; $j < strlen($somador); $j++) {
                        $dig = $dig + substr($somador, $j, 1);
                        //			 echo substr($somador,$j,1)."<br>";
                    }
                } else {
                    $dig = $dig + $somador;
                    //		 echo $somador."<br>";
                }
                if ($mult == 2) {
                    $mult = 1;
                } else {
                    $mult = 2;
                }
            }
            $dig = $dig % 10;
            $dig = 10 - $dig;
            if ($dig > 9) {
                $dig = 0;
            }
            return $dig;
        }

        function WBarCode($valor)
        {
            $fino = 1;
            $largo = 3;
            $altura = 50;
            $return = '';

            $barcodes[0] = "00110";
            $barcodes[1] = "10001";
            $barcodes[2] = "01001";
            $barcodes[3] = "11000";
            $barcodes[4] = "00101";
            $barcodes[5] = "10100";
            $barcodes[6] = "01100";
            $barcodes[7] = "00011";
            $barcodes[8] = "10010";
            $barcodes[9] = "01010";
            for ($f1 = 9; $f1 >= 0; $f1--) {
                for ($f2 = 9; $f2 >= 0; $f2--) {
                    $f = ($f1 * 10) + $f2;
                    $texto = "";
                    for ($i = 1; $i < 6; $i++) {
                        $texto .= substr($barcodes[$f1], ($i - 1), 1) . substr($barcodes[$f2], ($i - 1), 1);
                    }
                    $barcodes[$f] = $texto;
                }
            }
            //Desenho da barra
            //Guarda inicial
            $texto = $valor;
            //if (bcmod(strlen($texto),2) <> 0){
            //   $texto = "0" . $texto;}
            $return = $return . "<img src='../../images/p.gif' width=$fino height=$altura border=0><img ";
            $return = $return . "src='../../images/b.gif' width=$fino height=$altura border=0><img ";
            $return = $return . "src='../../images/p.gif' width=$fino height=$altura border=0><img ";
            $return = $return . "src='../../images/b.gif' width=$fino height=$altura border=0><img ";
            // Draw dos dados
            while (strlen($texto) > 0) {
                $i = round(esquerda($texto, 2));
                $texto = direita($texto, strlen($texto) - 2);
                $f = $barcodes[$i];
                for ($i = 1; $i < 11; $i += 2) {
                    if (substr($f, ($i - 1), 1) == "0") {
                        $f1 = $fino;
                    } else {
                        $f1 = $largo;
                    }
                    $return = $return . "src='../../images/p.gif' width=$f1 height=$altura border=0><img ";
                    if (substr($f, $i, 1) == "0") {
                        $f2 = $fino;
                    } else {
                        $f2 = $largo;
                    }
                    $return = $return . " src='../../images/b.gif' width=$f2 height=$altura border=0><img ";
                }
            }
            // Draw guarda final
            $return = $return . "src='../../images/p.gif' width=$largo height=$altura border=0><img ";
            $return = $return . "src='../../images/b.gif' width=$fino height=$altura border=0><img ";
            $return = $return . "src='../../images/p.gif' width=1 height=$altura border=0> ";
            return $return;
        }

        function codbarra($valor, $data, $nossonumero, $orgaodestino)
        {
            $inicio = "856";
            $valor = str_pad($valor, 11, "0", STR_PAD_LEFT);
            $empresa = "0213";

            $origemversao = "12";
            $taxa = "0";
            //'85680000000802502130604151202200698501820231'
            $camposcod = $valor . $empresa . $data . $origemversao . $nossonumero . $taxa . $orgaodestino;
            $codbarra = $inicio . modulo10($inicio . $camposcod) . $camposcod;
            //echo $codbarra."<br>";
            // Substituição da função
            //$codbarratxt = preg_replace('/([0-9]{11})/e', '"\1" ." ". modulo10("\1")." "', $codbarra);
            $codbarraEnv = $codbarra;
            $codbarra = str_split($codbarra, 11);
            $codbarratxt = '';
            foreach ($codbarra as $key => $cod) {
                $codbarratxt = $codbarratxt . $cod . ' ' . modulo10($cod) . ' ';
            }
            /*
            $codbarratxt  =     substr($codbarra,0,11)." ".modulo10(substr($codbarra,0,11));
            $codbarratxt .= " ".substr($codbarra,11,11)." ".modulo10(substr($codbarra,11,11));
            $codbarratxt .= " ".substr($codbarra,22,11)." ".modulo10(substr($codbarra,22,11));
            $codbarratxt .= " ".substr($codbarra,33,11)." ".modulo10(substr($codbarra,33,11));
            */
            //echo $codbarratxt;
            $res[0] = $codbarraEnv;
            $res[1] = $codbarratxt;
            return $res;
        }

        $candidato = Usuario::find(Auth::id());
        $inscricao = Inscricao::where('usuario_id', $candidato->id)->where('status_dae', 0)->first();
        $date = date('ymd', strtotime($inscricao->vencimento));

        // converte o valor que vem do banco de dados no formato ($1,110.50) para o formato (1110.50)
        $valor = '170,00';
        $valor = str_replace(',', '', $valor);
        // o valor deve estar somente com numeros para gerar o codigo de barras
        // $valor = str_replace('.', '', $valor);
        if (!is_null($inscricao->num_dae)) {
            $codbarraS = codbarra($valor, $date, $inscricao->num_dae, "231");
            $codBarraS_WBarCode = WBarCode($codbarraS[0]);
            $codbarraS = $codbarraS[1];
            $valor = '170,00';
            return view('candidato.dae', compact('candidato', 'inscricao', 'codbarraS', 'codBarraS_WBarCode', 'valor'));
        } else {
            return redirect()->back()->with('danger', 'Ocorreu um erro, a dae não pôde ser emitida!');
        }
    }
}

