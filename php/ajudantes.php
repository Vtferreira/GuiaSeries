<?php
function dateToAmerican($dataBrasil){
	$dataF = explode("/",$dataBrasil);
    $dataF = $dataF[2]."-".$dataF[1]."-".$dataF[0];
    return $dataF;
}
?>