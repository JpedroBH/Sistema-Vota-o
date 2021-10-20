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
$alterar = $pdo->prepare("select * from usuarios where usucod=:codigo");
$alterar->bindValue(':codigo',$codigo);
$alterar->execute();
$row=$alterar->fetch(PDO::FETCH_ASSOC);

#Monta o form com os valores
echo"<form name=\"form1\" method=\"post\" action=\"gravaaltusuarios.php\">

<input type=\"hidden\" name=\"codigo\" value=\"$row[usucod]\">

<p>Nome:
<input type=\"text\" size=\"50\" value=\"$row[usunome]\"  required autofocus name=\"nome\" id=\"nome\" class=\"form-control\"/>

<p>
<p>Email:
<input type=\"email\" size=\"50\" value=\"$row[usulogin]\" required name=\"email\" id=\"email\" class=\"form-control\"/>

<p>
<p>Senha:
<input type=\"password\" size=\"50\" required name=\"senha\" id=\"senha\" class=\"form-control\"/>

</p>
<p>Confirma Senha:
<input type=\"password\" size=\"50\" name=\"senha2\" id=\"senha2\" class=\"form-control\"/>
</p>
<p>

<input type=\"submit\" value=\"Gravar\" class=\"btn btn-primary\"/>

<input type=\"reset\" value=\"Limpar\" class=\"btn btn-primary\"/>
</p>
</form>";

rodape();
?>