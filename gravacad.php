<?php

require "funcoes.php";
require "config.php";

cabecalho();
$nome=$_POST['nome'];

verificacampo("nome",$nome);

try{
    $insert = $pdo->prepare("insert into candidatos values(:codigo,:nome)");
    $insert->bindValue(':codigo',0);
    $insert->bindValue(':nome',$nome);
    $insert->execute();
    echo "<div class=\"alert alert-danger\">Bem Vindo!
</div>";
    header("Refresh: 2; URL=cadcandidatos.php");
} catch(Exception $e){
    echo"<h1>Erro ao cadastrar. Erro:". $e->getCode()."</h1>";
}
rodape();

?>