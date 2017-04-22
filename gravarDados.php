<!DOCTYPE html>

<?php

include("conection.php");


$id = $_POST["id"];
$resposta = $_POST["RESPOSTA"];

mysqli_query(" select @variavel := (SELECT MAX(IDAGRUPADOR)+1  FROM agrupador);
									INSERT INTO `agrupador`(`IDAGRUPADOR`,`IDOCORRENCIA`) VALUES(@variavel,".$id.");
									INSERT INTO `resposta`(`RESPOSTA`,`IDRESPOSTA`,`DATA`,`IDAGRUPADOR`,`IDUSUARIO`) VALUES ('".$resposta."',now(),@variavel,1);
									UPDATE `ocorrencia` SET `FECHADO` = 1 WHERE `IDOCORRENCIA` = ".$id.";");


	
mysqli_close($conection);	


echo("<script>location.href='index.php'; </script>");
	
?>