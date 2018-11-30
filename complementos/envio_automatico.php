<?php 
/*Ejecutar este script PHP en el servidor:
Windows: Tareas Programadas
LINUX: ACRON
Para que el sistema verifique y envie correos todos los dias sin necesidad de ejecutar el sistema*/
	require("../controller/conexion.php");
            $sql=("SELECT * FROM alquiler");
            $query=mysqli_query($con,$sql);
            while($arreglo=mysqli_fetch_array($query)){
              $confi=date("Y-m-d");
              $nuevo=strtotime("+2 month",strtotime($confi));
              $nuevo=date("Y-m-d",$nuevo);
              $nuevo2=strtotime("+1 month",strtotime($confi));
              $nuevo2=date("Y-m-d",$nuevo2);
              if ($arreglo[6]>date("Y-m-d")) {
                  $campo="vigente";
              }
              if ($arreglo[6]<$nuevo && $arreglo[6]>date("Y-m-d")) {
                  $campo="notificado";
                  if ($arreglo[15]!=""&&$arreglo[16]!=1) {
                    if ($arreglo[6]<$nuevo2 && $arreglo[6]>date("Y-m-d")) {
                            if ($arreglo[17]!=1) {
                                $destinatarios=$arreglo[15];
                                $titulo = "Notificacion de conclusion de contrato";
                                $mail = "Promujer informa que su contrato de alquiler del Centro Focal: $arreglo[2] le queda aproximadamente 1 mes para su conclusion, se sugiere una renovacion, Que tenga una exelente jornada";
                                $headers = "MIME-Version: 1.0\r\n"; 
                                $headers .= "Content-type: text/html; charset=UTF-8\r\n";  
                                $headers .= "From: ProMujer IFD < promujer@promujer.org >\r\n";
                                $bool = mail($destinatarios,$titulo,$mail,$headers);
                                if($bool){
                                    $sql2= "UPDATE alquiler set noti2=1 where id_alqui=$arreglo[0]";
                                    $query2 = $con->query($sql2);
                                    if($query2!=null){
                                        echo "Se envio un correo electronico de notificacion a $arreglo[4]";
                                    }
                                    else{
                                        echo "Error interno del sistema, consulte con el administrador";
                                    }
                            }else{
                                echo "No se puede enviar correos electronicos, no se detecto conexion a internet";
                            }
                            }
                  }
                  else{
                                $destinatarios=$arreglo[15];
                                $titulo = "Notificacion de conclusion de contrato";
                                $mail = "Promujer informa que su contrato de alquiler del Centro Focal: $arreglo[2] le queda aproximadamente 2 mes para su conclusion, se sugiere una renovacion, Que tenga una excelente jornada";
                                $headers = "MIME-Version: 1.0\r\n"; 
                                $headers .= "Content-type: text/html; charset=UTF-8\r\n";  
                                $headers .= "From: ProMujer IFD < promujer@promujer.org >\r\n";
                                $bool = mail($destinatarios,$titulo,$mail,$headers);
                                if($bool){
                                    $sql2= "UPDATE alquiler set noti1=1 where id_alqui=$arreglo[0]";
                                    $query2 = $con->query($sql2);
                                    if($query2!=null){
                                        echo "Se envio un correo electronico de notificacion a $arreglo[4]";
                                    }
                                    else{
                                        echo "Error interno del sistema, consulte con el administrador";
                                    }
                            }else{
                                echo "No se puede enviar correos electronicos, no se detecto conexion a internet";
                            }
                  }
                    }    
              }
              $nuevo3=strtotime("+1 week",strtotime($confi));
              $nuevo3=date("Y-m-d",$nuevo3);
              if ($arreglo[6]<date("Y-m-d")) {
                  $campo="vencido";
                  if ($arreglo[15]!=""&&$arreglo[18]!=1) {
                        if ($arreglo[6]<$nuevo3 && $arreglo[6]<date("Y-m-d")) {
                            if ($arreglo[19]!=1) {
                                $destinatarios=$arreglo[15];
                                $titulo = "Notificacion de conclusion de contrato";
                                $mail = "Promujer informa que su contrato de alquiler del Centro Focal: $arreglo[2] lleva mas de una semana vencida, se sugiere una renovacion, Que tenga una excelente jornada";
                                $headers = "MIME-Version: 1.0\r\n"; 
                                $headers .= "Content-type: text/html; charset=UTF-8\r\n";  
                                $headers .= "From: ProMujer IFD < promujer@promujer.org >\r\n";
                                $bool = mail($destinatarios,$titulo,$mail,$headers);
                                if($bool){
                                    $sql2= "update alquiler set noti4=1 where id_alqui=$arreglo[0]";
                                    $query2 = $con->query($sql2);
                                    if($query2!=null){
                                        echo "Se envio un correo electronico de notificacion a $arreglo[4]";
                                    }
                                    else{
                                        echo "Error interno del sistema, consulte con el administrador";
                                    }
                            }else{
                                echo "No se puede enviar correos electronicos, no se detecto conexion a internet";
                            }
                            }
                        }
                        else{
                            $destinatarios=$arreglo[15];
                            $titulo = "Notificacion de conclusion de contrato";
                            $mail = "Promujer informa que su contrato de alquiler del Centro Focal: $arreglo[2] acaba de vencer, se sugiere una renovacion, Que tenga una excelente jornada";
                            $headers = "MIME-Version: 1.0\r\n"; 
                            $headers .= "Content-type: text/html; charset=UTF-8\r\n";  
                            $headers .= "From: ProMujer IFD < promujer@promujer.org >\r\n";
                            $bool = mail($destinatarios,$titulo,$mail,$headers);
                            if($bool){
                                $sql2= "update alquiler set noti3=1 where id_alqui=$arreglo[0]";
                                $query2 = $con->query($sql2);
                                if($query2!=null){
                                        echo "Se envio un correo electronico de notificacion a $arreglo[4]";
                                    }
                                    else{
                                        echo "Error interno del sistema, consulte con el administrador";
                                    }
                            }else{
                                echo "No se puede enviar correos electronicos, no se detecto conexion a internet";
                            }
                        }
                  }
              }
            }
 ?>
 <?php 
            $sql=("SELECT * FROM limpieza");
            $query=mysqli_query($con,$sql);
            while($arreglo=mysqli_fetch_array($query)){
                $confi=date("Y-m-d");
              $nuevo=strtotime("+2 month",strtotime($confi));
              $nuevo=date("Y-m-d",$nuevo);
              $nuevo2=strtotime("+1 month",strtotime($confi));
              $nuevo2=date("Y-m-d",$nuevo2);
              if ($arreglo[6]>date("Y-m-d")) {
                  $campo="vigente";
              }
              if ($arreglo[6]<$nuevo && $arreglo[6]>date("Y-m-d")) {
                  $campo="notificado";
                  if ($arreglo[11]!=""&&$arreglo[13]!=1) {
                    if ($arreglo[6]<$nuevo2 && $arreglo[6]>date("Y-m-d")) {
                            if ($arreglo[14]!=1) {
                                $destinatarios=$arreglo[11];
                                $titulo = "Notificacion de conclusion de contrato";
                                $mail = "Promujer informa que su contrato de limpieza de $arreglo[4] para el centro focal $arreglo[2] vencerá en aproximadamente un mes, Que tenga una exelente jornada";
                                $headers = "MIME-Version: 1.0\r\n"; 
                                $headers .= "Content-type: text/html; charset=UTF-8\r\n";  
                                $headers .= "From: ProMujer IFD < promujer@promujer.org >\r\n";
                                $bool = mail($destinatarios,$titulo,$mail,$headers);
                                if($bool){
                                    $sql2= "UPDATE limpieza set noti2=1 where id_lim=$arreglo[0]";
                                    if($query2!=null){
                                        echo "Se envio un correo electronico de notificacion a $arreglo[4]";
                                    }
                                    else{
                                        echo "Error interno del sistema, consulte con el administrador";
                                    }
                            }else{
                                echo "No se puede enviar correos electronicos, no se detecto conexion a internet";
                            }
                            }
                  }
                  else{
                                $destinatarios=$arreglo[11];
                                $titulo = "Notificacion de conclusion de contrato";
                                $mail = "Promujer informa que su contrato de limpieza de $arreglo[4] para el centro focal $arreglo[2] vencerá en aproximadamente dos meses, Que tenga una exelente jornada";
                                $headers = "MIME-Version: 1.0\r\n"; 
                                $headers .= "Content-type: text/html; charset=UTF-8\r\n";  
                                $headers .= "From: ProMujer IFD < promujer@promujer.org >\r\n";
                                $bool = mail($destinatarios,$titulo,$mail,$headers);
                                if($bool){
                                    $sql2= "UPDATE limpieza set noti1=1 where id_lim=$arreglo[0]";
                                    $query2 = $con->query($sql2);
                                    if($query2!=null){
                                        echo "Se envio un correo electronico de notificacion a $arreglo[4]";
                                    }
                                    else{
                                        echo "Error interno del sistema, consulte con el administrador";
                                    }
                            }else{
                                echo "No se puede enviar correos electronicos, no se detecto conexion a internet";
                            }
                  }
                    }    
              }
              $nuevo3=strtotime("+1 week",strtotime($confi));
              $nuevo3=date("Y-m-d",$nuevo3);
              if ($arreglo[6]<date("Y-m-d")) {
                  $campo="vencido";
                  if ($arreglo[12]!=""&&$arreglo[15]!=1) {
                        if ($arreglo[6]<$nuevo3 && $arreglo[6]<date("Y-m-d")) {
                            if ($arreglo[16]!=1) {
                                $destinatarios=$arreglo[12];
                                $titulo = "Notificacion de conclusion de contrato";
                                $mail = "Promujer informa que su contrato de limpieza de $arreglo[4] para el centro focal $arreglo[2] lleva mas de una semana de vencido, Que tenga una exelente jornada";
                                $headers = "MIME-Version: 1.0\r\n"; 
                                $headers .= "Content-type: text/html; charset=UTF-8\r\n";  
                                $headers .= "From: ProMujer IFD < promujer@promujer.org >\r\n";
                                $bool = mail($destinatarios,$titulo,$mail,$headers);
                                if($bool){
                                    $sql2= "update limpieza set noti4=1 where id_lim=$arreglo[0]";
                                    $query2 = $con->query($sql2);
                                    if($query2!=null){
                                        echo "Se envio un correo electronico de notificacion a $arreglo[4]";
                                    }
                                    else{
                                        echo "Error interno del sistema, consulte con el administrador";
                                    }
                            }else{
                                echo "No se puede enviar correos electronicos, no se detecto conexion a internet";
                            }
                            }
                        }
                        else{
                            $destinatarios=$arreglo[12];
                            $titulo = "Notificacion de conclusion de contrato";
                            $mail = "Promujer informa que su contrato de limpieza de $arreglo[4] para el centro focal $arreglo[2] acaba de vencer, Que tenga una exelente jornada";
                            $headers = "MIME-Version: 1.0\r\n"; 
                            $headers .= "Content-type: text/html; charset=UTF-8\r\n";  
                            $headers .= "From: ProMujer IFD < promujer@promujer.org >\r\n";
                            $bool = mail($destinatarios,$titulo,$mail,$headers);
                            if($bool){
                                $sql2= "update limpieza set noti3=1 where id_lim=$arreglo[0]";
                                $query2 = $con->query($sql2);
                                if($query2!=null){
                                        echo "Se envio un correo electronico de notificacion a $arreglo[4]";
                                    }
                                    else{
                                        echo "Error interno del sistema, consulte con el administrador";
                                    }
                            }else{
                                echo "No se puede enviar correos electronicos, no se detecto conexion a internet";
                            }
                        }
                  }
              }
            }
  ?>
  <?php 
                $sql=("SELECT * FROM monitoreo");
            $query=mysqli_query($con,$sql);
            while($arreglo=mysqli_fetch_array($query)){
                $confi=date("Y-m-d");
              $nuevo=strtotime("+2 month",strtotime($confi));
              $nuevo=date("Y-m-d",$nuevo);
              $nuevo2=strtotime("+1 month",strtotime($confi));
              $nuevo2=date("Y-m-d",$nuevo2);
              if ($arreglo[5]>date("Y-m-d")) {
                  $campo="vigente";
              }
              if ($arreglo[5]<$nuevo && $arreglo[5]>date("Y-m-d")) {
                  $campo="notificado";
                  if ($arreglo[10]!=""&&$arreglo[12]!=1) {
                    if ($arreglo[5]<$nuevo2 && $arreglo[5]>date("Y-m-d")) {
                            if ($arreglo[13]!=1) {
                                $destinatarios=$arreglo[10];
                                $titulo = "Notificacion de conclusion de contrato";
                                $mail = "Promujer informa que el contrato de $arreglo[3] por el concepto de monitoreo de alarmas le queda aproximadamente un mes para su conclusion, Que tenga una excelente jornada";
                                $headers = "MIME-Version: 1.0\r\n"; 
                                $headers .= "Content-type: text/html; charset=UTF-8\r\n";  
                                $headers .= "From: ProMujer IFD < promujer@promujer.org >\r\n";
                                $bool = mail($destinatarios,$titulo,$mail,$headers);
                                if($bool){
                                    $sql2= "UPDATE monitoreo set noti2=1 where id_moni=$arreglo[0]";
                                    $query2 = $con->query($sql2);
                                    if($query2!=null){
                                        echo "Se envio un correo electronico de notificacion a $arreglo[3]";
                                    }
                                    else{
                                        echo "Error interno del sistema, consulte con el administrador";
                                    }
                            }else{
                                echo "No se puede enviar correos electronicos, no se detecto conexion a internet";
                            }
                            }
                  }
                  else{
                                $destinatarios=$arreglo[10];
                                $titulo = "Notificacion de conclusion de contrato";
                                $mail = "Promujer informa que el contrato de $arreglo[3] por el concepto de monitoreo de alarmas le queda aproximadamente dos meses para su conclusion, Que tenga una excelente jornada";
                                $headers = "MIME-Version: 1.0\r\n"; 
                                $headers .= "Content-type: text/html; charset=UTF-8\r\n";  
                                $headers .= "From: ProMujer IFD < promujer@promujer.org >\r\n";
                                $bool = mail($destinatarios,$titulo,$mail,$headers);
                                if($bool){
                                    $sql2= "UPDATE monitoreo set noti1=1 where id_moni=$arreglo[0]";
                                    $query2 = $con->query($sql2);
                                    if($query2!=null){
                                        echo "Se envio un correo electronico de notificacion a $arreglo[3]";
                                    }
                                    else{
                                        echo "Error interno del sistema, consulte con el administrador";
                                    }
                            }else{
                                echo "No se puede enviar correos electronicos, no se detecto conexion a internet";
                            }
                  }
                    }    
              }
              $nuevo3=strtotime("+1 week",strtotime($confi));
              $nuevo3=date("Y-m-d",$nuevo3);
              if ($arreglo[5]<date("Y-m-d")) {
                  $campo="vencido";
                  if ($arreglo[11]!=""&&$arreglo[14]!=1) {
                        if ($arreglo[5]<$nuevo3 && $arreglo[5]<date("Y-m-d")) {
                            if ($arreglo[15]!=1) {
                                $destinatarios=$arreglo[11];
                                $titulo = "Notificacion de conclusion de contrato";
                                $mail = "Promujer informa que el contrato de $arreglo[3] por el concepto de monitoreo de alarmas tiene una semana de vencido, Que tenga una excelente jornada";
                                $headers = "MIME-Version: 1.0\r\n"; 
                                $headers .= "Content-type: text/html; charset=UTF-8\r\n";  
                                $headers .= "From: ProMujer IFD < promujer@promujer.org >\r\n";
                                $bool = mail($destinatarios,$titulo,$mail,$headers);
                                if($bool){
                                    $sql2= "update monitoreo set noti4=1 where id_moni=$arreglo[0]";
                                    $query2 = $con->query($sql2);
                                    if($query2!=null){
                                        echo "Se envio un correo electronico de notificacion a $arreglo[3]";
                                    }
                                    else{
                                        echo "Error interno del sistema, consulte con el administrador";
                                    }
                            }else{
                                echo "No se puede enviar correos electronicos, no se detecto conexion a internet";
                            }
                            }
                        }
                        else{
                            $destinatarios=$arreglo[11];
                            $titulo = "Notificacion de conclusion de contrato";
                            $mail = "Promujer informa que el contrato de $arreglo[3] por el concepto de monitoreo de alarmas acaba de vencer, Que tenga una excelente jornada";
                            $headers = "MIME-Version: 1.0\r\n"; 
                            $headers .= "Content-type: text/html; charset=UTF-8\r\n";  
                            $headers .= "From: ProMujer IFD < promujer@promujer.org >\r\n";
                            $bool = mail($destinatarios,$titulo,$mail,$headers);
                            if($bool){
                                $sql2= "update monitoreo set noti3=1 where id_moni=$arreglo[0]";
                                $query2 = $con->query($sql2);
                                if($query2!=null){
                                        echo "Se envio un correo electronico de notificacion a $arreglo[3]";
                                    }
                                    else{
                                        echo "Error interno del sistema, consulte con el administrador";
                                    }
                            }else{
                                echo "No se puede enviar correos electronicos, no se detecto conexion a internet";
                            }
                        }
                  }
              }
            }
   ?>
   <?php 
   	$sql=("SELECT * FROM otros_contratos");
            $query=mysqli_query($con,$sql);
            while($arreglo=mysqli_fetch_array($query)){
                $confi=date("Y-m-d");
              $nuevo=strtotime("+2 month",strtotime($confi));
              $nuevo=date("Y-m-d",$nuevo);
              $nuevo2=strtotime("+1 month",strtotime($confi));
              $nuevo2=date("Y-m-d",$nuevo2);
              if ($arreglo[4]>date("Y-m-d")) {
                  $campo="vigente";
              }
              if ($arreglo[4]<$nuevo && $arreglo[4]>date("Y-m-d")) {
                  $campo="notificado";
                  if ($arreglo[10]!=""&&$arreglo[12]!=1) {
                    if ($arreglo[4]<$nuevo2 && $arreglo[4]>date("Y-m-d")) {
                            if ($arreglo[13]!=1) {
                                $destinatarios=$arreglo[10];
                                $titulo = "Notificacion de conclusion de contrato";
                                $mail = "Promujer informa a la empresa $arreglo[1] por el concepto de $arreglo[2] que le quedan menos de un mes para su conclusion, Que tenga una excelente jornada";
                                $headers = "MIME-Version: 1.0\r\n"; 
                                $headers .= "Content-type: text/html; charset=UTF-8\r\n";  
                                $headers .= "From: ProMujer IFD < promujer@promujer.org >\r\n";
                                $bool = mail($destinatarios,$titulo,$mail,$headers);
                                if($bool){
                                    $sql2= "UPDATE otros_contratos set noti2=1 where id_ot=$arreglo[0]";
                                    $query2 = $con->query($sql2);
                                    if($query2!=null){
                                        echo "Se envio un correo electronico de notificacion a $arreglo[1]";
                                    }
                                    else{
                                        echo "Error interno del sistema, consulte con el administrador";
                                    }
                            }else{
                                echo "No se puede enviar correos electronicos, no se detecto conexion a internet";
                            }
                            }
                  }
                  else{
                                $destinatarios=$arreglo[10];
                                $titulo = "Notificacion de conclusion de contrato";
                                $mail = "Promujer informa a la empresa $arreglo[1] por el concepto de $arreglo[2] que le quedan menos de dos meses para su conclusion, Que tenga una excelente jornada";
                                $headers = "MIME-Version: 1.0\r\n"; 
                                $headers .= "Content-type: text/html; charset=UTF-8\r\n";  
                                $headers .= "From: ProMujer IFD < promujer@promujer.org >\r\n";
                                $bool = mail($destinatarios,$titulo,$mail,$headers);
                                if($bool){
                                    $sql2= "UPDATE otros_contratos set noti1=1 where id_ot=$arreglo[0]";
                                    $query2 = $con->query($sql2);
                                    if($query2!=null){
                                        echo "Se envio un correo electronico de notificacion a $arreglo[1]";
                                    }
                                    else{
                                        echo "Error interno del sistema, consulte con el administrador";
                                    }
                            }else{
                                echo "No se puede enviar correos electronicos, no se detecto conexion a internet";
                            }
                  }
                    }    
              }
              $nuevo3=strtotime("+1 week",strtotime($confi));
              $nuevo3=date("Y-m-d",$nuevo3);
              if ($arreglo[4]<date("Y-m-d")) {
                  $campo="vencido";
                  if ($arreglo[11]!=""&&$arreglo[14]!=1) {
                        if ($arreglo[4]<$nuevo3 && $arreglo[4]<date("Y-m-d")) {
                            if ($arreglo[15]!=1) {
                                $destinatarios=$arreglo[11];
                                $titulo = "Notificacion de conclusion de contrato";
                                $mail = "Promujer informa a la empresa $arreglo[1] por el concepto de $arreglo[2] que lleva mas de una semana de vencido, Que tenga una excelente jornada";
                                $headers = "MIME-Version: 1.0\r\n"; 
                                $headers .= "Content-type: text/html; charset=UTF-8\r\n";  
                                $headers .= "From: ProMujer IFD < promujer@promujer.org >\r\n";
                                $bool = mail($destinatarios,$titulo,$mail,$headers);
                                if($bool){
                                    $sql2= "update otros_contratos set noti4=1 where id_ot=$arreglo[0]";
                                    $query2 = $con->query($sql2);
                                    if($query2!=null){
                                        echo "Se envio un correo electronico de notificacion a $arreglo[1]";
                                    }
                                    else{
                                        echo "Error interno del sistema, consulte con el administrador";
                                    }
                            }else{
                                echo "No se puede enviar correos electronicos, no se detecto conexion a internet";
                            }
                            }
                        }
                        else{
                            $destinatarios=$arreglo[11];
                            $titulo = "Notificacion de conclusion de contrato";
                            $mail = "Promujer informa a la empresa $arreglo[1] por el concepto de $arreglo[2] acaba de vencer, Que tenga una excelente jornada";
                            $headers = "MIME-Version: 1.0\r\n"; 
                            $headers .= "Content-type: text/html; charset=UTF-8\r\n";  
                            $headers .= "From: ProMujer IFD < promujer@promujer.org >\r\n";
                            $bool = mail($destinatarios,$titulo,$mail,$headers);
                            if($bool){
                                $sql2= "update otros_contratos set noti3=1 where id_ot=$arreglo[0]";
                                $query2 = $con->query($sql2);
                                if($query2!=null){
                                        echo "Se envio un correo electronico de notificacion a $arreglo[1]";
                                    }
                                    else{
                                        echo "Error interno del sistema, consulte con el administrador";
                                    }
                            }else{
                                echo "No se puede enviar correos electronicos, no se detecto conexion a internet";
                            }
                        }
                  }
              }
            }
    ?>
    <?php 
            $sql=("SELECT * FROM seguridad");
            $query=mysqli_query($con,$sql);
            while($arreglo=mysqli_fetch_array($query)){
              $confi=date("Y-m-d");
              $nuevo=strtotime("+2 month",strtotime($confi));
              $nuevo=date("Y-m-d",$nuevo);
              $nuevo2=strtotime("+1 month",strtotime($confi));
              $nuevo2=date("Y-m-d",$nuevo2);
              if ($arreglo[6]>date("Y-m-d")) {
                  $campo="vigente";
              }
              if ($arreglo[6]<$nuevo && $arreglo[6]>date("Y-m-d")) {
                  $campo="notificado";
                  if ($arreglo[12]!=""&&$arreglo[14]!=1) {
                    if ($arreglo[6]<$nuevo2 && $arreglo[6]>date("Y-m-d")) {
                            if ($arreglo[15]!=1) {
                                $destinatarios=$arreglo[12];
                                $titulo = "Notificacion de conclusion de contrato de alquiler";
                                $mail = "Promujer informa a la empresa $arreglo[4] que su contrato de seguridad con la regional $arreglo[2] tiene menos de un mes para concluir, Que tenga una excelente jornada";
                                $headers = "MIME-Version: 1.0\r\n"; 
                                $headers .= "Content-type: text/html; charset=UTF-8\r\n";  
                                $headers .= "From: ProMujer IFD < promujer@promujer.org >\r\n";
                                $bool = mail($destinatarios,$titulo,$mail,$headers);
                                if($bool){
                                    $sql2= "UPDATE seguridad set noti2=1 where id_segu=$arreglo[0]";
                                    $query2 = $con->query($sql2);
                                    if($query2!=null){
                                        echo "Se envio un correo electronico de notificacion a $arreglo[4]";
                                    }
                                    else{
                                        echo "Error interno del sistema, consulte con el administrador";
                                    }
                            }else{
                                echo "No se puede enviar correos electronicos, no se detecto conexion a internet";
                            }
                            }
                  }
                  else{
                                $destinatarios=$arreglo[12];
                                $titulo = "Notificacion de conclusion de contrato de alquiler";
                                $mail = "Promujer informa a la empresa $arreglo[4] que su contrato de seguridad con la regional $arreglo[2] tiene menos de dos mes para concluir, Que tenga una excelente jornada";
                                $headers = "MIME-Version: 1.0\r\n"; 
                                $headers .= "Content-type: text/html; charset=UTF-8\r\n";  
                                $headers .= "From: ProMujer IFD < promujer@promujer.org >\r\n";
                                $bool = mail($destinatarios,$titulo,$mail,$headers);
                                if($bool){
                                    $sql2= "UPDATE seguridad set noti1=1 where id_segu=$arreglo[0]";
                                    $query2 = $con->query($sql2);
                                    if($query2!=null){
                                        echo "Se envio un correo electronico de notificacion a $arreglo[4]";
                                    }
                                    else{
                                        echo "Error interno del sistema, consulte con el administrador";
                                    }
                            }else{
                                echo "No se puede enviar correos electronicos, no se detecto conexion a internet";
                            }
                  }
                    }    
              }
              $nuevo3=strtotime("+1 week",strtotime($confi));
              $nuevo3=date("Y-m-d",$nuevo3);
              if ($arreglo[6]<date("Y-m-d")) {
                  $campo="vencido";
                  if ($arreglo[13]!=""&&$arreglo[16]!=1) {
                        if ($arreglo[6]<$nuevo3 && $arreglo[6]<date("Y-m-d")) {
                            if ($arreglo[17]!=1) {
                                $destinatarios=$arreglo[13];
                                $titulo = "Notificacion de conclusion de contrato";
                                $mail = "Promujer informa a la empresa $arreglo[4] que su contrato de seguridad con la regional $arreglo[2] tiene mas de una semaba vencida, Que tenga una excelente jornada";
                                $headers = "MIME-Version: 1.0\r\n"; 
                                $headers .= "Content-type: text/html; charset=UTF-8\r\n";  
                                $headers .= "From: ProMujer IFD < promujer@promujer.org >\r\n";
                                $bool = mail($destinatarios,$titulo,$mail,$headers);
                                if($bool){
                                    $sql2= "update seguridad set noti4=1 where id_segu=$arreglo[0]";
                                    $query2 = $con->query($sql2);
                                    if($query2!=null){
                                        echo "Se envio un correo electronico de notificacion a $arreglo[4]";
                                    }
                                    else{
                                        echo "Error interno del sistema, consulte con el administrador";
                                    }
                            }else{
                                echo "No se puede enviar correos electronicos, no se detecto conexion a internet";
                            }
                            }
                        }
                        else{
                            $destinatarios=$arreglo[13];
                            $titulo = "Notificacion de conclusion de contrato";
                            $mail = "Promujer informa a la empresa $arreglo[4] que su contrato de seguridad con la regional $arreglo[2] acaba de vencer, Que tenga una excelente jornada";
                            $headers = "MIME-Version: 1.0\r\n"; 
                            $headers .= "Content-type: text/html; charset=UTF-8\r\n";  
                            $headers .= "From: ProMujer IFD < promujer@promujer.org >\r\n";
                            $bool = mail($destinatarios,$titulo,$mail,$headers);
                            if($bool){
                                $sql2= "update seguridad set noti3=1 where id_segu=$arreglo[0]";
                                $query2 = $con->query($sql2);
                                if($query2!=null){
                                        echo "Se envio un correo electronico de notificacion a $arreglo[4]";
                                    }
                                    else{
                                        echo "Error interno del sistema, consulte con el administrador";
                                    }
                            }else{
                                echo "No se puede enviar correos electronicos, no se detecto conexion a internet";
                            }
                        }
                  }
              }
            }
            mysqli_close($con);
     ?>