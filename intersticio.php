<?php
    include('conexao.php');
    include('proteger.php');
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
        <a href="http://www.ifto.edu.br/palmas" class="logo"> <center><img src="images/iftologo.png" alt="" width="140px"></center> </a>
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
    
    <?php include('footer.php') ?>
</body>
</html>