<?php
    include('conexao.php');

    if (isset($_POST['usuario']) and isset($_POST['senha'])){
        
        // Proteção contra sql inject
        $usuario= mysqli_real_escape_string($conexao, $_POST['usuario']);
        $senha= mysqli_real_escape_string($conexao, $_POST['senha']);
        
        //Codigo mysql para pegar os dados do usuario logado
        $sql_codigo="select id_docente, usuario, senha, cod_tipo_docente from tbl_docente where usuario = '$usuario' limit 1";
        $sql_exec = mysqli_query($conexao, $sql_codigo);
        $dados= mysqli_fetch_assoc($sql_exec);
        
        //se existe o usuario
        $login_senha = 0;

        /*
            usr_existir = mysqli_num_rows($sql_exec) == 1 ? true : false;
        */

        $usr_existir = mysqli_num_rows($sql_exec);
        if($usr_existir == 1){
            if ($senha == $dados['senha']){
                if (!isset($_SESSION)){
                    session_start();
                }
                // //codigo sql para pegar a carreira
                // $codigo_carreira = "select * from tbl_carreira where cod_docente =".$dados['id_docente']." limit 1";
                // //executar o codigo
                // $sql_carreira_exec = mysqli_query($conexao, $codigo_carreira);
                // $dados_carreira = mysqli_fetch_assoc($codigo_carreira);
                // //verificar o intersticio

                // echo $dados_carreira['cod_intersticio'];


                $login_senha=1;
                $_SESSION['usuario'] = $dados['usuario'];
                $_SESSION['id_docente'] = $dados['id_docente'];
                $_SESSION['tipo_docente'] = $dados['cod_tipo_docente'];
                header ("location: ./painel.php");
            }
        }

    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="Styles/login_css.css">
</head>
<body>
<div class="header">
        <a href="http://www.ifto.edu.br/palmas" class="logo"> <center><img src="images/iftologo.png" alt="" width="140px"></a> <br/><h1>Sistema de progressão de carreira</h1></center> 
        
    </div>
        <section class="container">
            
        <div class="login-container">
 
            <div class="form-container">
            <?php
            if(isset($_POST['usuario']) and isset($_POST['senha'])){
                if($login_senha == 0){
                    echo "<p id='usuario_senha'> Matricula/Senha Incorretos</p>";
                }}
            ?>
                <h1 class="opacity">LOGIN</h1>
                <form method='post'>
                    <input type="text" placeholder="Usuario" name='usuario' required maxlength="50">
                    <input type="password" placeholder="Senha" name='senha' required>
                    <button type='submit' class="opacity">Logar</button>
                </form>
            </div>
        </div>
        <div class="theme-btn-container"></div>
    </section>
    </div>
    
    <?php include('footer.php'); ?>
</body>
</html>