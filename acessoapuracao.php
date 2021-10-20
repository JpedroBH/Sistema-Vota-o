<?php
############# acessoapuração.php #########

require "config.php";
require "funcoes.php";
cabecalho();

//Busca a totalização de votos geral
$consulta =$pdo->prepare("select count(*) as total from votos");
$consulta->execute();
$linhatotal =$consulta->fetch(PDO::FETCH_ASSOC);
$totalg=$linhatotal['total'];

//Busca nome e a totalização de votos de cada candidato.
$consulta = $pdo->prepare("SELECT nome,count(codcand) as total from candidatos,votos where candidatos.codigo=votos.codcand group by votos.codcand");
$consulta->execute();

//Variável para montar vários gráficos HTML5.
$i=1;

//Link para atualizar a tela de apuração
echo "<div class=\"logotipo2\">

<p>
<h2>APURAÇÃO DE AELEIÇÃO</h2>
<table bordercolor=\"#666666\" width=\"600\">
<tr>
<tH>CANDIDATO</tH>
<tH>VOTOS</tH>
<tH>GRÁFICO</tH>
<tH>PORCENT.</tH>
</tr>
";
while($linha =$consulta->fetch(PDO::FETCH_ASSOC))
{
    $porc=($linha['total']*100)/$totalg;

    //Por questão de estética essa fórmula foi criada para aumentar a proporção do gráfico
    $porc2=$porc*2.8;

    //Rotina em javascript para gerar o gráfico em HTML5.
    echo "<script>    window.addEventListener('load',function(){
    //Busca a referencia do elemento 2d
    var elem = document.getElementById('grafico_$i');
    //Pegamos o contexto 2D.
    var context = elem.getContext('2d');
    //Definimos as propriedades de estilo, preenchimento cor.
    context.fillStyle = '#003399';
    //Desenho de um retangulo: (x,y,width,height)
    context.fillRect (20,30,$porc2,80);
    context.strokeStyle = '#000000';
    context.strokeRect(18,5,280,140);
    },false);
    </script>";
        echo "<tr>
        <td>$linha[nome] : </td><td align=\"center\">$linha[total]</td>
        <td width=\"1\"> <canvas id='grafico_$i' style='width:160px;height:20px'></canvas></td>
        <td>".number_format($porc,2,'.','')."%</td>
        </tr>";
        $i++;
}
echo "</table>";
rodape();
?>