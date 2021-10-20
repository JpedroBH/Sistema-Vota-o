<?php

require "funcoes.php";
require "config.php";

cabecalho();
$usunome=$_POST['usunome'];
$usulogin=$_POST['usulogin'];
$ususenha=$_POST['ususenha'];
$ususenha=sha1($ususenha);

verificacampo("nome",$usunome);
verificacampo("email",$usulogin);
verificacampo("senha",$ususenha);

try{
    $insert = $pdo->prepare("insert into usuarios values(:codigo,:nome,:email,:senha)");
    $insert->bindValue(':codigo',0);
    $insert->bindValue(':nome',$usunome);
    $insert->bindValue(':email',$usulogin);
    $insert->bindValue(':senha',$ususenha);
    $insert->execute();
    echo "<div class=\"alert alert-danger\">Bem Vindo!
</div>";
    header("Refresh: 2; URL=cadusuario.php");
} catch(Exception $e){
    echo"<h1>Erro ao cadastrar. Erro:". $e->getCode()."</h1>";
}
rodape();

?>