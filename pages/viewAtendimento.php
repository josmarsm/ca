<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$idAtendimento = $_GET['idAtendimento'];
$atendimentoFind = readFind("select * from atendimentos where idAtendimento='$idAtendimento'");
$row = 0;
foreach ($atendimentoFind as $atendimento):
    $idAtendimento = $atendimento->idAtendimento;
    $titulo = $atendimento->titulo;
    $status = $atendimento->status;
    $descricao = $atendimento->descricao;
    $dataCriacao = $atendimento->dataCriacao;
endforeach;
?>


<div class="ocorrencia">
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="title-block clearfix">
                <h3 class="h3-body-title uny">
                    Informações do Atendimento nº <?php echo $idAtendimento; ?>
                </h3>

                <div class="title-seperator"></div>
            </div>
        </div>

        <div class="form-group clearfix">
            <div class="col-md-6">
                <label class="control-label" for="name">Título *:</label>
                <input value="<?php echo $titulo; ?>" class="form-control" disabled="disabled" type="text">
            </div>
            <div class="col-md-6">
                <label class="control-label" for="cb_id_categoriaocorrencia">Situação *:</label>
                <!-- type email used by jquery validate -->
                <input class="form-control" disabled="disabled" value="<?php echo $status; ?>" type="text">
            </div>
        </div>

        <div class="form-group clearfix">
            <div class="col-md-12">
                <label class="control-label" for="st_ocorrencia">Descrição:</label>
                <!-- type email used by jquery validate -->
                <textarea rows="8" cols="100%" name="st_ocorrencia" id="st_ocorrencia" class="form-control" disabled="disabled">
                    <?php echo $descricao; ?>
                </textarea>
            </div>
        </div>
        <div class="form-group clearfix">
            <div class="col-md-6">
                <label class="control-label" for="cb_id_saladeaula">Evolução:</label>
                <input disabled="disabled" value="Aguardando Interessado" class="form-control" type="text">
            </div>
            <div class="col-md-6">
                <label class="control-label" for="cb_id_saladeaula">Responsável:</label>
                <input disabled="disabled" value="MAGDA VIRGINIA DA COSTA VALE" class="form-control" type="text">
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
        <a data-toggle="modal" data-target="#interacao" class="btn btn-primary btn-lg">Nova Interação</a>
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
<div id="interacao" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Header</h4>
            </div>
            <form>
                <div class="modal-body">
                    <fieldset class="form-group">
                        <label for="exampleTextarea">Example textarea</label>
                        <textarea class="form-control" id="exampleTextarea" rows="3"></textarea>
                    </fieldset>
                </div>   
                <fieldset class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <input type="file" class="form-control-file" id="exampleInputFile">
                    <small class="text-muted">This is some placeholder block-level help text for the above input. It's a bit lighter and easily wraps to a new line.</small>
                </fieldset> 
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    
                </div>
            </form>
        </div>

    </div>
</div>