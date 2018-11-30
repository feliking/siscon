<?php
            extract($_GET);
            require("../controller/conexion.php");
            $fecha=date('Y-m-d');
            $llenado="aa";
            $sql="SELECT * FROM licenciafun WHERE id_licfu=$id";
            $ressql=mysqli_query($con,$sql);
            while ($row=mysqli_fetch_row ($ressql)){
              $region=$row[1];
              $centro_focal=$row[2];
              $tipo_centro_focal=$row[3];
              $fecha_ini=$row[4];
              $fecha_fin=$row[5];
            }
            $sql2= "insert into bajalicencia(region,centro_focal,licencia_de_funcionamiento,fecha_baja,responsable) values('$region','$centro_focal','Se dio de baja','$fecha',0)";
            $query2 = $con->query($sql2);
            if($query2!=null){
                $sql3= "SELECT respaldo,respaldo_patentes FROM licenciafun WHERE id_licfu=$id";
                $query3 = $con->query($sql3);
                $fila=mysqli_fetch_row($query3);
                if (!$fila[0]==null) {
                    unlink("../files/licenciafun/respaldo/$fila[0]");
                }
                if (!$fila[1]==null) {
                    unlink("../files/licenciafun/patentes/$fila[1]");
                }
                $sql= "delete from licenciafun where id_licfu=$id";
                $query = $con->query($sql);

                print "<script>alert(\"Se dio de baja a la licencia correctamente\");window.location='../views/funcionamiento.php';</script>";
                mysqli_close($con);
            }
            else{
                print "<script>alert(\"Error interno del sistema, consulte con el administrador\");window.location='../views/funcionamiento.php';</script>";
                mysqli_close($con);
            }
    ?>