<?php
require "funcoes.php";
require "config.php";
cabecalho();
$voto =$_POST['txtvoto'];

try{
    $insert = $pdo->prepare("insert into votos values(:vcodigo,:codcand)");
    $insert->bindValue(':vcodigo',0);
    $insert->bindValue(':codcand',$voto);
    $insert->execute();
    echo "<div class=\"alert alert-danger\">Votado!
</div>";
header("Refresh: 2; URL=index.php");
}catch(Exception $e){
    echo"<h1>Erro ao votar. Erro:". $e->getCode()."</h1>";
}
rodape()
?>