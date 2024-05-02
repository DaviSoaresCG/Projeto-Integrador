<?php
include('conexao.php');
include('proteger.php');
if(isset($_POST['enviar'])){
    echo "aaaaaaaaa";
if (isset($_FILES['file'])) {
    $arquivo = $_FILES['file'];
    echo "AAAAAAAAAAAAAAAAAAAAAAA";
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

}}


?>