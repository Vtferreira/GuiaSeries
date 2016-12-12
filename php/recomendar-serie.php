<?php
set_time_limit(0);
require_once("../classes/Obra.php");
require_once("../classes/Genero.php");
require_once("../classes/Serie.php");
require_once("../banco/SerieDAO.php");
require_once("../phpmailer/class.smtp.php");
require_once("../phpmailer/class.phpmailer.php");
$email_enviar = filter_input(INPUT_POST, 'email');
$usuario = filter_input(INPUT_POST, 'usuario_nome');
$serie_id = filter_input(INPUT_POST, 'serie_id');
$totalEpisodios = filter_input(INPUT_POST, 'total_episodios');
$serieDAO = new SerieDAO($conexao);
$serie = $serieDAO->consultar($serie_id);
$mail = new PHPMailer();
$mail->IsSMTP(); 
$mail->Host = "smtp.gmail.com"; 
$mail->Port = 587;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = 'true';
$mail->Username = 'guialivrosoficial@gmail.com'; 
$mail->Password = 'guialivrosadmin'; 
$mail->From = "guialivros@gmail.com"; 
$mail->FromName = "GuiaSeries"; 
$mail->AddAddress($email_enviar);
$mail->IsHTML(true); 
$mail->Subject  = "{$usuario} recomendou {$serie->getNome()}"; 
$mail->Body = "<h3>Recomendação do Usuário {$usuario}</h3>
<p style='font-family:Verdana,Arial,sans-serif'>
<strong>Série: </strong>{$serie->getNome()}({$serie->getAnoEstreia()})<br>
<strong>Gênero: </strong>{$serie->getGenero()->getNome()}<br>
<strong>Classificação: </strong>{$serie->mostraClassificacao()}<br>
<strong>Duração dos episódios: </strong>{$serie->getDuracao()} minutos<br>
<strong>Total de Temporadas: </strong>{$serie->getTemporadas()} temporada, {$totalEpisodios} episódios <br>
<strong>Avaliação IMDB: </strong>{$serie->getAvaliacaoIMDB()} <br>
<strong>Sinopse: </strong>{$serie->getSinopse()} <br>
</p>
";
$mail->AltBody = "Este é o corpo da mensagem de teste, em Texto Plano! \r\n :)";
$enviado = $mail->Send();
// Exibe uma mensagem de resultado
if ($enviado) {
	header("Location: ../consulta-serie.php?id={$serie->getId()}&recomendacao=1");
} else {
	  echo "Não foi possível enviar o e-mail.";
	  echo "<b>Informações do erro:</b> " . $mail->ErrorInfo;
}