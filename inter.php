<?php
    include('conexao.php');
    include('proteger.php');
    if(isset($_POST['inicio_data'])){
        // $inicio_data=$_POST['inicio_data'];
        // $fim_data=$_POST['fim_data'];
        
        // Dados para inserir
            $id_docente = $_SESSION['id_docente'];  // Substitua pelo ID do docente desejado
            $inicio_intersticio = $_POST['inicio_data'];
            $fim_intersticio = $_POST['fim_data'];
            //Exploda a data para entrar no formato aceito pelo DB.
            $inicio_data = explode('-', $inicio_intersticio);
            $fim_data = explode('-', $fim_intersticio);
            //para mandar pro banco
            $data_inicio_banco = $inicio_data[0].$inicio_data[1].$inicio_data[2];
            $data_fim_banco = $fim_data[0].$fim_data[1].$fim_data[2];

// Iniciar transação
$conn->begin_transaction();

try {
    // Inserir dados em intersticio
    $sql_intersticio = "insert into tbl_intersticio (data_inicio_intersticio, data_fim_intersticio) VALUES ('$data_inicio_banco', '$data_fim_banco')";
    $conn->query($sql_intersticio);

    // Obter o ID inserido em intersticio
    $id_intersticio = $conn->insert_id;

    // Inserir dados em carreira, referenciando o ID inserido em intersticio e o ID do docente
    $sql_carreira = "
        INSERT INTO tbl_carreira (cod_intersticio)
        SELECT $id_intersticio
        FROM tbl_docente
        WHERE id_docente = $id_docente
    ";
    $conn->query($sql_carreira);

    // Confirmar a transação
    $conn->commit();

    echo "Dados inseridos com sucesso!";
    header ("location: ./painel.php");;
} catch (Exception $e) {
    // Reverter a transação em caso de erro
    $conn->rollback();
    echo "Erro: " . $e->getMessage();
}

// Fechar a conexão
$conn->close();}
?>
    
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="Styles/login_css.css">
</head>
<body>
<div class="header">
        <a href="http://www.ifto.edu.br/palmas" class="logo"> <center><img src="images/iftologo.png" alt="" width="140px"></center> </a>
    </div>
        <section class="container">
        <div class="login-container">
 
            <div class="form-container">
                <h1 class="opacity">Intersticio</h1>
               <?php 
                // // Recupere os valores do banco de dados
                $sql_inter = "select * tbl_intersticio where id_intersticio = $id_docente";
                $resultado = mysqli_query($conexao, $sql_inter);
                
                // // Verifique se há resultados
                if (mysqli_num_rows($resultado) > 0) {
                //     // Crie um <select> e preencha as opções com os valores do banco de dados
                //     echo "<select name='interticio'>";
                //     while ($linha = mysqli_fetch_assoc($resultado)) {
                //         echo "<option value='" . $linha['id_intersticio'] . "'>" . $linha['data_inicio_intersticio'] . "</option>";
                //     }
                //     echo "</select>";
                } else {
                    echo "Nenhum intertício encontrado. <br><br> <form method='post'>Inicio intersticio<input type='date' placeholder='Inicio Intersticio' name='inicio_data' required><br>
                Fim intersticio <input type='date' placeholder='Inicio Intersticio' name='fim_data' required><br><button type='submit' >Enviar</button></form>";
                }
                
                ?>
            </div>
        </div>
        <div class="theme-btn-container"></div>
    </section>
    </div>
    
    <?php include('footer.php') ?>
</body>
</html>