<?php
##gravaaltusuarios.php 
require "funcoes.php";
require "config.php";

cabecalho("Grava Usuário");
#Recebe os dados vindos do form
$codigo=$_POST["codigo"];
$nome=$_POST["nome"];

#Checa os campos em branco

if($nome=="")
{
    header("Location: alterarcandidato.php?erro=vazio&campo=Nome&codigo=$codigo");
    exit;
}

#Monta o comando sql para alterar os dados
$update = $pdo -> prepare("update candidatos set nome=:nome where codigo=:codigo");

#Vincula os labels com as variáveis
$update->bindValue(':codigo',$codigo
);
$update->bindValue(':nome',$usunome);
$update->bindValue(':email', $usulogin);
$update->bindValue('senha',$ususenha);

#Executa comando no banco
if($update->execute())
{
    echo "<div class=\"alert alert-danger\">Usuário Alterado!</div>";
    header("Refresh: 1; URL=cadusuario.php"); 
}else
{
    echo "Erro ao gravar o usuário!";
}
rodape();
?>