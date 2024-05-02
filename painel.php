<?php
    include('proteger.php');
    
    include('conexao.php');
    $id_docente = $_SESSION['id_docente'];
    $codigo_carreira= "select * from tbl_carreira WHERE cod_docente = ".$id_docente;
    $exec_codigo_carreira = mysqli_query($conexao, $codigo_carreira);
    
    $intersticio = [];
    $a = 0;
    while($dados_carreira = mysqli_fetch_assoc($exec_codigo_carreira)){
        $intersticio[$a] = $dados_carreira['cod_intersticio'];
        $a++;}
    
    
        
        $codigo_pontuacao = "select pontuacao_docente, total_docente from tbl_intersticio_apendice where cod_intersticio = ".$intersticio[0];
        $exec_codigo_pontuacao = mysqli_query($conexao, $codigo_pontuacao);
        $dados_pontuacao = mysqli_fetch_assoc($exec_codigo_pontuacao);
        // echo $dados_pontuacao['total_docente'];
        // echo $dados_pontuacao['pontuacao_docente'];
        if (empty($dados_pontuacao['total_docente'])){
            
            $pontuacao = false;
        }else{
                $pontuacao = true;        
             }
?>
<?php
    if (isset($_POST['salvar'])){
        $id_intersticio = $_POST['intersticio'];
                        if (empty($dados_pontuacao['total_docente'])){
                            $pontuacao = false;
                            $pontos = [];
                            $pontos_somados = 0;
                         
                            for($i=1 ; $i<=16; $i++){
                             $pontos[$i] = $_POST['ponto'.$i];
                             $pontos_somados = $pontos_somados + $pontos[$i];
                            }
                            echo '<p>'.$pontos_somados.'</p>';
                            //codigo para inserir a pontuacao
                            $id_intersticio = $_POST['intersticio'];
                            $_SESSION['id_intersticio'] = $id_intersticio;
                            //se tiver pontuação: UPDATE. Se não, é INSERT
                            if (mysqli_num_rows($exec_codigo_pontuacao) != NULL){
                             $codigo_update = "update tbl_intersticio_apendice SET pontuacao_docente=$pontos_somados WHERE cod_intersticio = $id_intersticio;";
                             $exec_codigo_update = mysqli_query($conexao, $codigo_update);
                             echo "Pontuação Salva Com sucesso!";
                            } else{
                             $codigo_insert = "insert into tbl_intersticio_apendice (cod_intersticio, cod_apendice, pontuacao_docente) VALUES (".$intersticio[0].",1,$pontos_somados)";
                             $exec_codigo_insert = mysqli_query($conexao,$codigo_insert);
                             echo "Pontuacao Salva com sucesso";
                            }
                            //ENVIO DE ARQUIVO
                            if(isset($_FILES['file'])){
                             $arquivo = $_FILES['file'];
                         // Informações sobre o arquivo
                         $nome_arquivo = $arquivo['name'];
                         $tamanho_arquivo = $arquivo['size'];
                         $caminho_temporario = $arquivo['tmp_name'];
                         $erro_arquivo = $arquivo['error'];
                         $extensao= strtolower(pathinfo($nome_arquivo, PATHINFO_EXTENSION));
                         // Diretório de destino para o upload
                         $diretorio_destino = 'uploads/';
                         $novo_nome_arquivo = uniqid();
                         $path = $diretorio_destino . $novo_nome_arquivo . "." . $extensao;
                         // Move o arquivo para o diretório de destino se for pdf
                         if ($extensao == 'pdf'){
                         $deu_certo=move_uploaded_file($caminho_temporario, $path);
                             if ($deu_certo){
                                 //codigo sql
                                 $id_intersticio = $_SESSION['id_intersticio'];
                     
                     
                                 $codigo_sql_arquivos = "update `tbl_intersticio_apendice` set `nome_arquivo`='$nome_arquivo',`path`='$path' WHERE cod_intersticio = $id_intersticio";
                                 //executar o codigo
                                 mysqli_query($conexao, $codigo_sql_arquivos);
                                 echo "Upload bem-sucedido! O arquivo foi salvo em: " . $diretorio_destino . $nome_arquivo;
                                 echo "<br><a href = 'uploads/$novo_nome_arquivo.$extensao'>Clique aqui para acessa-lo</a>";
                             
                             }else{
                                 echo "Falha ao enviar o arquivo";
                             }
                     
                         }else{
                             echo "Aceitamos apenas arquivos em pdf!!!";
                         }
                            }
                         }else{
                            echo "nao não é possivel mais enviar os dados";
                         }
                                             }
                            
                     //-----------------------------------------------------------------------------------------
                            if(isset($_POST['enviar'])){
                             $id_intersticio = $_POST['intersticio'];
                                             $codigo_pontuacao = "select total_docente from tbl_intersticio_apendice where cod_intersticio = ".$intersticio[0];
                                             $exec_codigo_pontuacao = mysqli_query($conexao, $codigo_pontuacao);
                                             $dados_pontuacao = mysqli_fetch_assoc($exec_codigo_pontuacao);
                                             if (empty($dados_pontuacao['total_docente'])){
                                                 echo $dados_pontuacao['total_docente'];
                                                 $pontuacao = false;

                                                 $pontos = [];
                             $pontos_somados = 0;
                            for($i=1 ; $i<=16; $i++){
                             $pontos[$i] = $_POST['ponto'.$i];
                             $pontos_somados = $pontos_somados + $pontos[$i];
                            }
                            echo '<p>'.$pontos_somados.'</p>';
                            //codigo para inserir a pontuacao
                            $id_intersticio = $_POST['intersticio'];
                            $_SESSION['id_intersticio'] = $id_intersticio;
                            $codigo_apendice = "select * from tbl_intersticio_apendice where cod_intersticio = $id_intersticio";
                            //executar
                            $exec_codigo_dados_apendice = mysqli_query($conexao, $codigo_apendice);
                            $dados_codigo_apendice = mysqli_fetch_assoc($exec_codigo_dados_apendice);
                            //se tiver pontuação: UPDATE. Se não, é INSERT
                            if (empty($dados_codigo_apendice['total_docente'])){
                                if($dados_codigo_apendice['cod_intersticio'] = NULL){
                                $codigo_insert = "insert into tbl_intersticio_apendice (cod_intersticio, cod_apendice, total_docente) VALUES (".$intersticio[0].",1,$pontos_somados)
                             ";
                             $exec_codigo_insert = mysqli_query($conexao, $codigo_insert);
                             echo "<h1>Pontuação Enviada Com sucesso</h1>";
                            }else{
                                $codigo_insert = "UPDATE `tbl_intersticio_apendice` SET `total_docente`=$pontos_somados where cod_intersticio = $id_intersticio;
                             ";
                             $exec_codigo_insert = mysqli_query($conexao, $codigo_insert);
                             echo "<h1>Pontuação Enviada Com sucesso</h1>";}
                            }
                             
                             if(isset($_FILES['file'])){
                                 $arquivo = $_FILES['file'];
                                 // Informações sobre o arquivo
                                 $nome_arquivo = $arquivo['name'];
                                 $tamanho_arquivo = $arquivo['size'];
                                 $caminho_temporario = $arquivo['tmp_name'];
                                 $erro_arquivo = $arquivo['error'];
                                 $extensao= strtolower(pathinfo($nome_arquivo, PATHINFO_EXTENSION));
                                 // Diretório de destino para o upload
                                 $diretorio_destino = 'uploads/';
                                 $novo_nome_arquivo = uniqid();
                                 $path = $diretorio_destino . $novo_nome_arquivo . "." . $extensao;
                                 // Move o arquivo para o diretório de destino se for pdf
                                 if ($extensao == 'pdf'){
                                 $deu_certo=move_uploaded_file($caminho_temporario, $path);
                                     if ($deu_certo){
                                         //codigo sql
                                         $id_intersticio = $_SESSION['id_intersticio'];
                     
                     
                                         $codigo_sql_arquivos = "update `tbl_intersticio_apendice` set `nome_arquivo`='$nome_arquivo',`path`='$path' WHERE cod_intersticio = $id_intersticio";
                                         //executar o codigo
                                         mysqli_query($conexao, $codigo_sql_arquivos);
                                         echo "Upload bem-sucedido! O arquivo foi salvo em: " . $diretorio_destino . $nome_arquivo;
                                         echo "<br><a href = 'uploads/$novo_nome_arquivo.$extensao'>Clique aqui para acessa-lo</a>";
                                     
                                     }else{
                                         echo "Falha ao enviar o arquivo";
                                     }
                     
                                 }else{
                                     echo "Aceitamos apenas arquivos em pdf!!!";
                                 }
                                     }
                            }else{
                                echo "nao não é possivel mais enviar os dados";
                                $pontuacao = true;
                             }
                        }
                                             
                                                 
                             
       
       

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel</title>
    <link rel="stylesheet" href="Styles/painel.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <header class="header">
        <a href="www.ifto.edu.br" class="logo"> <img src="images/iftologo.png" width="80px"> </a>
        <h1>Apendice B</h1>
        <i class='bx bx-menu' id="menu-icon"> </i>
        <nav class="navbar">
            <a href="logout.php">Sair</a>
        </nav>
    </header>
    <div class="nav-bg"></div>
    
    <section class="container">
        
        <div class="login-container">
            <div class="form-container">
                
                <h1 class="opacity">Progressao </h1> <p id="pontuacao"></p>
                <form method='post' enctype='multipart/form-data'>
                <?php
                    $inicio_intersticio = [];
                    $fim_intersticio = [];

                    for ($b=0; $b<$a; $b++){
                    $sql_inter = "select * from tbl_intersticio where id_intersticio = ".$intersticio[$b];
                    $resultado = mysqli_query($conexao, $sql_inter);
                    $linha = mysqli_fetch_assoc($resultado);
                    $inicio_intersticio[$b] = $linha['data_inicio_intersticio'];
                    $fim_intersticio[$b] = $linha['data_fim_intersticio'];}
                    $b=0;
                    if (mysqli_num_rows($resultado) > 0) {
                        // Crie um <select> e preencha as opções com os valores do banco de dados
                        echo "<select name='intersticio' class='sair'> a";
                        for ($c=0; $c<$a; $c++){
                            $sql_inter = "select * from tbl_intersticio where id_intersticio = ".$intersticio[$b];
                            $resultado = mysqli_query($conexao, $sql_inter);
                            $linha = mysqli_fetch_assoc($resultado);
                            
                            $inicio_data = explode('-', $inicio_intersticio[$b]);
                            $fim_data = explode('-', $fim_intersticio[$b]);
                            //visualizacao correta
                            $data_inicio_correto = $inicio_data[2].'/'.$inicio_data[1].'/'.$inicio_data[0];
                            $data_fim_correto = $fim_data[2].'/'.$fim_data[1].'/'.$fim_data[0];

                            echo "<option value='" . $linha['id_intersticio'] . "'>" . $data_inicio_correto .' - '.$data_fim_correto. "</option>";
                            $b++;
                        }
                        
                        echo "</select>";
                    }
                ?>
                
                    
                    <label for="PontoI">
                        I. Aulas no Ensino Básico e em suas formas de articulação com a
                        Educação Profissional, Técnico de Nível Médio, Graduação,
                        Aperfeiçoamento e Pós Graduação; aulas na Modalidade de EaD;
                        aulas em cursos de férias (durante os recessos); aulas em
                        Nivelamento de Estudos, aulas de reforço e/ou outros Programas de
                        Acesso e Permanência, treinamento esportivo permanente ou em
                        olimpíadas do conhecimento com estudantes matriculados soma
                        da carga horária semanal dos quatro semestres no interstício, um (1)
                        ponto por aula;
                    </label>
                    <input onchange="SumScore()" value="0" type="number" name='ponto1' id="ponto1" >

                    <label for="PontoII">
                        II. Planejamento das aulas, avaliações e produção de material
                        didático 100% (cem por cento) da pontuação de cada atividade
                        relacionada no inciso I deste artigo;
                    </label>
                    <input  onchange="SumScore()" value="0" type="number" name='ponto2' id="ponto2">

                    <label for="PontoIII">
                        III. Orientação de Estágio Curricular Supervisionado sem limite
                        de estudantes, sendo dois (2) pontos por estudante;
                    </label>
                    <input  onchange="SumScore()" value="0" type="number" name='ponto3' id="ponto3">

                    <label for="PontoIV">
                        IV. Orientação de Trabalho de Conclusão de Curso (TCC) Técnico
                        de Nível Médio/estudante sem limite de estudantes, sendo três (3)
                        pontos por estudante;
                    </label>
                    <input  onchange="SumScore()" value="0" type="number" name='ponto4' id="ponto4">

                    <label for="PontoV">
                        V. Orientação de TCC (monografia/artigo) Graduação sem limite
                        de estudantes, sendo quatro (4) pontos por estudante;   
                    </label>
                    <input  onchange="SumScore()" value="0" type="number" name='ponto5' id="ponto5">

                    <label for="PontoVI">
                        VI. Coorientação de TCC (monografia/artigo) Graduação sem
                        limite de estudantes, sendo dois (2) pontos por estudante;
                    </label>
                    <input  onchange="SumScore()" value="0" type="number" name='ponto6' id="ponto6">

                    <label for="PontoVII">
                        VII. Atendimento regular ao discente constante no horário de
                        trabalho vinte (20) pontos no interstício sendo que a constatação
                        deverá ocorrer no plano de trabalho do docente com pelo menos
                        duas (2) horas/semana;
                    </label>
                    <input  onchange="SumScore()" value="0" type="number" name='ponto7' id="ponto7">

                    <label for="PontoVIII">
                        VIII. Coordenação de Programa de Monitoria e/ou Nivelamento
                        máximo um (1) programa/semestre, sendo quatro (4) pontos por programa;
                    </label>
                    <input  onchange="SumScore()" value="0" type="number" name='ponto8' id="ponto8">

                    <label for="PontoIX">
                        IX. Orientação de Monitoria ou Nivelamento / monitor máximo
                        oito (8) monitores/interstício, sendo dois (2) pontos por monitor;  
                    </label>
                    <input  onchange="SumScore()" value="0" type="number" name='ponto9' id="ponto9">

                    <label for="PontoX">
                        X. Supervisão de Atividades Complementares / curso máximo um
                        (1) curso/semestre, sendo quatro (4) pontos por curso;
                    </label>
                    <input  onchange="SumScore()" value="0" type="number" name='ponto10' id="ponto10">

                    <label for="PontoXI">
                        XI. Supervisão de estágio do curso máximo um (1)
                        curso/semestre, sendo quatro (4) pontos por curso;
                    </label>
                    <input  onchange="SumScore()" value="0" type="number" name='ponto11' id="ponto11">

                    <label for="PontoXII">
                        XII. Supervisão de Trabalhos de Conclusão de Curso (TCC) do
                        curso máximo um (1) curso/semestre, sendo quatro (4) pontos por
                        curso;
                    </label>
                    <input  onchange="SumScore()" value="0" type="number" name='ponto12' id="ponto12">

                    <label for="PontoXIII">
                        XIII. Realização de visita técnica (responsável) ou
                        acompanhamento em atividades extracurriculares (esportivas,
                        artísticas, científicas, e afins ao ensino) máximo quatro (4) visitas
                        técnicas/semestre, sendo dois (2) pontos por visita;
                    </label>
                    <input  onchange="SumScore()" value="0" type="number" name='ponto13'  id="ponto13">

                    <label for="PontoXIV">
                        XIV. Acréscimo de dois (2) pontos por turma excedente em cada
                        semestre, quando o total de turmas em que o docente ministrar
                        aulas for superior a quatro (4);
                    </label>
                    <input  onchange="SumScore()" value="0" type="number" name='ponto14' id="ponto14">

                    <label for="PontoXV">               
                        XV. Acréscimo de dois (2) pontos por componente curricular
                        excedente, quando o total de componentes curriculares/disciplina
                        em que o docente ministrar aulas for superior a três (3).
                    </label>
                    <input  onchange="SumScore()" value="0" type="number" name='ponto15' id="ponto15">

                    <label for="PontoXVI">
                        XVI. Projetos aprovados em editais da CAPES, que fomentam
                        atividades de ensino dentro da instituição com bolsa e ou recursos
                        financeiros (Programa Institucional de Bolsas de Iniciação à
                        Docência- PIBID Programa de Ensino Tutorial - PET, Pró- docência, Jovens Talentos, Laboratórios Interdisciplinares de
                        Formação de Educadores LIFE, e similares) sem limites sendo
                        quinze (15) pontos por projeto aprovado.
                    </label>
                    <input   onchange="SumScore()" value="0" type="number" name='ponto16'  id="ponto16">
                    <?php
                    
                    if (empty($dados_pontuacao['total_docente'])){
                        $pontuacao = false;
                    }else{
                            $pontuacao = true;          
                    }
            
                        if ($pontuacao==false){
                            echo "<button type='submit' name='salvar' class='opacity'>Salvar Pontuação</button>
                            <button type='submit' name='enviar' class='opacity'>Enviar Pontuação</button>";
                        }else{
                            
                            echo "Não é possivel mais inserir pontuação, e nem enviar arquivos";
                        }
                    ?>
                    
                    </div>
        </div>
                    
                    
        </section> 
              
    <!-- "Espaço entre o DragDrop e form" -->
    &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;

<!-- Upload comprovante -->
<label for="images" class="drop-container" id="dropcontainer">
                    <span class="drop-title">Envie em um unico arquivo pdf.</span>
                    <input type="file" id="images" name="file" required>
                    
                </label></form> 
              
                
                
        
    

<?php
include('footer.php');
?>

<!-- JS para exibir pontuação -->
<script src="Score.js"></script>
</body>
</html>