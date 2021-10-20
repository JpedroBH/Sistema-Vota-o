<?php
#######index.php#########
require "config.php";
require "funcoes.php";

cabecalho();

//obtem a variavel erro,responsavel por mostrar as mesagens abaixo depois de sair da apuracao
if (isset($_GET['erro'])){
    $erro=$_GET['erro'];
}else{
    $erro="";
    }
    if ($erro=="login"){
      @session_start();
      session_destroy();
      echo "<div class=\"erro\">É necessário fazer o login no sistema!</div>";
    }
    echo "<strong> CANDIDATOS CONCORRENDO NA ELEIÇÃO </strong> <p>";
    $consulta = $pdo->query("select * from candidatos order by codigo");
    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)){
      echo "<div class=\"logotipo\">$linha[nome]<p>
      <strong>Número: $linha[codigo]</strong></div>";
    }
    //monta o formulário para a votação.
    echo "<table width=\"100%\"><tr><td align=\"center\">
    <form action=\"gravavotos.php\" method=\"post\" name=\"furna\" id=\"furna\" onSubmit=\"return false\" >
    <label>
    número:
    <input type=\"text\" name=\"txtvoto\" size=\"3\" maxlength=\"3\" id=\"txtvoto\">

    </label>
    <p>
    <span class=\"carregando\"><img scr=\"ajax-loader.gif\" /></span>
    <span class=\"logo\" id=\"logo\">Informe o número do candidato.</span>
    <script type=\"text/javascript\">
    $(function(){
      $('#txtvoto').keyup(function(){
        if( $(this).val() ){
          $('#logo').hide();
          $('.carregando').show();
    $.getJSON('buscacandidato.php?codigo=',{codigo: $(this).val(), ajax:'true'},function(j){

      for (var i = 0; i < j.length; i++) {
        var cand = '<p><div class=\"logotipo2\"><strong>'+j[i].nome+' <br>Número: '+j[i].codigo+'</strong></div><p>';
      }

      $('#logo').html(cand).show();
      $('.carregando').hide();
      if (j[0].logo=='invalido.png'){
        $('.confirma').hide();
        $('.corrige').show();
      }else{
        $('.confirma').show();
        $('.corrige').show();
        $('confirma').focus();
      }
});

}else{
  $('#logo').html('Informe o número do candidato.');
  $('.confirma').hide();
}
});
});
</script>
<p>
<table><tr><td>
<span class=\"corrige\"tabindex=0>
      <img src=\"img/corrige.png\" onClick=\"limpar();\">
</span>
</td><td>
<span class=\"confirma\" tabindex=1>
<img src=\"img/confirma.png\" onClick=\"enviar();\">
</span>
</td></tr></table>
</form>
</td></tr></table>
<script>
    document.furna.txtvoto.focus();
</script>";
rodape();
?>  