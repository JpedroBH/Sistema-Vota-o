<?php
require "funcoes.php";
cabecalho("Login Usuário");

@$erro=$_GET['erro'];
@$campo=$_GET['campo'];
@$email=$_GET['email'];

if($erro =="Inválido")
{
    echo"<script>$(\"#myModal\").modal();</script>";
    echo"<div class=\"alert alert-danger\">
    Atenção,login ou senha inválidos!</div>";
}
if($erro=="vazio")
{
    echo "<div class=\"alert alert-danger\">
    Atenção o campo <b>$campo</b> em branco</div>";
}
?>

<form action="autentica.php" method="post" name="f1">
<P>
<label for="login">Login:</label>
<input name="email" type="text" value="<?php echo $email ?>" id="email" size="50" maxlength="50" class="form-control">
</P>
<p>

<label for="Senha">Senha:</label>
<input name="senha" type="password" id="senha" size="50" maxlength="50" class="form-control">
</p>
<p>

<input type="submit" name="Acessar" id="Acessar" value="Enviar" class="btn btn-primary">
<input type="reset" name="reset" id="reset" value="Redefinir" class="btn btn-primary">
</p>
</form>
<?php
rodape();
?>