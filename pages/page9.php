<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <!--Inicio do contúdo-->
                <?php
                require_once '../classes/config.php';

                $usuario = $_SESSION['id'];
// e$ndif;
//echo $usuario;

                $usuarioFind = readFind("select * from usuarios where id='$usuario'");
//var_dump($usuarioFind);
                foreach ($usuarioFind as $usuario):
                    $usuario->nome;
                endforeach;
                $newID = $usuario->id;
                $newNivel = $usuario->nivel;
                $newUsuario = $usuario->nome;
                $newID;
                $newNivel;
                $newUsuario;
                ?>
                <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
                <link href="assets/css/custom.css" rel="stylesheet" type="text/css">
                <br>
                <center>
                    <h1>Quadro de Notas</h1>   
                </center> 
                <table class='table table-bordered table-responsive'>
                    <tr>
                        <th>Inscrição</th>
                        <th>Nome</th>
                        <th>POSCOMP</th>
                        <th>Nota POSCOMP</th>
                        <th>Eliminatória</th>
                        <th>Prova</th>
                        <th>Entrevista</th>
                        <th>Nota Final</th>
                        <th>Situação</th>
                    </tr>

                    <?php
                    //var_dump($newID);
                    $candidatosSelecionados = readFind("SELECT candidatos.*, usuarios.id, usuarios.nome "
                            . "FROM candidatos INNER JOIN usuarios ON candidatos.Orientador1 = usuarios.id "
                            . "WHERE Fase2 ='S' AND (((usuarios.id)='$newID'))");
                    //var_dump($candidatosSelecionados);
                    foreach ($candidatosSelecionados as $candidato):
                        //$total_LPBD++;
                        $newInscricao = $candidato->Inscricao;
                        $newNome = $candidato->Nome;
                        $newOrientador = $candidato->Orientador1;
                        $Poscomp = $candidato->Poscomp;
                        $newNotaPoscomp = $candidato->NotaPoscomp;
                        $newAno = $candidato->AnoPoscomp;
                        $newNotaEliminatoria = $candidato->NotaEliminatoria;
                        $newNotaEntrevista = $candidato->NotaEntrevista;
                        $ProvaEscrita = $candidato->NotaProvaEscrita;

                        /*
                          while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {

                          $newInscricao = $linha['Inscricao'];
                          $newNome = $linha['Nome'];
                          $newOrientador = $linha['Orientador1'];
                          $Poscomp = $linha['Poscomp'];
                          $newNotaPoscomp = $linha['NotaPoscomp'];
                          $newAno = $linha['AnoPoscomp'];
                          $newNotaEliminatoria = $linha['NotaEliminatoria'];
                          $newNotaEntrevista = $linha['NotaEntrevista'];
                          $ProvaEscrita = $linha['NotaProvaEscrita'];
                         */
                        /*
                         * Em função da possibilidade de utilização da nota do POSCOMP em substituição a prova faz
                         * necessário a utilização de calculo para conversão da mesma utilizando-se da seguinte
                         * formula = Nescrita = 8,0 + (Nposcomp - Mano) x 0,3
                         */
                        //echo "Utilização do poscomp " . $newPoscomp . "<br>";
                        if ($Poscomp == 'S'):
                            //echo "precisa calcular a nota<br>";
                            /* Busca a media do poscomp
                             *
                             */
                            $mediaPoscomp = readFind("SELECT * FROM mediaposcomp WHERE Ano ='$newAno'");
                            //$consulta1 = $DB_con->query("SELECT * FROM mediaposcomp WHERE Ano ='$newAno'");
                            foreach ($mediaPoscomp as $media):
                                $Media = $media->Media;
                                //echo $Media;
                            endforeach;

                            //while ($linha1 = $consulta1->fetch(PDO::FETCH_ASSOC)) {
                            //      $newPoscomp = "";
                            //    $Media = $linha1['Media'];
                            //}
                            //echo "Média do POSCOMP do ano " . $newAno . " = " . $Media . "<br>";
                            if ($newAno == 0):
                                $newPoscomp = "-";
                            else:
                                $newPoscomp = $newAno . " - " . $Media;
                            endif;


                            /* conversão da nota do poscomp em nota da prova escrita
                             *
                             */
                            (($newNotaPoscomp - $Media) * 0.3);
                            $Nescrita = 8 + (($newNotaPoscomp - $Media) * 0.3);
                            //echo "$Nescrita";
                            if ($Nescrita > 10):
                                $newNotaProvaEscrita = 10;
                            elseif ($Nescrita < 0):
                                $newNotaProvaEscrita = 0;
                            else:
                                $newNotaProvaEscrita = $Nescrita;
                            endif;

                        else:
                            $newPoscomp = "-";
                            $newNotaProvaEscrita = $candidato->NotaProvaEscrita;
                        //echo "Utiliza a nota do banco de dados " . $newNotaProvaEscrita . "<br>";
                        endif;

                        //Estabelece a nota final
                        $NotaFinal = (($newNotaEliminatoria * 0.4) + ((($newNotaProvaEscrita * 0.5) + ($newNotaEntrevista * 0.5)) * 0.6));
                        $newNotaFinal = round($NotaFinal, 2);

                        //Estabelece a situação
                        if (($newNotaEliminatoria == Null) or ($newNotaProvaEscrita == Null) or ($newNotaEntrevista == Null)) {
                            $newSituacao = "<font color = '#FFBF00'>Notas incompletas</font>";
                        } else {
                            if ($newNotaFinal < 7):
                                $newSituacao = "<font color = '#FF0000'>Reprovado</font>";
                            else:
                                $newSituacao = "<font color = '#04B404'>Aprovado</font>";
                            endif;
                        }



                        //echo "-----------------------------------------------------------------------------------------------<br><br>";

                        echo "
        <tr>
            <td>$newInscricao</td>
            <td>$newNome</td>
            <td>$newPoscomp</td>
            <td>$newNotaPoscomp</td>
            <td>$newNotaEliminatoria</td>
            <td>";
                        if ($Poscomp == 'S'):
                            echo $newNotaProvaEscrita;
                            else:
                            echo $newNotaProvaEscrita."-";
                        endif;

                        "</td>
                    <td>$newNotaEntrevista</td>
                    <td>$newNotaFinal</td>
                    <td>$newSituacao</td>
                    </tr>
                    ";
                    endforeach;
                    ?>
                </table>
                <!--Fim do contúdo-->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->