<?php
 
include_once "dbconfig.php";
//include_once "conexao/conexao1.php";
//include_once "conexao/conexao.php";
include_once "mpdf/mpdf.php";

$inscricao = filter_input_array(INPUT_GET, FILTER_DEFAULT);

if (isset($inscricao['inscricao'])) {
    $edit_inscricao = filter_var($inscricao['inscricao'], FILTER_SANITIZE_STRING);

    $consulta = $DB_con->query("SELECT * FROM candidatos WHERE Inscricao =$edit_inscricao");

    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {

        $newInscricao = $linha['Inscricao'];
        $newNome = $linha['Nome'];
        $Orientador = $linha['Orientador1'];
        
        $consulta1 = $DB_con->query("SELECT `usuarios`.`nome` FROM `candidatos`
            INNER JOIN `usuarios` ON `usuarios`.`id` = $Orientador
            GROUP BY
            `usuarios`.`nome`");
        
        while ($linha1 = $consulta1->fetch(PDO::FETCH_ASSOC)) {
            $newOrientador = $linha1['usuarios.nome'];
        }
    }
}
//$texto1= "exemplo de variável dentro de outra variável ".$edit_inscricao;
$texto = "
<html xmlns=http://www.w3.org/1999/xhtml>
<head profile=http://dublincore.org/documents/dcmi-terms/>
<meta http-equiv=Content-Type content=text/html; charset=utf-8>
<title xml:lang=en-US></title>
<meta name=DCTERMS.title content= xml:lang=en-US>
<meta name=DCTERMS.language content=en-US scheme=DCTERMS.RFC4646>
<meta name=DCTERMS.source content=http://xml.openoffice.org/odf2xhtml>
<meta name=DCTERMS.issued content=2015-11-25T11:45:37.140000000 scheme=DCTERMS.W3CDTF>
<meta name=DCTERMS.modified content=2015-11-25T11:50:51.218000000 scheme=DCTERMS.W3CDTF>
<meta name=DCTERMS.provenance content= xml:lang=en-US>
<meta name=DCTERMS.subject content=, xml:lang=en-US>
<link rel=schema.DC href=http://purl.org/dc/elements/1.1/ hreflang=en>
<link rel=schema.DCTERMS href=http://purl.org/dc/terms/ hreflang=en>
<link rel=schema.DCTYPE href=http://purl.org/dc/dcmitype/ hreflang=en>
<link rel=schema.DCAM href=http://purl.org/dc/dcam/ hreflang=en>
<style type=text/css>
	</style>
        <style type=text/css>
        </style>
        </head>
        <body dir=ltr style=max-width:21.001cm;margin-top:2.499cm; margin-bottom:2.499cm; margin-left:2.739cm; margin-right:2.995cm; writing-mode:lr-tb; >
        <p class=P17>ANEXO 4</p>
        <p class=P16><span class=T1>FICHA DE AVALIA&Ccedil;&Atilde;O DE CANDIDATO - Entrevista</span></p>
        <p class=P16>(a ser preenchida pelo examinador)</p>
        <p class=P16>&nbsp;</p>
        <p class=P18>Candidato: <span class=T5>$newInscricao - $newNome</span></p>
        <br>
        <table border=0 cellspacing=0 cellpadding=0 class=Tabela3>
        <colgroup><col width=424>
        <col width=111>
        <col width=139></colgroup>
        <tbody>
        <tr class=Tabela31>
        <td style=text-align:left;width:9.712cm;  class=Tabela3_A1>
        <p class=P7>CRIT&Eacute;RIOS</p></td>
        <td style=text-align:left;width:2.54cm;  class=Tabela3_A1>
        <p class=P7>NOTA</p></td>
        <td style=text-align:left;width:3.179cm;  class=Tabela3_C1>
        <p class=P7>PONTUA&Ccedil;&Atilde;O</p></td></tr><tr class=Tabela32>
        <td style=text-align:left;width:9.712cm;  class=Tabela3_A2>
        <p class=P13>
        <span class=T1>1. Objetivos, motiva&ccedil;&atilde;o e perspectivas do candidato para atividades de pesquisa</span></p></td>
        <td style=text-align:left;width:2.54cm;  class=Tabela3_A2>
        <p class=P11><span class=T1>At&eacute; 1,0</span></p></td>
        <td style=text-align:left;width:3.179cm;  class=Tabela3_C2>
        <p class=P7>&nbsp;</p></td></tr>
        <tr class=Tabela33><td style=text-align:left;width:9.712cm;  class=Tabela3_A2>
        <p class=P14><span class=T1>2. Experi&ecirc;ncia e conhecimento na(s) linha(s) de pesquisa escolhida(s)</span></p></td>
        <td style=text-align:left;width:2.54cm;  class=Tabela3_A2>
        <p class=P11><span class=T1>At&eacute; 2,0</span></p></td>
        <td style=text-align:left;width:3.179cm;  class=Tabela3_C2>
        <p class=P1>&nbsp;</p></td></tr>
        <tr class=Tabela31>
        <td style=text-align:left;width:9.712cm;  class=Tabela3_A2>
        <p class=P14><span class=T1>3. Adequa&ccedil;&atilde;o do perfil do candidato &agrave;s atividades de pesquisa na(s) linha(s) de pesquisa escolhida(s)</span></p></td>
        <td style=text-align:left;width:2.54cm;  class=Tabela3_A2>
        <p class=P11><span class=T1>At&eacute; 2,0</span></p></td>
        <td style=text-align:left;width:3.179cm;  class=Tabela3_C2>
        <p class=P7>&nbsp;</p></td></tr><tr class=Tabela31>
        <td style=text-align:left;width:9.712cm;  class=Tabela3_A2>
        <p class=P14><span class=T1>4. Disponibilidade (tempo parcial / integral)</span></p></td>
        <td style=text-align:left;width:2.54cm;  class=Tabela3_A2>
        <p class=P11><span class=T1>At&eacute; 2,0</span></p></td>
        <td style=text-align:left;width:3.179cm;  class=Tabela3_C2>
        <p class=P1>&nbsp;</p></td></tr>
        <tr class=Tabela31><td style=text-align:left;width:9.712cm;  class=Tabela3_A2>
        <p class=P14><span class=T1>5. Avalia&ccedil;&atilde;o geral</span></p></td>
        <td style=text-align:left;width:2.54cm;  class=Tabela3_A2>
        <p class=P11><span class=T1>At&eacute; 3,0</span></p></td>
        <td style=text-align:left;width:3.179cm;  class=Tabela3_C2><p class=P1>&nbsp;</p></td></tr>
        <tr class=Tabela31>
        <td colspan=3 style=text-align:left;width:9.712cm;  class=Tabela3_A7>
        <p class=P9>OBSERVA&Ccedil;&Otilde;ES:</p></td></tr><tr class=Tabela38><td colspan=3 style=text-align:left;width:9.712cm;  class=Tabela3_C2>
        <p class=P3>&nbsp;</p></td></tr><tr class=Tabela39>
        <td colspan=3 style=text-align:left;width:9.712cm;  class=Tabela3_C2>
        <p class=P3>&nbsp;</p></td></tr><tr class=Tabela310>
        <td colspan=3 style=text-align:left;width:9.712cm;  class=Tabela3_C2>
        <p class=P3>&nbsp;</p></td></tr><tr class=Tabela311>
        <td colspan=3 style=text-align:left;width:9.712cm;  class=Tabela3_C2>
        <p class=P10>&nbsp;</p></td></tr><tr class=Tabela312>
        <td colspan=3 style=text-align:left;width:9.712cm;  class=Tabela3_C2>
        <p class=P3>&nbsp;</p></td></tr>
        <tr class=Tabela313><td colspan=3 style=text-align:left;width:9.712cm;  class=Tabela3_C2>
        <p class=P3>&nbsp;</p></td></tr>
        <tr class=Tabela314><td colspan=3 style=text-align:left;width:9.712cm;  class=Tabela3_C2>
        <p class=P1>&nbsp;</p></td></tr>
        <tr class=Tabela31><td style=text-align:left;width:9.712cm;  class=Tabela3_A2>
        <p class=P9>&nbsp;</p><p class=P15><span class=T1>TOTAL OBTIDO</span></p></td>
        <td style=text-align:left;width:2.54cm;  class=Tabela3_A2>
        <p class=P7>&nbsp;</p>
        <p class=P8>At&eacute; 10,0</p></td>
        <td style=text-align:left;width:3.179cm;  class=Tabela3_C2>
        <p class=P1>&nbsp;</p></td></tr>
        </tbody>
        </table>
        <p class=P4>&nbsp;</p>
        <p class=P4>&nbsp;</p>
        <p class=P5>&nbsp;</p>
        <p class=P5>&nbsp;</p>
        <p class=P19><span class=T3>
        ___________________________ <br>
        $newOrientador, <br>
        Examinador.</span></p>
        </body>
        </html>
";

$mpdf = new mPDF('c', 'A4', '', '', 32, 25, 27, 25, 16, 13);

$mpdf->SetDisplayMode('fullpage');

$mpdf->list_indent_first_level = 0;  // 1 or 0 - whether to indent the first level of a list
$stylesheet = file_get_contents('bootstrap/css/estilo1.css');
$mpdf->WriteHTML($stylesheet, 1); // The parameter 1 tells that this is css/style only and no body/html/text
//$mpdf->WriteHTML($texto1);
//$mpdf->WriteHTML($texto2);
$mpdf->ignore_invalid_utf8 = true;
$texto1 = utf8_encode($texto);
$mpdf->WriteHTML($texto1);

$mpdf->Output('Entrevista.pdf', 'D');
?>