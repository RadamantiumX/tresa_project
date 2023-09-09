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
/**
 * User Auth
 * Table: Login
 */
function userLogin($email,$password)
{
     $conn = conection();
     //$password_encoded = base64_encode($password);

     $sql_login = "SELECT userID,user_email,user_name,password FROM logins WHERE user_email = '$email'";
     $results = mysqli_query($conn, $sql_login);
     

     //Table Validation
     if($data = $results->fetch_object()){
        //$row = $results->fetch_assoc();
     // $decoded = base64_decode($data['password']) ;
       //Password validation
     
        $hash = $data->password;

        if(password_verify($password,$hash)){
             return array(['token'=>uniqid(),'user'=>$data]) ;//Token Creation
        }else{
            return 'Acceso denegado';
        }
        
         
      
        
     }else{
        return 'Acceso denegado';
     }
}

function passwordRecovery($email_send)
{
    $conn = conection();
    $sql_recovery = "SELECT * FROM logins WHERE user_email = '$email_send'";
    $results = mysqli_query($conn,$sql_recovery);
   // $res = mysqli_num_rows($results);

    //Table Validation
    if($data=$results->fetch_object()){
       $message = '<div>
          <p><b>Saludos!</b></p>
          <p>Estas recibiendo este mail para restablecer la contraseña para ingresar a tu cuenta</p></br>
          <p>Utiliza el siguiente link para realizar esta acción:<a href="http://localhost/tresa/password-recovery.html?secret='.uniqid().'">LINK</a> </p>
          <p>Si no solicitó el reestablecimiento de contraseña no necesita realizar esta acción.</p>
       </div>'; 

       include_once("SMTP/class.phpmailer.php");
       include_once("SMTP/class.smtp.php");
       $email = $email_send;

       $mail = new PHPMailer;
       $mail->SMTPDebug = 0; 
      
       
       $mail->isSMTP();
       $mail->Host = 'mail.dtscmexico.com';
       $mail->SMTPAuth = true;
       $mail->Username = 'admin@dtscmexico.com';
       $mail->Password = 'SeBa2010!&%$p';
       $mail->SMTPSecure = 'ssl';
       $mail->Port = 465;
       
       $mail->setFrom('admin@dtscmexico.com','Treza');
       $mail->addAddress($email);
       $mail->isHTML(true);

       $mail->Subject = 'Reestablecimiento de clave cuenta Treza';    
       $mail->Body = $message;
       $mail->send();
       if($mail->send()){
         return 'Se envio un mail para el reestablecimiento de la clave. Por favor revise su correo.';
       }else{
        return 'El email ingresado no pertenece a un usuario';
       }
    }
}

function passwordReset($password,$email)
{
   $conn = conection();
   $password_encode = password_hash($password, PASSWORD_BCRYPT);
   $sql_reset = "UPDATE logins SET password = '$password_encode' WHERE user_email = '$email'";
   $result = mysqli_query($conn, $sql_reset);

   if($result){
     return 'Contraseña actualizada con exito!';
   }else{
    return 'Ha ocurrido un error';
   }
}

function register($email,$user_name,$password)
{
    $conn = conection();
    $password_encode = password_hash($password, PASSWORD_BCRYPT) ;        //base64_encode($password);
    $sql_register = "INSERT INTO logins (user_email,user_name,password) VALUES ('$email','$user_name','$password_encode')";

    $result = mysqli_query($conn, $sql_register);

    return 'Usuario registrado con exito';
}
