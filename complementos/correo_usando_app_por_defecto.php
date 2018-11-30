<?php
$destinatarios="felixddxd@gmail.com" . ", ";//destinatarios del correo electronico
$destinatarios="felix.mamani@promujer.org";//destinatarios del correo electronico
//Titulo
$titulo = "Notificacion del sistema SISCON";
//Contenido del correo electronico
$mail = "Mensaje de notificacion proveniente del sistema SISCON";
//cabecera
$headers = "MIME-Version: 1.0\r\n"; 
$headers .= "Content-type: text/html; charset=UTF-8\r\n"; 
//dirección del remitente 
$headers .= "From: Felix Mamani < diaboliccancer6969@gmail.com >\r\n";
//Enviamos el mensaje a tu_dirección_email 
$bool = mail($destinatarios,$titulo,$mail,$headers);
if($bool){
    echo "Mensaje enviado";
}else{
    echo "Mensaje no enviado";
}
?>