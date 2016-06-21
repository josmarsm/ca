<script type="text/javascript" src="http://www.geradorcpf.com/jquery-1.2.6.pack.js"></script>
<script type="text/javascript" src="http://www.geradorcpf.com/jquery.maskedinput-1.1.4.pack.js"/></script>

<script type="text/javascript">
// jquery para chamar a modal
    $("table").on('click', ".atendimento", function () {
        var idCliente = $(this).attr('idCliente');  // pega o id do botão

        $.post('modal.php', {acao: 'cadastrarAtendimento', idCliente: idCliente}, function (retorno) {
            $("#modalForm").modal({backdrop: 'static'});
            $("#modalBody").html(retorno);
        });
    });
</script>

<script type="text/javascript">
// jquery para chamar a modal
    $("table").on('click', ".interacao", function () {
        var idAtendimento = $(this).attr('idAtendimento');  // pega o id do botão

        $.post('interacao.php', {$acaoInteracao: 'cadastrarInteracao', idAtendimento: idAtendimento}, function (retorno) {
            $("#modalForm1").modal({backdrop: 'static'});
            $("#modalBody1").html(retorno);
        });
    });
</script>

<!--Inicio do contúdo-->

<?php
echo 'Método POST' . var_dump($_POST) . '</br>';
echo 'Método GET' . var_dump($_GET) . '</br>';
?>
<br/><br/><br/>
<?php
$acao = $_REQUEST['acao'];

switch ($acao) {
    case 'viewAtendimentos':
        echo 'Lista os atendimentos realizados para a matricula <br>';
        paginaConsulta();
        viewAtendimentos();
        break;
    case 'newAtendimento':
        echo 'Cadastra novo atendimento para matricula';
        break;
    case 'newInteracao':
        echo 'Cadastra novaInteracao para a matricula';
        break;
    case 'inserirAtendimento';
        echo 'Insere o atendimento no banco de dados';
        inserirAtendimento();
    default:
        echo "Abre página para consulta <br/>";
        paginaConsulta();
        break;
}

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if (isset($_GET['cliente'])):
            $cliente = $_GET['cliente'];
            //echo 'Variável cliente iniciada, realiza consulta do cliente informado <br/>';
            $clienteFind = readFind("select * from clientes where idCliente='$cliente'");
            $row = 0;
            foreach ($clienteFind as $cliente):
                $row++;
            endforeach;
            $idCliente = $cliente->idCliente;
            $nomePessoa = $cliente->nomePessoa;
        //echo "o nome do cliente encontrado e:" . $nomePessoa . '<br/>';
        //echo "numero de linhas e:" . $row . '<br/>';
        else:
            //echo 'Variável cliente não iniciada, abre a tela de consulta em branco <br/>';
            $row = 2;
        endif;
        break;
    default:
}
?>
<!-- Incio Secao de consulta -->
<?php

function paginaConsulta() {
    ?>
    <div id="mensgem" class="row">    
        <h3 style="alignment-adjust: central">
            Bem vindo a Secretaria Integrada do Centro de Tecnologia para realizar o atendimento informe a MATRICULA 
        </h3>
    </div>
    <br/>
    <div id="pesquisa" class="row">
        <div class="col-md-3">
            <h3></h3>
        </div>
        <form action="?p=modal" role="form" method="post">
            <div class="col-md-6">
                <div class="input-group h2">
                    <input id="acao" type="hidden" name="acao" value="viewAtendimentos"> 
                    <input type="text" id="matricula" name="matricula" class="form-control" autofocus/>                     
                    <span class="input-group-btn">
                        <button id="pesquisa" class="btn btn-primary" type="submit">
                            <span class="glyphicon glyphicon-search"> Pesquisar</span>
                        </button>
                    </span>

                </div>
            </div>
        </form>
    </div>
    <?php
}
?>
<!-- Fim Secao de consulta -->

<!-- Inicio viewAtendimentos -->
<?php

