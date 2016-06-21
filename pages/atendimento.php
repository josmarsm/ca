<?php
if (empty($_GET['acao'])):
    $$acao = filter_input(INPUT_POST, 'acao', FILTER_SANITIZE_STRING);  // recebe o parametro vindo do post do jquery
else:
    $acao = $_GET['acao'];
endif;

switch ($acao) {
    case 'cadastrarAtendimento':
        //echo "A ação escolhida foi: " . $acao . "<br/>";
        $$idCliente = filter_input(INPUT_POST, 'idCliente', FILTER_SANITIZE_NUMBER_INT);  // recebe o parametro vindo do post do jquery
        //echo "O id é igual a: " . $idCliente . "<br/    >";
        //;
        $clienteFind = readFind("select * from clientes where idCliente='$idCliente'");
        $row = 0;
        foreach ($clienteFind as $cliente):
            $row++;
        endforeach;
        $nomePessoa = $cliente->nomePessoa;
        ?>

        <form class="form-wrapper uny ocorrencia" name="frmOcorrencia" enctype="multipart/form-data" action="?p=atendimento&acao=inserirAtendimento" method="post" role="form" novalidate="novalidate">

            <input id="idCliente" type="hidden" name="idCliente" value="<?php echo $idCliente; ?>">            
            <div class="title-block clearfix">
                <h4 class="h4-body-title uny">Novo atendimento para <b><?php echo $nomePessoa; ?></b></h4>
                <br/><br/>
                <div class="title-seperator"></div>
            </div>

            <div class="form-group clearfix">       
                <div class="col-md-6">
                    <label class="control-label" for="tipo">Tipo *:</label>
                    <select name="tipo" id="tipo" class="form-control" required="">
                        <option value="">Selecione um tipo...</option>
                        <option value="1">Solicitação</option>
                        <option value="2">Reclamação</option>
                        <option value="3">Dúvida</option>
                        <option value="4">Sugestão</option>
                        <option value="5">Outros</option>
                        <option value="6">Elogio</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="assunto">Assunto *:</label>
                    <select name="assunto" id="assunto" class="form-control" required="">
                        <option value="">Selecione um assunto...</option>
                        <option value="6">APROVEITAMENTO DE DISCIPLINAS</option>
                        <option value="542">CANCELAMENTO DE CURSO - encerramento do vínculo</option>
                        <option value="7">CANCELAMENTO DE MATRÍCULA</option>
                        <option value="4">CENTRAL DE INFORMAÇÕES E MATRÍCULAS</option>
                        <option value="9">CERTIFICAÇÃO</option>
                        <option value="19">CONTRATO</option>
                        <option value="11">COORDENADOR</option>
                        <option value="12">DECLARAÇÕES</option>
                        <option value="309">DOCUMENTAÇÃO</option>
                        <option value="13">DÚVIDAS SOBRE AMBIENTAÇÃO</option>
                        <option value="10">FINANCEIRO</option>
                        <option value="45">INFORMAÇÕES SOBRE TROCA DE CURSO</option>
                        <option value="14">MATERIAL</option>
                        <option value="17">PENDÊNCIAS ACADÊMICAS (DISCIPLINAS/TCC)</option>
                        <option value="15">PROVAS</option>
                        <option value="18">RECIBO</option>
                        <option value="20">RETORNO AOS ESTUDOS</option>
                        <option value="5">SUPORTE</option>
                        <option value="543">TRANCAMENTO DE CURSO - suspensão temporária</option>
                        <option value="8">TRANCAMENTO DE MATRÍCULA</option>
                    </select>
                </div>
            </div>
            <div class="form-group clearfix">
                <div class="col-md-12">
                    <label class="control-label" for="name">Título *:</label>
                    <input type="text" id="titulo" name="titulo" class="form-control" required="">
                </div>        
            </div>

            <div class="form-group clearfix">
                <div class="col-md-12">
                    <label class="control-label" for="descricao">Descrição *:</label>
                    <!-- type email used by jquery validate -->
                    <textarea rows="8" cols="100%" name="descricao" id="descricao" class="form-control" required=""></textarea>
                </div>
            </div>
            <div class="form-group clearfix">
                <div class="col-xs-12">
                    <label for="anexo">Anexo:</label>
                    <input type="file" name="anexo" id="anexo">
                </div>
            </div>
            <div class="form-group clearfix">
                <div class="col-md-8">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary" value="Submit">Salvar Atendimento</button>
                </div>
            </div>
        </form>
        <?php
        break;
    case 'inserirAtendimento':
        //echo "A ação escolhida foi: " . $acao . "<br/>";
        $usuario = $_SESSION['id'];
        $cliente = $_POST['idCliente'];
        $tipo = $_POST['tipo'];
        $assunto = $_POST['assunto'];
        $titulo = $_POST['titulo'];
        $descricao = $_POST['descricao'];

        date_default_timezone_set('America/Sao_Paulo');
        $dataCriacao = date('Y-m-d');

        $status = '1';

//echo $usuario. "<br/>";
//echo $cliente. "<br/>";
//echo $tipo. "<br/>";
//echo $assunto. "<br/>";
//echo $titulo. "<br/>";
//echo $descricao. "<br/>";
//echo $dataCriacao. "<br/>";
//echo $status. "<br/>";

        $attributes = [
            'usuario' => $usuario,
            'cliente' => $cliente,
            'tipo' => $tipo,
            'assunto' => $assunto,
            'titulo' => $titulo,
            'descricao' => $descricao,
            'dataCriacao' => $dataCriacao,
            'status' => $status
        ];

        $atendimentoAdd = insert('atendimentos', $attributes);
//header('location:../pages/template.php?page2&cliente=$cliente');
//exit;
        echo "<meta HTTP-EQUIV='Refresh' CONTENT='xsegundos; URL=../pages/template.php?page2&cliente=$cliente'>";
        break;
    default:
        echo "Nenhuma ação foi definida <br/>";
        break;
}
?>