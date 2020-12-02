<?php
function recoge($var, $m = "")
{
    if (!isset($_REQUEST[$var])) {
        $tmp = (is_array($m)) ? [] : "";
    } elseif (!is_array($_REQUEST[$var])) {
        $tmp = trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"));
    } else {
        $tmp = $_REQUEST[$var];
        array_walk_recursive($tmp, function (&$valor) {
            $valor = trim(htmlspecialchars($valor, ENT_QUOTES, "UTF-8"));
        });
    }
    return $tmp;
}

$idCita = recoge("idCita");

print "<p class=\"aviso\">El dato de la cita no es valido.</p>\n";
$idCitaOk = false;
if ($idCita == "") {
    print "<p class=\"aviso\">El dato de la cita no es valido.</p>\n";
    print "\n";
} elseif(!is_numeric($idCita)) {
    print "<p class=\"aviso\">El dato de la cita no es valido.</p>\n";
    print "\n";
}else{

    $idCitaOk = true;
}
if ($idCitaOk) {

    include 'connection.php';
    EliminaPaciente($idCita);
    header("Location: citas.php");
    die();
}
?>