function viewAtendimentos() {
    $matricula = $_REQUEST['matricula'];
    $clienteFind = readFind("select * from clientes where matricula='$matricula'");
    $row = 0;
    foreach ($clienteFind as $cliente):
        $row++;
    endforeach;
    if ($row > 0):
        $idCliente = $cliente->idCliente;
        $nomePessoa = $cliente->nomePessoa;
        echo "O idCliente do cliente encontrado e:" . $idCliente . '<br/>';
        echo "O nome do cliente encontrado e:" . $nomePessoa . '<br/>';
        echo "numero de linhas e:" . $row . '<br/>';
    endif;

    switch ($row) {
        case '0':
            novaMatricula();
            break;
        case '1':
            //echo 'a variavel row é:' . $row . '<br/>';
            ?>
            <h2>Relacao de atendimentos para <?php echo $nomePessoa; ?></h2>
            <a data-toggle="modal" href="#newAtendimento<?php
            echo $idCliente;
            $acao = 'cadastrarAtendimento'
            ?>" class="atendimento btn btn-primary">Novo atendimento</a><br/>
            <br/>
            <br/>
            <!-- Inicio Modal newAtendimento -->

            <div class="modal fade" id="newAtendimento<?php
            echo $idCliente;
            $acao = 'cadastrarAtendimento'
            ?>">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title">Novo atendimento para <?php echo $nomePessoa; ?></h4>
                        </div>
                        <div class="container"></div>
                        <div class="modal-body">
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
                                    <form class="form-wrapper uny ocorrencia" name="frmOcorrencia" enctype="multipart/form-data" action="?p=modal&acao=inserirAtendimento" method="post" role="form" novalidate="novalidate">

                                        <input id="idCliente" type="hidden" name="idCliente" value="<?php echo $idCliente; ?>">           
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
                                    echo "A ação escolhida foi: " . $acao . "<br/>";
                                    $usuario = $_SESSION['id'];
                                    $cliente = $_POST['idCliente'];
                                    $tipo = $_POST['tipo'];
                                    $assunto = $_POST['assunto'];
                                    $titulo = $_POST['titulo'];
                                    $descricao = $_POST['descricao'];

                                    date_default_timezone_set('America/Sao_Paulo');
                                    $dataCriacao = date('Y-m-d');

                                    $status = '1';

                                    echo $usuario . "<br/>";
                                    echo $cliente . "<br/>";
                                    echo $tipo . "<br/>";
                                    echo $assunto . "<br/>";
                                    echo $titulo . "<br/>";
                                    echo $descricao . "<br/>";
                                    echo $dataCriacao . "<br/>";
                                    echo $status . "<br/>";

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
                                    //echo "<meta HTTP-EQUIV='Refresh' CONTENT='xsegundos; URL=../pages/template.php?page2&cliente=$cliente'>";
                                    break;
                                default:
                                    echo "Nenhuma ação foi definida <br/>";
                                    break;
                            }
                            ?>
                            <br>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Fim Modal newAtendimento -->
            <div id="lista" class="row">

                <div class="table-striped col-md-12">
                    <table class="table table-striped" cellspacing="0" cellpadding="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Titulo</th>
                                <th>Status</th>
                                <th>Criado em</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $atendimentoFind = readFind("select * from atendimentos where cliente='$idCliente' order by status, dataCriacao DESC");
                            $row = 0;
                            foreach ($atendimentoFind as $atendimento):
                                $idAtendimento = $atendimento->idAtendimento;
                                $titulo = $atendimento->titulo;
                                $status = $atendimento->status;
                                $dataCriacao = $atendimento->dataCriacao;
                                ?>
                                <tr>
                                    <td><?php echo $idAtendimento; ?></td>
                                    <td><?php echo $titulo; ?></td>
                                    <td><?php echo $status; ?></td>
                                    <td><?php echo $dataCriacao; ?></td>
                                    <td>
                                        <a data-toggle="modal" href="#Interacao<?php echo $idAtendimento; ?>" class="btn btn-primary">Vizualisar</a>
                                    </td>

                                    <!-- Fim Modal Interacao -->
                            <div class="modal fade" id="Interacao<?php echo $idAtendimento; ?>">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title">Interacoes para o atendimento XX</h4>
                                        </div>
                                        <div class="container"></div>
                                        <div class="modal-body">
                                            O atendimento XX tem as seguintes interacoes<br/>
                                            No dia tal foi realizado XXX por XXX<br/>
                                            No dia tal foi realizado XXX por XXX<br/>
                                            <br>	
                                            <a data-toggle="modal" href="#newInteracao" class="btn btn-primary">Nova Interacao</a>
                                            <a data-toggle="modal" href="#closeAtendimento" class="btn btn-primary">Encerrar Atendimento</a>
                                        </div>
                                        <div class="modal-footer">	
                                            <a href="#" data-dismiss="modal" class="btn">Sair</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Fim Modal Interacao -->

                            <?php
                        endforeach;
                        ?>
                        </tbody>
                    </table>





                    <!-- Inicio Modal newInteracao -->
                    <div class="modal fade" id="newInteracao">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title">Cadastro de Nova interacao</h4>
                                </div>
                                <div class="container"></div>
                                <div class="modal-body">
                                    Para uma nova interacao insira as informacoes abaixo.<br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                </div>
                                <div class="modal-footer">	
                                    <a href="#" data-dismiss="modal" class="btn">Sair</a>
                                    <a href="#" class="btn btn-primary">Salvar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Fim Modal newInteracao -->

                    <!-- Inicio Modal closeAtendimento -->
                    <div class="modal fade" id="closeAtendimento">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title">Encerramento de Atendimento</h4>
                                </div>
                                <div class="container"></div>
                                <div class="modal-body">
                                    Para o encerramento insira as informacoes abaixo<br>
                                    <br>
                                    <br>
                                    <br>                            
                                </div>
                                <div class="modal-footer">	
                                    <a href="#" data-dismiss="modal" class="btn">Sair</a>
                                    <a href="#" class="btn btn-primary">Salvar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Fim Modal closeAtendimento -->
                    <?php
                    break;
                default :
                //echo 'a variavel row é:' . $row . '<br/>';
            }
            exit;
        }

        function novaMatricula() {
            echo "
        Matricula nao encontrada
        <br/>
        <a href='?p=add_CPF' class='btn btn-primary pull-center h2'>Incluir nova Matricula</a>
        ";
        }

        function inserirAtendimento() {
            $usuario = $_SESSION['id'];
            $cliente = $_POST['idCliente'];
            $tipo = $_POST['tipo'];
            $assunto = $_POST['assunto'];
            $titulo = $_POST['titulo'];
            $descricao = $_POST['descricao'];

            date_default_timezone_set('America/Sao_Paulo');
            $dataCriacao = date('Y-m-d');

            $status = '1';

            echo $usuario . "<br/>";
            echo $cliente . "<br/>";
            echo $tipo . "<br/>";
            echo $assunto . "<br/>";
            echo $titulo . "<br/>";
            echo $descricao . "<br/>";
            echo $dataCriacao . "<br/>";
            echo $status . "<br/>";

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
            //header('location:../pages/template.php?modal&cliente=$cliente&acao=viewAtendimentos');
            //exit;
            //echo "<meta HTTP-EQUIV='Refresh' CONTENT='xsegundos; URL=../pages/template.php?page2&cliente=$cliente&acao=viewAtendimentos'>";
        }
        ?>