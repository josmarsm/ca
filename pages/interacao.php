<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (empty($_GET['acaoInteracao'])):
    $$acaoInteracao = filter_input(INPUT_POST, 'acaoInteracao', FILTER_SANITIZE_STRING);  // recebe o parametro vindo do post do jquery
else:
    $acaoInteracao = $_GET['acaoInteracao'];
endif;

switch ($acaoInteracao) {
    case 'cadastrarInteracao':
        //echo 'acao cadastrar';
        $$idAtendimento = filter_input(INPUT_POST, 'idAtendimento', FILTER_SANITIZE_NUMBER_INT);  // recebe o parametro vindo do post do jquery
        //echo 'A variavel idAtendimento e: '.var_dump($idAtendimento);
//$idAtendimento = $_GET['idAtendimento'];
        $atendimentoFind = readFind("select * from atendimentos where idAtendimento='$idAtendimento'");
        //var_dump($atendimentoFind);
        $row = 0;
        foreach ($atendimentoFind as $atendimento):
            $idAtendimento = $atendimento->idAtendimento;
            $titulo = $atendimento->titulo;
            $status = $atendimento->status;
            $descricao = $atendimento->descricao;
            $dataCriacao = $atendimento->dataCriacao;
        endforeach;
        //echo 'variavel descricao' . $descricao;
        ?>
        <div class="ocorrencia">
            <div class="row clearfix">
                <div class="col-md-12">

                </div>

                <div class="form-group clearfix">
                    <div class="col-md-6">
                        <label class="control-label" for="name">Título:</label> <?php echo $titulo; ?>
                    </div> 
                    <div class="col-md-6">
                        <label class="control-label" for="cb_id_categoriaocorrencia">Situação:</label> <?php echo $status; ?>
                    </div>
                    <div class="col-md-12">
                        <label class="control-label" for="st_ocorrencia">Descrição:</label> <?php echo $descricao; ?>
                    </div>
                    <div class="col-md-6">
                        <label class="control-label" for="cb_id_saladeaula">Evolução:</label> Aguardando Interessado
                    </div>
                    <div class="col-md-6">
                        <label class="control-label" for="cb_id_saladeaula">Responsável:</label> MAGDA VIRGINIA DA COSTA VALE
                    </div>
                </div>
            </div>    
        </div>
        <div class="row clearfix">
            <div class="col-md-12">
                <div class="title-block clearfix">
                    <h3 class="h3-body-title uny">Interações para esse atendimento</h3>
                    <div class="title-seperator"></div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-md-12 interacoes">
                <a data-toggle="modal" data-target="#nova-interacao" class="btn btn-primary btn-lg">Nova Interação</a>
                <a class="btn btn-primary btn-lg" data-id-evolucao="36" data-id-situacao="99">Encerrar Atendimento</a>
            </div>
        </div>
        <br/>
        <div class="panel panel-default">
            <div class="panel-body">
                Prezado(a) Josmar, boa tarde. Primeiramente, agradecemos seu contato! Encaminhamos sua mensagem ao setor responsável e informamos que brevemente sua solicitação será respondida. Orientamos o acompanhamento às ocorrências protocoladas na ferramenta SERVIÇO DE ATENÇÃO, visto que as tratativas e retornos serão dados dentro da própria ocorrência, não havendo contato via e-mail. Reiteramos nossa disposição para o que se fizer necessário. Cordialmente, EQUIPE SAA. IMPORTANTE: Todas as orientações pertinentes aos processos relacionados ao seu curso: provas presenciais, declarações, certificados, lançamento de notas, bem como todos os prazos para tramitação desses processos, se encontram no MANUAL DO ALUNO em sua plataforma virtual de ensino.
            </div>
            <div class="panel-footer">Data | Usuario</div>
        </div>
        <br/>
        <div class="panel panel-default">
            <div class="panel-body">
                Prezado(a) Josmar, boa tarde. Primeiramente, agradecemos seu contato! Encaminhamos sua mensagem ao setor responsável e informamos que brevemente sua solicitação será respondida. Orientamos o acompanhamento às ocorrências protocoladas na ferramenta SERVIÇO DE ATENÇÃO, visto que as tratativas e retornos serão dados dentro da própria ocorrência, não havendo contato via e-mail. Reiteramos nossa disposição para o que se fizer necessário. Cordialmente, EQUIPE SAA. IMPORTANTE: Todas as orientações pertinentes aos processos relacionados ao seu curso: provas presenciais, declarações, certificados, lançamento de notas, bem como todos os prazos para tramitação desses processos, se encontram no MANUAL DO ALUNO em sua plataforma virtual de ensino.
            </div>
            <div class="panel-footer">Data | Usuario</div>
        </div>
        <div class="row clearfix">
            <div class="col-md-12 interacoes">
                <a data-toggle="modal" data-target="#nova-interacao" class="btn btn-primary btn-lg">Nova Interação</a>
                <a class="btn btn-primary btn-lg" data-id-evolucao="36" data-id-situacao="99">Encerrar Atendimento</a>
            </div>
        </div>

        <!-- Modal -->
            <div class="modal fade" id="nova-interacao">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title">Modal 4</h4>

                        </div>
                        <div class="container"></div>
                        <div class="modal-body">Content for the dialog / modal goes here.</div>
                        <div class="modal-footer">	
                            <a href="#" data-dismiss="modal" class="btn">Close</a>
                            <a href="#" class="btn btn-primary">Save changes</a>

                        </div>
                    </div>
                </div>
            </div>
        <?php
        break;
    case 'inserir';
        echo 'acao inserir';
        break;
    default:
        echo "Nenhuma ação foi definida <br/>";
        break;
}
?>
