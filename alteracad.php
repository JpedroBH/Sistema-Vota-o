<?php
## alterarusuario.php 
require "funcoes.php";
require "config.php";

cabecalho("Alterar Usuários");

#obtem código do usuário
$codigo=$_GET['codigo'];

#obtém a variável erro e o campo caso necessário
@$erro=$_GET['erro'];
@$campo=$_GET['campo'];

#Avisa que as senhas são diferentes
if($erro=="vazio")
{
echo "<div class=\"alert alert-danger\">
Atenção, campo <b>$campo</b> vazio !</div>";
}

#Busca de dados do usuário
$alterar = $pdo->prepare("select * from candidatos where codigo=:codigo");
$alterar->bindValue(':codigo',$codigo);
$alterar->execute();
$row=$alterar->fetch(PDO::FETCH_ASSOC);

#Monta o form com os valores
echo"<form name=\"form1\" method=\"post\" action=\"gravaaltcad.php\">

<input type=\"hidden\" name=\"codigo\" value=\"$row[codigo]\">

<p>Nome:
<input type=\"text\" size=\"50\" value=\"$row[nome]\"  required autofocus name=\"nome\" id=\"nome\" class=\"form-control\"/>

<p>

<input type=\"submit\" value=\"Gravar\" class=\"btn btn-primary\"/>

<input type=\"reset\" value=\"Limpar\" class=\"btn btn-primary\"/>
</p>
</form>";

rodape();
?>