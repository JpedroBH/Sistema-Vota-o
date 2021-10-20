<?php

require "funcoes.php";
require "config.php";

cabecalho();
$jogo=$_POST['txtjogo'];
$sugestao=$_POST['txtsugestao'];

verificacampo("jogo",$jogo);

try{
    $insert = $pdo->prepare("insert into games values(:codigo,:jogo,:sugestao, now())");
    $insert->bindValue(':codigo',0);
    $insert->bindValue(':jogo',$jogo);
    $insert->bindValue(':sugestao',$sugestao);
    $insert->execute();
    echo "<div class=\"alert alert-danger\">obrigada pela resposta!
</div>";
    header("Refresh: 2; URL=index.php");
} 
catch(Exception $e){
    echo"<h1>Erro ao cadastrar. Erro:". $e->getCode()."</h1>";
}

rodape();
?>