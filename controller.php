<?php 
include('conn.php');
/****
 * Server Functions
 * DATABASE: mitorneo_marketpulse
 */

//Display data
function index()
{

    $conn = conection();
    $sql = "SELECT * FROM TREZA LIMIT 30";//Change before deploy
    $results = mysqli_query($conn,$sql);
    
    $content = array();

    //data management
    while ($row = mysqli_fetch_assoc($results)) {
        $content[] = $row;
    }

    return $content;
}

//Storage Data
/**
 * Table selection for saving data in CSV format.
 * 
 */
function store($file,$selection)
{
    
    
    $conn = conection();
    $f_csv = fopen($file,'r');
   
    
    $date = date('Y-m-d');//Actual Timestamp

  /**
   * Table name: ANIQ 
   * COLUMNS: 32
   *  */  
  if($selection == 'ANIQ' ){
   if($f_csv ){
    $row = false;//To ignore first row of csv file
    while($data = fgetcsv($f_csv,1000,',')):
        if($row){
        $sql_aniq = "INSERT INTO ANIQ (tope,rfc,nombre,direccion,aduana,estado,agente,pedimento,tipo_ped,pedimen,fecha_n,mesa,cv_doc,documen,p_vc,paisesv,p_od,paiso,fraccion,sec,cantidad,uni_med,unidad,val_adu,valor_dls,val_com,t_c,`desc`,precio,precio_usd,fecha_captura) VALUES (".$data[0].",'".$data[1]."','".$data[2]."','".$data[3]."','".$data[4]."','".$data[5]."','".$data[6]."','".$data[7]."','".$data[8]."','".$data[9]."','".$data[10]."','".$data[11]."','".$data[12]."','".$data[13]."','".$data[14]."','".$data[15]."','".$data[16]."','".$data[17]."','".$data[18]."','".$data[19]."','".$data[20]."','".$data[21]."','".$data[22]."','".$data[23]."','".$data[24]."','".$data[25]."','".$data[26]."','".$data[27]."',".$data[28].",".$data[29].",'".$date."')"; 
        $results = mysqli_query($conn,$sql_aniq);

        }
        $row = true;
    endwhile;
    fclose($f_csv);

   return "Subida exitosa";


}else{

    return "Error al subir archivo, o formato incompatible";
}
/**
   * Table name: PENTA 
   * COLUMNS: 23
   *  */ 
} else if($selection == 'PENTA'){
    if($f_csv){
        $row = false;//To ignore first row of csv file
        while($data = fgetcsv($f_csv,1000,',')):
            if($row){
            $sql_penta = "INSERT INTO PENTA (ordinal,fecha,codigosa,paisdeorigen,importador,direccionimportador,ciudadimportador,estadoimportacion,proveedor,direccionproveedor,ciudadproveedor,aduana,uscif,usunitario,cantidadcomercial,unidaddemedida,volumenfisico,uvf,kgsbrutos,transporte,documento,descripcionmercancia,fecha_captura) VALUES (".$data[0].",'".$data[1]."','".$data[2]."','".$data[3]."','".$data[4]."','".$data[5]."','".$data[6]."','".$data[7]."','".$data[8]."','".$data[9]."','".$data[10]."','".$data[11]."',".$data[12].",".$data[13].",'".$data[14]."','".$data[15]."',".$data[16].",'".$data[17]."',".$data[18].",'".$data[19]."','".$data[20]."','".$data[21]."','".$date."')"; 
            $results = mysqli_query($conn,$sql_penta);
    
            }
            $row = true;
        endwhile;
        fclose($f_csv);
    
       return "Subida exitosa";
    
    
    }else{
    
        return "Error al subir archivo, o formato incompatible";
    }
}else{
    return "La tabla no existe";
}

}

function userLogin($email,$password)
{
     $conn = conection();
     $sql_login = "SELECT * FROM logins WHERE user_email = '$email' AND password = '$password'";
     $results = mysqli_query($conn, $sql_login);
     
     if($data = $results->fetch_object()){
        return uniqid();
     }else{
        return 'Acceso denegado';
     }
}