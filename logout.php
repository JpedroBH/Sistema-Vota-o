<?php

require "funcoes.php";
require "config.php";
session_start();
echo "<div class=\"alert alert-danger\">Log out!!!!</div>";
session_destroy();
header("Location:index.php");

?>