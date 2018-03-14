<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8">
        <title>DAE - Unimontes</title>
        <style type="text/css">
            td{
                font-family:Arial, Helvetica, sans-serif;
            }
            body{
                margin-left: 10px;
                margin-top: 0px;
                margin-right: 0px;
                margin-bottom: 0px;
            }
            .line_right{
                border-right:1px solid #000000;
            }
            .line_left{
                border-left:1px solid #000000;
            }
            .line_bottom{
                border-bottom:1px solid #000000;
            }
            .line_bottom_dotted{
                border-bottom:1px dotted #000000;
            }
            .line_top {
                border-top:1px solid #000000;
            }
            p{
            	font-size: 10;
            }
        </style>
        <style media="print">
            #inst_print {display:none;}
        </style>
    </head>
<body style="text-align: justify;">
    <table width="715" border="0" cellpadding="0" cellspacing="0" bordercolor="#000000">
        <tr id="inst_print"><td width="12">&nbsp;</td>
            <td width="703">
                <p>
                    <strong>Instruções para impressão do DAE:</strong><br/>
                    - Utilize impressora jato de tinta(inkjet) ou laser; - Configure a impressora p/ utilizar qualidade de impressão Normal. Não utilize as opções Rascunho ou Econômica;<br/>
                    - Imprimir em folha A4(210x297 mm) de cor branca; - Corte nas duas linhas indicadas. Não fure, dobre, amasse, rasure ou risque o código de barras;<br/>
                    - Configurar todas as margens para "7"<br/>
                    - Configure o navegador para imprimir cores e imagens do plano de fundo.<br/>
                    - <a href='?dicas' target="_blank">Como fazer as configurações necessárias?</a>
                </p>
            </td>
        </tr>
    </table>
    <!-- Inicio da tabela de Identificação do contribuinte -->
    <table width="710" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <!-- 1° via contribuinte -->
            <td width="16" valign="bottom"><img src="{{asset('images/vc.jpg')}}" width="11" height="124"></td>
            <td style="border:2px solid #000000; padding:5px;">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="368">
                            <table width="368" height="170" border="0" cellpadding="0" cellspacing="0">
                                <!--DWLayoutTable-->
                                <tr>
                                    <td width="10" height="10"><img src="{{asset('images/s_e.gif')}}" width="10" height="10"></td>
                                    <td colspan="3"><img src="{{asset('images/h10_lt.gif')}}" width="100%" height="10"></td>
                                    <td width="10"><img src="{{asset('images/s_d.gif')}}" width="10" height="10"></td>
                                </tr>
                                <tr>
                                    <td width="10"><img src="{{asset('images/w10_ll.gif')}}" width="10" height="66"></td>
                                    <td height="66" colspan="3">
                                        <table border="0" cellpadding="0" cellspacing="0" width="270">
                                            <tbody>
                                                <tr>
                                                    <td width="50"><div align="center"><img src="{{asset('images/brasao.gif')}}" height="50" width="50"></div></td>
                                                    <td width="220"><div align="center"><font face="Arial, Helvetica, sans-serif" size="2">SECRETARIA
                                                        DE ESTADO DE<br>
                                                        FAZENDA DE MINAS GERAIS</font></div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div align="center">
                                            <font face="Arial, Helvetica, sans-serif" size="2"><b>DOCUMENTO DE ARRECADA&Ccedil;&Atilde;O ESTADUAL - DAE</b></font>
                                        </div>
                                    </td>
                                    <td width="10"><img src="{{asset('images/w10_lr.gif')}}" width="10" height="66"></td>
                                </tr>
                                <tr>
                                    <td width="10" class="line_top"><img src="{{asset('images/w10_ll.gif')}}" width="10" height="29"></td>
                                    <td height="28" colspan="3" class="line_top">
                                        <table border="0" cellpadding="0" cellspacing="0">
                                            <tbody>
                                                <tr>
                                                    <td width="397"><font face="Arial, Helvetica, sans-serif" size="1">Nome:</font></td>
                                                </tr>
                                                <tr>
                                                    <td><font face="Arial, Helvetica, sans-serif" size="2">&nbsp;{{$candidato->nome}}</font></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td width="10" class="line_top"><img src="{{asset('images/w10_lr.gif')}}" width="10" height="29"></td>
                                </tr>
                                <tr>
                                    <td width="10" class="line_top line_bottom"><img src="{{asset('images/w10_ll.gif')}}" width="10" height="30"></td>
                                    <td height="31" colspan="3" class="line_bottom line_top">
                                        <table border="0" cellpadding="0" cellspacing="0">
                                            <tbody>
                                                <tr>
                                                    <td width="397"><font face="Arial, Helvetica, sans-serif" size="1">Endere&ccedil;o:</font></td>
                                                </tr>
                                                <tr>
                                                    <td><font face="Arial, Helvetica, sans-serif" size="2">&nbsp;{{$candidato->logradouro.' '.$candidato->numero}}</font></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td width="10" class="line_top line_bottom"><img src="{{asset('images/w10_lr.gif')}}" width="10" height="31"></td>
                                </tr>
                                <tr>
                                    <td width="10"><img src="{{asset('images/w10_ll.gif')}}" width="10" height="31"></td>
                                    <td height="28">
                                        <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
                                            <tbody>
                                                <tr>
                                                    <td width="190"><font face="Arial, Helvetica, sans-serif" size="1">Munic&iacute;pio:</font></td>
                                                </tr>
                                                <tr>
                                                    <td><font face="Arial, Helvetica, sans-serif" size="2">&nbsp;{{$candidato->cidade}}</font></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td height="28" class="line_right line_left">
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                            <tbody>
                                                <tr>
                                                    <td><font face="Arial, Helvetica, sans-serif" size="1">&nbsp;UF:</font></td>
                                                </tr>
                                                <tr>
                                                    <td align="center"><font face="Arial, Helvetica, sans-serif" size="2">{{$candidato->estado}}</font></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td height="28">
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                            <tbody>
                                                <tr>
                                                    <td width="134"><font face="Arial, Helvetica, sans-serif" size="1">&nbsp;Telefone:</font></td>
                                                </tr>
                                                <tr>
                                                    <td><font face="Arial, Helvetica, sans-serif" size="2">&nbsp;{{$candidato->telefone}}</font></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td width="10"><img src="{{asset('images/w10_lr.gif')}}" width="10" height="31"></td>
                                </tr>
                                <tr>
                                    <td width="10" height="10"><img src="{{asset('images/i_e.gif')}}" width="10" height="10"></td>
                                    <td width="168" valign="top"><img src="{{asset('images/h10_lb.gif')}}" width="100%" height="10"></td>
                                    <td width="33" valign="top" class="line_right line_left"><img src="{{asset('images/h10_lb.gif')}}" width="100%" height="10"></td>
                                    <td width="141"><img src="{{asset('images/h10_lb.gif')}}" width="100%" height="10"></td>
                                    <td width="10"><img src="{{asset('images/i_d.gif')}}" width="10" height="10"></td>
                                 </tr>
                             </table>
                         </td>
                         <td width="5"><img src="{{asset('images/nd.gif')}}" width="5" height="1"></td>
                         <td width="312"><table width="100%" height="170" border="0" cellpadding="0" cellspacing="0">
                             <tr>
                                 <td width="10" height="10" bgcolor="#CCCCCC"><img src="{{asset('images/s_e.gif')}}" width="10" height="10"></td>
                                 <td width="99" height="10" bgcolor="#CCCCCC" class="line_right line_top"><img src="{{asset('images/nd.gif')}}" width="100%" height="10"></td>
                                 <td width="152" height="10" class="line_top"><img src="{{asset('images/nd.gif')}}" width="100%" height="10"></td>
                                 <td width="10" height="10"><img src="{{asset('images/s_d.gif')}}" width="10" height="10" align="right"></td>
                             </tr>
                             <tr>
                                 <td width="10" bgcolor="#CCCCCC" class="line_bottom"><img src="{{asset('images/w10_ll.gif')}}" width="10" height="30"></td>
                                 <td bgcolor="#CCCCCC" class="line_right line_bottom">
                                     <table border="0" cellpadding="0" cellspacing="0">
                                         <tbody>
                                             <tr>
                                                 <td width="112" bgcolor="#cccccc"><font size="1">DATA DE VALIDADE </font></td>
                                             </tr>
                                             <tr>
                                                 <td><font face="Arial, Helvetica, sans-serif" size="2">{{ date('d/m/Y', strtotime($inscricao->vencimento)) }}</font></td>
                                             </tr>
                                         </tbody>
                                     </table>
                                 </td>
                                 <td class="line_bottom"><img src="{{asset('images/tpid1.jpg')}}" width="152" height="30" style="border:2px none"></td>
                                 <td width="10" class="line_bottom"><img src="{{asset('images/w10_lr.gif')}}" width="10" height="30" align="right"></td>
                             </tr>
                             <tr>
                                 <td width="10" class="line_bottom"><img src="{{asset('images/w10_ll.gif')}}" width="10" height="30"></td>
                                 <td colspan="2" class="line_bottom"><table border="0" cellpadding="0" cellspacing="0" width="280">
                                     <tbody>
                                         <tr>
                                             <td valign="top" width="50">
                                                 <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                     <tbody>
                                                         <tr>
                                                             <td><font face="Arial, Helvetica, sans-serif" size="1">Tipo</font></td>
                                                         </tr>
                                                         <tr>
                                                             <td align="center"><font face="Arial, Helvetica, sans-serif" size="2">4</font></td>
                                                         </tr>
                                                     </tbody>
                                                 </table>
                                             </td>
                                             <td width="1"><img src="{{asset('images/v1.gif')}}" height="30" width="1"></td>
                                             <td valign="top" width="229">
                                                 <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                     <tbody>
                                                         <tr>
                                                             <td><font face="Arial, Helvetica, sans-serif" size="1">&nbsp;N&uacute;mero Identifica&ccedil;&atilde;o</font></td>
                                                         </tr>
                                                         <tr>
                                                             <td align="left"><font face="Arial, Helvetica, sans-serif" size="2">&nbsp;{{$candidato->cpf}}</font></td>
                                                         </tr>
                                                     </tbody>
                                                 </table>
                                             </td>
                                         </tr>
                                     </tbody>
                                 </table>
                             </td>
                             <td width="10" class="line_bottom"><img src="{{asset('images/w10_lr.gif')}}" width="10" height="30" align="right"></td>
                         </tr>
                         <tr>
                             <td width="10" class="line_bottom"><img src="{{asset('images/w10_ll.gif')}}" width="10" height="29"></td>
                             <td colspan="2" class="line_bottom">
                                 <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                     <tbody>
                                         <tr>
                                             <td><font face="Arial, Helvetica, sans-serif" size="1">C&oacute;digo Munic&iacute;pio em MG (para produtor rural e n&atilde;o inscrito)</font></td>
                                         </tr>
                                         <tr>
                                             <td><font face="Arial, Helvetica, sans-serif" size="2">&nbsp;</font></td>
                                         </tr>
                                     </tbody>
                                 </table>
                             </td>
                             <td width="10" class="line_bottom"><img src="{{asset('images/w10_lr.gif')}}" width="10" height="29" align="right"></td>
                         </tr>
                         <tr>
                             <td width="10" class="line_bottom"><img src="{{asset('images/w10_ll.gif')}}" width="10" height="30"></td>
                             <td colspan="2" class="line_bottom">
                                 <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                     <tbody>
                                         <tr>
                                             <td><font face="Arial, Helvetica, sans-serif" size="1">M&ecirc;s/Ano de Refer&ecirc;ncia</font></td>
                                         </tr>
                                         <tr>
                                             <td><font face="Arial, Helvetica, sans-serif" size="2">&nbsp;&nbsp;{{ date('m/Y', strtotime(date('Y-m-d'))) }}</font></td>
                                         </tr>
                                     </tbody>
                                 </table>
                             </td>
                             <td width="10" class="line_bottom"><img src="{{asset('images/w10_lr.gif')}}" width="10" height="30" align="right"></td>
                         </tr>
                         <tr>
                             <td width="10"><img src="{{asset('images/w10_ll.gif')}}" width="10" height="30"></td>
                             <td colspan="2">
                                 <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                     <tbody>
                                         <tr>
                                             <td><font face="Arial, Helvetica, sans-serif" size="1">N&ordm; Documento</font></td>
                                         </tr>
                                         <tr>
                                             <td><font face="Arial, Helvetica, sans-serif" size="2">&nbsp;&nbsp;{{$inscricao->num_dae}}</font></td>
                                         </tr>
                                     </tbody>
                                 </table>
                             </td>
                             <td width="10"><img src="{{asset('images/w10_lr.gif')}}" width="10" height="30" align="right"></td>
                         </tr>
                         <tr>
                             <td width="10" height="10"><img src="{{asset('images/i_e.gif')}}" width="10" height="10"></td>
                             <td height="10" colspan="2"><img src="{{asset('images/h10_lb.gif')}}" width="100%" height="10"></td>
                             <td width="10" height="10"><img src="{{asset('images/i_d.gif')}}" width="10" height="10" align="right"></td>
                         </tr>
                     </table>
                 </td>
             </tr>
         </table>
         <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin:0px;">
             <tr><td colspan="3" height="5"><img src="{{asset('images/nd.gif')}}" height="5" width="10"></td></tr>
             <tr>
                 <td width="10" height="10"><img src="{{asset('images/s_e.gif')}}" width="10" height="10"></td>
                 <td height="10"><img src="{{asset('images/h10_lt.gif')}}" width="100%" height="10"></td>
                 <td width="10" height="10"><img src="{{asset('images/s_d.gif')}}" width="10" height="10"></td>
             </tr>
             <tr>
                 <td width="10" rowspan="13"><img src="{{asset('images/w10_ll.gif')}}" width="10" height="260"></td>
                 <td><font size="1">HIST&Oacute;RICO</font></td>
                 <td width="10" rowspan="13"><img src="{{asset('images/w10_lr.gif')}}" width="10" height="260"></td>
             </tr>
             <tr>
                 <td><font size="2"><strong>UNIVERSIDADE ESTADUAL DE MONTES CLAROS</strong></font></td>
             </tr>
             <tr>
                 <td><font size="2">Receita de remunera&ccedil;&atilde;o de outros dep&oacute;sitos banc&aacute;rios de recursos vinculados </font></td>
             </tr>
             <tr>
                 <td><font size="2">Descrição da Taxa: (1) Inscrição para o Processo de Programas de Residência</font></td>
             </tr>
             <tr>
                 <td>&nbsp;</td>
             </tr>
             <tr>
                 <td><font size="2">Bancos Autorizados a Receber o DAE</font></td>
             </tr>
             <tr>
                 <td><font size="2">Banco do Brasil, Banco Itaú, Banco Mercantil do Brasil, Bancoob e Bradesco.</font></td>
             </tr>
             <tr>
                 <td>&nbsp;</td>
             </tr>
             <tr>
                 <td><font size="2">DATA DE EMISS&Atilde;O:{{ date('d/m/Y') }}</font></td>
             </tr>
             <tr>
                 <td>&nbsp;</td>
             </tr>

             <tr>
                 <td><font size="2">SR. CAIXA,&nbsp;&nbsp;<br>
                     ESTE DOCUMENTO DEVE SER RECEBIDO EXCLUSIVAMENTE <br>
                     PELA LEITURA DO C&Oacute;DIGO DE BARRA OU LINHA DIGIT&Aacute;VEL.</font>
                 </td>
             </tr>
             <tr>
                 <td>&nbsp;</td>
             </tr>
             <tr>
                 <td valign="bottom"><font size="2">Linha Digit&aacute;vel: {{$codbarraS}}</font></td>
             </tr>
             <tr>
                 <td width="10" height="10"><img src="{{asset('images/i_e.gif')}}" width="10" height="10"></td>
                 <td height="10"><img src="{{asset('images/h10_lb.gif')}}" width="100%" height="10"></td>
                 <td width="10" height="10"><img src="{{asset('images/i_d.gif')}}" width="10" height="10"></td>
             </tr>
             <tr><td colspan="3" height="5"><img src="{{asset('images/nd.gif')}}" height="5" width="10"></td></tr>
         </table>
         <!-- fim 1° via contribuinte -->
            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin:0px;">
                <tr>
                    <td width="366">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td width="10" height="10"><img src="{{asset('images/s_e.gif')}}" width="10" height="10"></td>
                                <td height="10"><img src="{{asset('images/h10_lt.gif')}}" width="100%" height="10"></td>
                                <td width="10" height="10"><img src="{{asset('images/s_d.gif')}}" width="10" height="10"></td>
                            </tr>
                            <tr>
                                <td width="10" rowspan="2"><img src="{{asset('images/w10_ll.gif')}}" width="10" height="60"></td>
                                <td><font size="1">AUTENTICAÇÃO</font></td>
                                <td width="10" rowspan="2"><img src="{{asset('images/w10_lr.gif')}}" width="10" height="60"></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td width="10" height="10"><img src="{{asset('images/i_e.gif')}}" width="10" height="10"></td>
                                <td height="10"><img src="{{asset('images/h10_lb.gif')}}" width="100%" height="10"></td>
                                <td width="10" height="10"><img src="{{asset('images/i_d.gif')}}" width="10" height="10"></td>
                            </tr>
                        </table>
                    </td>
                    <td width="5"><img src="{{asset('images/nd.gif')}}" width="5" height="1"></td>
                        <td width="300">
                            <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#CCCCCC">
                                <tr>
                                    <td width="10" height="10"><img src="{{asset('images/s_e.gif')}}" width="10" height="10"></td>
                                    <td height="10" class="line_right"><img src="{{asset('images/h10_lt.gif')}}" width="100%" height="10"></td>
                                    <td height="10"><img src="{{asset('images/h10_lt.gif')}}" width="100%" height="10"></td>
                                    <td width="10" height="10"><img src="{{asset('images/s_d.gif')}}" width="10" height="10"></td>
                                </tr>
                                <tr>
                                    <td width="10"><img src="{{asset('images/w10_ll.gif')}}" width="10" height="60"></td>
                                    <td width="84" align="center" valign="middle" class="line_right"><font size="2"><strong>TOTAL</strong></font></td>
                                    <td width="202" align="center" valign="middle">R$&nbsp;{{ $valor }}</td>
                                    <td width="10"><img src="{{asset('images/w10_lr.gif')}}" width="10" height="60"></td>
                                </tr>
                                <tr>
                                    <td width="10" height="10"><img src="{{asset('images/i_e.gif')}}" width="10" height="10"></td>
                                    <td height="10" class="line_right"><img src="{{asset('images/h10_lb.gif')}}" width="100%" height="10"></td>
                                    <td height="10"><img src="{{asset('images/h10_lb.gif')}}" width="100%" height="10"></td>
                                    <td width="10" height="10"><img src="{{asset('images/i_d.gif')}}" width="10" height="10"></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td width="16" valign="bottom">&nbsp;</td>
            <td valign="top" class="line_bottom_dotted">
                <img src="{{asset('images/mod060111.gif')}}" width="96" height="10">
            </td>
        </tr>
        <tr>
            <td height="5" valign="bottom"></td>
            <td height="8"></td>
        </tr>
        <!-- 2° via banco -->
        <tr>
            <td valign="bottom">&nbsp;</td>
            <td>
                <table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <td width="10" height="10"><img src="{{asset('images/s_e.gif')}}" width="10" height="10"></td>
                        <td height="10"><img src="{{asset('images/h10_lt.gif')}}" width="100%" height="10"></td>
                        <td width="10" height="10"><img src="{{asset('images/s_d.gif')}}" width="10" height="10"></td>
                    </tr>
                    <tr>
                        <td width="10" rowspan="2"><img src="{{asset('images/w10_ll.gif')}}" width="10" height="72"></td>
                        <td align="center" valign="bottom"><font size="3">{{$codbarraS}}</font></td>
                        <td width="10" rowspan="2"><img src="{{asset('images/w10_lr.gif')}}" width="10" height="72"></td>
                    </tr>
                    <tr>
                        <td align="center" valign="top">{!! $codBarraS_WBarCode !!}</td>
                    </tr>
                    <tr>
                        <td width="10" height="10"><img src="{{asset('images/i_e.gif')}}" width="10" height="10"></td>
                        <td height="10"><img src="{{asset('images/h10_lb.gif')}}" width="100%" height="10"></td>
                        <td width="10" height="10"><img src="{{asset('images/i_d.gif')}}" width="10" height="10"></td>
                    </tr>
                    <tr><td height="5" colspan="3"><img src="{{asset('images/nd.gif')}}" width="100%" height="5"></td></tr>
                </table>
            </td>
        </tr>
        <tr>
            <td valign="bottom"><img src="{{asset('images/vb.jpg')}}" width="11" height="81"></td>
            <td style="padding:5px; border:2px solid #000000">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="366"><table width="375" height="170" border="0" cellpadding="0" cellspacing="0">
                            <!--DWLayoutTable-->
                            <tr>
                                <td width="10" height="10"><img src="{{asset('images/s_e.gif')}}" width="10" height="10"></td>
                                <td colspan="3"><img src="{{asset('images/h10_lt.gif')}}" width="100%" height="10"></td>
                                <td width="10"><img src="{{asset('images/s_d.gif')}}" width="10" height="10"></td>
                            </tr>
                            <tr>
                                <td width="10"><img src="{{asset('images/w10_ll.gif')}}" width="10" height="66"></td>
                                <td height="66" colspan="3">
                                    <table border="0" cellpadding="0" cellspacing="0" width="270">
                                        <tbody>
                                            <tr>
                                                <td width="50"><div align="center"><img src="{{asset('images/brasao.gif')}}" height="50" width="50"></div></td>
                                                <td width="220"><div align="center"><font face="Arial, Helvetica, sans-serif" size="2">SECRETARIA
                                                    DE ESTADO DE<br>
                                                    FAZENDA DE MINAS GERAIS</font></div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div align="center"><font face="Arial, Helvetica, sans-serif" size="2"><b>DOCUMENTO DE ARRECADA&Ccedil;&Atilde;O ESTADUAL - DAE</b></font></div></td>
                                    <td width="10"><img src="{{asset('images/w10_lr.gif')}}" width="10" height="66"></td>
                                </tr>
                                <tr>
                                    <td width="10" class="line_top"><img src="{{asset('images/w10_ll.gif')}}" width="10" height="29"></td>
                                    <td height="28" colspan="3" class="line_top">
                                        <table border="0" cellpadding="0" cellspacing="0">
                                            <tbody>
                                                <tr>
                                                    <td width="397"><font face="Arial, Helvetica, sans-serif" size="1">Nome:</font></td>
                                                </tr>
                                                <tr>
                                                    <td><font face="Arial, Helvetica, sans-serif" size="2">&nbsp;{{$candidato->nome}}</font></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td width="10" class="line_top"><img src="{{asset('images/w10_lr.gif')}}" width="10" height="29"></td>
                                </tr>
                                <tr>
                                    <td width="10" class="line_top line_bottom"><img src="{{asset('images/w10_ll.gif')}}" width="10" height="30"></td>
                                    <td height="31" colspan="3" class="line_bottom line_top">
                                        <table border="0" cellpadding="0" cellspacing="0">
                                            <tbody>
                                                <tr>
                                                    <td width="397"><font face="Arial, Helvetica, sans-serif" size="1">Endere&ccedil;o:</font></td>
                                                </tr>
                                                <tr>
                                                    <td><font face="Arial, Helvetica, sans-serif" size="2">&nbsp;{{$candidato->logradouro.' '.$candidato->numero}}</font></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td width="10" class="line_top line_bottom"><img src="{{asset('images/w10_lr.gif')}}" width="10" height="31"></td>
                                </tr>
                                <tr>
                                    <td width="10"><img src="{{asset('images/w10_ll.gif')}}" width="10" height="31"></td>
                                    <td height="28">
                                        <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
                                            <tbody>
                                                <tr>
                                                    <td width="190"><font face="Arial, Helvetica, sans-serif" size="1">Munic&iacute;pio:</font></td>
                                                </tr>
                                                <tr>
                                                    <td><font face="Arial, Helvetica, sans-serif" size="2">&nbsp;{{$candidato->cidade}}</font></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td height="28" class="line_right line_left">
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                            <tbody>
                                                <tr>
                                                    <td><font face="Arial, Helvetica, sans-serif" size="1">&nbsp;UF:</font></td>
                                                </tr>
                                                <tr>
                                                    <td align="center"><font face="Arial, Helvetica, sans-serif" size="2">{{$candidato->estado}}</font></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td height="28">
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                            <tbody>
                                                <tr>
                                                    <td width="134"><font face="Arial, Helvetica, sans-serif" size="1">&nbsp;Telefone:</font></td>
                                                </tr>
                                                <tr>
                                                    <td><font face="Arial, Helvetica, sans-serif" size="2">&nbsp;{{$candidato->telefone}}</font></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td width="10"><img src="{{asset('images/w10_lr.gif')}}" width="10" height="31"></td>
                                </tr>
                                <tr>
                                    <td width="10" height="10"><img src="{{asset('images/i_e.gif')}}" width="10" height="10"></td>
                                    <td width="173" valign="top"><img src="{{asset('images/h10_lb.gif')}}" width="100%" height="10"></td>
                                    <td width="34" valign="top" class="line_right line_left"><img src="{{asset('images/h10_lb.gif')}}" width="100%" height="10"></td>
                                    <td width="147"><img src="{{asset('images/h10_lb.gif')}}" width="100%" height="10"></td>
                                    <td width="10"><img src="{{asset('images/i_d.gif')}}" width="10" height="10"></td>
                                </tr>
                            </table>
                            <table width="375" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td colspan="3" height="5"><img src="{{asset('images/nd.gif')}}" width="1" height="5"></td>
                                </tr>
                                <tr>
                                    <td width="10" height="10"><img src="{{asset('images/s_e.gif')}}" width="10" height="10"></td>
                                    <td height="10"><img src="{{asset('images/h10_lt.gif')}}" width="100%" height="10"></td>
                                    <td width="10" height="10"><img src="{{asset('images/s_d.gif')}}" width="10" height="10"></td>
                                </tr>
                                <tr>
                                    <td width="10" rowspan="2"><img src="{{asset('images/w10_ll.gif')}}" width="10" height="61"></td>
                                    <td><font size="1">AUTENTICA&Ccedil;&Atilde;O</font></td>
                                    <td width="10" rowspan="2"><img src="{{asset('images/w10_lr.gif')}}" width="10" height="61"></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td width="10" height="10"><img src="{{asset('images/i_e.gif')}}" width="10" height="10"></td>
                                    <td height="10"><img src="{{asset('images/h10_lb.gif')}}" width="100%" height="10"></td>
                                    <td width="10" height="10"><img src="{{asset('images/i_d.gif')}}" width="10" height="10"></td>
                                </tr>
                            </table>
                        </td>
                        <td width="5"><img src="{{asset('images/nd.gif')}}" width="5" height="1"></td>
                        <td width="300">
                            <table width="310" height="170" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="10" height="10" bgcolor="#CCCCCC"><img src="{{asset('images/s_e.gif')}}" width="10" height="10"></td>
                                    <td width="99" height="10" bgcolor="#CCCCCC" class="line_right line_top"><img src="{{asset('images/nd.gif')}}" width="100%" height="10"></td>
                                    <td width="152" height="10" class="line_top"><img src="{{asset('images/nd.gif')}}" width="100%" height="10"></td>
                                    <td width="11" height="10"><img src="{{asset('images/s_d.gif')}}" width="10" height="10"></td>
                                </tr>
                                <tr>
                                    <td width="10" bgcolor="#CCCCCC" class="line_bottom"><img src="{{asset('images/w10_ll.gif')}}" width="10" height="30"></td>
                                    <td bgcolor="#CCCCCC" class="line_right line_bottom">
                                        <table border="0" cellpadding="0" cellspacing="0">
                                            <tbody>
                                                <tr>
                                                    <td width="112" bgcolor="#cccccc"><font size="1">DATA DE VALIDADE </font></td>
                                                </tr>
                                                <tr>
                                                    <td><font face="Arial, Helvetica, sans-serif" size="2">{{ date('d/m/Y', strtotime($inscricao->vencimento)) }}</font></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td class="line_bottom"><img src="{{asset('images/tpid1.jpg')}}" width="152" height="30"></td>
                                    <td width="11" class="line_bottom"><img src="{{asset('images/w10_lr.gif')}}" width="10" height="30"></td>
                                </tr>
                                <tr>
                                    <td width="10" class="line_bottom"><img src="{{asset('images/w10_ll.gif')}}" width="10" height="30"></td>
                                    <td colspan="2" class="line_bottom"><table border="0" cellpadding="0" cellspacing="0" width="280">
                                        <tbody>
                                            <tr>
                                                <td valign="top" width="50">
                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                        <tbody>
                                                            <tr>
                                                                <td><font face="Arial, Helvetica, sans-serif" size="1">Tipo</font></td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center"><font face="Arial, Helvetica, sans-serif" size="2">4</font></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                                <td width="1"><img src="{{asset('images/v1.gif')}}" height="30" width="1"></td>
                                                <td valign="top" width="229">
                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                        <tbody>
                                                            <tr>
                                                                <td><font face="Arial, Helvetica, sans-serif" size="1">&nbsp;N&uacute;mero Identifica&ccedil;&atilde;o</font></td>
                                                            </tr>
                                                            <tr>
                                                                <td align="left"><font face="Arial, Helvetica, sans-serif" size="2">&nbsp;{{$candidato->cpf}}</font></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td width="11" class="line_bottom"><img src="{{asset('images/w10_lr.gif')}}" width="10" height="30"></td>
                            </tr>
                            <tr>
                                <td width="10" class="line_bottom"><img src="{{asset('images/w10_ll.gif')}}" width="10" height="29"></td>
                                <td colspan="2" class="line_bottom">
                                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                        <tbody>
                                            <tr>
                                                <td><font face="Arial, Helvetica, sans-serif" size="1">C&oacute;digo Munic&iacute;pio em MG (para produtor rural e n&atilde;o inscrito)</font></td>
                                            </tr>
                                            <tr>
                                                <td><font face="Arial, Helvetica, sans-serif" size="2">&nbsp;</font></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td width="11" class="line_bottom"><img src="{{asset('images/w10_lr.gif')}}" width="10" height="29"></td>
                            </tr>
                            <tr>
                                <td width="10" class="line_bottom"><img src="{{asset('images/w10_ll.gif')}}" width="10" height="30"></td>
                                <td colspan="2" class="line_bottom">
                                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                        <tbody>
                                            <tr>
                                                <td><font face="Arial, Helvetica, sans-serif" size="1">N&uacute;mero do DAE </font></td>
                                            </tr>
                                            <tr>
                                                <td><font face="Arial, Helvetica, sans-serif" size="2">&nbsp;{{$inscricao->num_dae}}</font></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td width="11" class="line_bottom"><img src="{{asset('images/w10_lr.gif')}}" width="10" height="30"></td>
                            </tr>
                            <tr>
                                <td width="10"><img src="{{asset('images/w10_ll.gif')}}" width="10" height="30"></td>
                                <td colspan="2">
                                    <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td width="27%" height="26" valign="top" class="line_right"><font size="1">VALOR</font></td>
                                            <td width="73%" align="right" valign="middle"><font size="2">R$&nbsp;{{$valor}}</font></td>
                                        </tr>
                                    </table>
                                </td>
                                <td width="11"><img src="{{asset('images/w10_lr.gif')}}" width="10" height="30"></td>
                            </tr>
                            <tr>
                                <td width="10" class="line_top"><img src="{{asset('images/w10_ll.gif')}}" width="10" height="30"></td>
                                <td colspan="2" class="line_top"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td width="27%" height="26" valign="top" class="line_right"><font size="1">ACR&Eacute;SCIMOS</font></td>
                                        <td width="73%" valign="middle">&nbsp;</td>
                                    </tr>
                                </table>
                            </td>
                            <td width="11" class="line_top"><img src="{{asset('images/w10_lr.gif')}}" width="10" height="30"></td>
                        </tr>
                        <tr>
                            <td width="10" class="line_top"><img src="{{asset('images/w10_ll.gif')}}" width="10" height="30"></td>
                            <td colspan="2" class="line_top">
                                <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td width="27%" height="26" valign="top" class="line_right"><font size="1">JUROS</font></td>
                                        <td width="73%" valign="middle">&nbsp;</td>
                                    </tr>
                                </table>
                            </td>
                            <td width="11" class="line_top"><img src="{{asset('images/w10_lr.gif')}}" width="10" height="30"></td>
                        </tr>
                        <tr>
                            <td width="10" bgcolor="#CCCCCC" class="line_top"><img src="{{asset('images/w10_ll.gif')}}" width="10" height="30"></td>
                            <td colspan="2" bgcolor="#CCCCCC" class="line_top">
                                <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#CCCCCC">
                                    <tr>
                                        <td width="27%" height="26" align="center" valign="middle" class="line_right"><strong><font size="2">TOTAL</font></strong></td>
                                        <td width="73%" align="right" valign="middle"><font size="2"><strong>R$&nbsp;{{$valor}}</strong></font></td>
                                    </tr>
                                </table>
                            </td>
                            <td width="11" bgcolor="#CCCCCC" class="line_top"><img src="{{asset('images/w10_lr.gif')}}" width="10" height="30"></td>
                        </tr>
                        <tr>
                            <td width="10" height="10" bgcolor="#CCCCCC"><img src="{{asset('images/i_e.gif')}}" width="10" height="10"></td>
                            <td height="10" colspan="2" bgcolor="#CCCCCC"><img src="{{asset('images/h10_lb.gif')}}" width="100%" height="10"></td>
                            <td width="11" height="10" bgcolor="#CCCCCC"><img src="{{asset('images/i_d.gif')}}" width="10" height="10"></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </td>
 </tr>
<!-- fim 2° via banco -->
 <tr><td></td><td valign="top"><img src="{{asset('images/mod060111.gif')}}" width="96" height="10"></td>
 </tr>
</table>
<img src="{{asset('images/w10_ll.gif')}}" width="15" height="10" style="position:absolute; top: 939px; left: 495px;">
</body>
</html>
