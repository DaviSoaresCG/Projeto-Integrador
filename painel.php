<?php
    include('proteger.php');
    include('save_arquivos.php');
    include('conexao.php');
    $id_docente = $_SESSION['id_docente'];
?>
<?php
    if (isset($_POST['Salvar'])){
        
        
        //Pegue a data no formato dd/mm/yyyy
        echo"ola";

        
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Glassmorphism Navbar HTML CSS JS | Codehal</title>
    <link rel="stylesheet" href="Styles/cadastrar_css.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <header class="header">
        <a href="www.ifto.edu.br" class="logo"> <img src="images/iftologo.png" width="80px"> </a>
        <i class='bx bx-menu' id="menu-icon"> </i>
        <nav class="navbar">
            <a href="logout.php">Sair</a>
        </nav>
    </header>
    <div class="nav-bg"></div>
    <script>
        const menuIcon = document.querySelector('#menu-icon');
const navbar = document.querySelector('.navbar');
const navbg = document.querySelector('.nav-bg');
menuIcon.addEventListener('click', () => {
    menuIcon.classList.toggle('bx-x');
    navbar.classList.toggle('active');
    navbg.classList.toggle('active');
});
    </script>
    <section class="container">
        <div class="login-container">
            <div class="form-container">
                <h1 class="opacity">Progressao</h1> 
                <?php
                    $sql_inter = "select * from tbl_intersticio where id_intersticio = ".$id_docente;
                    $resultado = mysqli_query($conexao, $sql_inter);
                    
                    // // Verifique se há resultados
                    if (mysqli_num_rows($resultado) > 0) {
                        // Crie um <select> e preencha as opções com os valores do banco de dados
                        echo "<select name='interticio' class='sair'>";
                        while ($linha = mysqli_fetch_assoc($resultado)) {
                            echo "<option value='" . $linha['id_intersticio'] . "'>" . $linha['data_inicio_intersticio'] .' '.$linha['data_fim_intersticio']. "</option>";
                        }
                        echo "</select>";
                    }
                ?>
                <form method='post'>
                    
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
                    <input value="0" type="number" name='PontoI' required >

                    <label for="PontoII">
                        II. Planejamento das aulas, avaliações e produção de material
                        didático 100% (cem por cento) da pontuação de cada atividade
                        relacionada no inciso I deste artigo;
                    </label>
                    <input  value="0" type="number" name='PontoII' required>

                    <label for="PontoIII">
                        III. Orientação de Estágio Curricular Supervisionado sem limite
                        de estudantes, sendo dois (2) pontos por estudante;
                    </label>
                    <input  value="0" type="number" name='PontoIII' required>

                    <label for="PontoIV">
                        IV. Orientação de Trabalho de Conclusão de Curso (TCC) Técnico
                        de Nível Médio/estudante sem limite de estudantes, sendo três (3)
                        pontos por estudante;
                    </label>
                    <input  value="0" type="number" name='PontoIV' required>

                    <label for="PontoV">
                        V. Orientação de TCC (monografia/artigo) Graduação sem limite
                        de estudantes, sendo quatro (4) pontos por estudante;   
                    </label>
                    <input  value="0" type="number" name='PontoV' required>

                    <label for="PontoVI">
                        VI. Coorientação de TCC (monografia/artigo) Graduação sem
                        limite de estudantes, sendo dois (2) pontos por estudante;
                    </label>
                    <input  value="0" type="number" name='PontoVI' required>

                    <label for="PontoVII">
                        VII. Atendimento regular ao discente constante no horário de
                        trabalho vinte (20) pontos no interstício sendo que a constatação
                        deverá ocorrer no plano de trabalho do docente com pelo menos
                        duas (2) horas/semana;
                    </label>
                    <input  value="0" type="number" name='PontoVII' required>

                    <label for="PontoVIII">
                        VIII. Coordenação de Programa de Monitoria e/ou Nivelamento
                        máximo um (1) programa/semestre, sendo quatro (4) pontos por programa;
                    </label>
                    <input  value="0" type="number" name='PontoVIII' required>

                    <label for="PontoIX">
                        IX. Orientação de Monitoria ou Nivelamento / monitor máximo
                        oito (8) monitores/interstício, sendo dois (2) pontos por monitor;  
                    </label>
                    <input  value="0" type="number" name='PontoIX' required>

                    <label for="PontoX">
                        X. Supervisão de Atividades Complementares / curso máximo um
                        (1) curso/semestre, sendo quatro (4) pontos por curso;
                    </label>
                    <input  value="0" type="number" name='PontoX' required>

                    <label for="PontoXI">
                        XI. Supervisão de estágio do curso máximo um (1)
                        curso/semestre, sendo quatro (4) pontos por curso;
                    </label>
                    <input  value="0" type="number" name='PontoXI' required>

                    <label for="PontoXII">
                        XII. Supervisão de Trabalhos de Conclusão de Curso (TCC) do
                        curso máximo um (1) curso/semestre, sendo quatro (4) pontos por
                        curso;
                    </label>
                    <input  value="0" type="number" name='PontoXII' required>

                    <label for="PontoXIII">
                        XIII. Realização de visita técnica (responsável) ou
                        acompanhamento em atividades extracurriculares (esportivas,
                        artísticas, científicas, e afins ao ensino) máximo quatro (4) visitas
                        técnicas/semestre, sendo dois (2) pontos por visita;
                    </label>
                    <input  value="0" type="number" name='PontoXIII' required>

                    <label for="PontoXIV">
                        XIV. Acréscimo de dois (2) pontos por turma excedente em cada
                        semestre, quando o total de turmas em que o docente ministrar
                        aulas for superior a quatro (4);
                    </label>
                    <input  value="0" type="number" name='PontoXIV' required>

                    <label for="PontoXV">               
                        XV. Acréscimo de dois (2) pontos por componente curricular
                        excedente, quando o total de componentes curriculares/disciplina
                        em que o docente ministrar aulas for superior a três (3).
                    </label>
                    <input  value="0" type="number" name='PontoXV' required>

                    <label for="PontoXVI">
                        XVI. Projetos aprovados em editais da CAPES, que fomentam
                        atividades de ensino dentro da instituição com bolsa e ou recursos
                        financeiros (Programa Institucional de Bolsas de Iniciação à
                        Docência- PIBID Programa de Ensino Tutorial - PET, Pró- docência, Jovens Talentos, Laboratórios Interdisciplinares de
                        Formação de Educadores LIFE, e similares) sem limites sendo
                        quinze (15) pontos por projeto aprovado.
                    </label>
                    <input  value="0" type="number" name='PontoXVI' required> 
                    <button type='submit' name="Salvar" class="opacity">Salvar Pontuação</button>
                    <button type='submit' name="Enviar" class="opacity">Enviar Pontuação</button>
                </form>
            </div>
        </div>
        
    </section>   
    <!-- "Espaço entre o DragDrop e form" -->
    &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;

<!-- Upload comprovante -->
<label for="images" class="drop-container" id="dropcontainer">
  <span class="drop-title">Arraste e solte o comprovante aqui. Envie em um unico arquivo pdf.</span>
  <input type="file" id="images" accept="pdf/*" required>
</label>
<?php
include('footer.php')
?>

<!-- JS para exibir pontuação -->
<script>
    document.write("AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA")
</script>
</body>
</html>