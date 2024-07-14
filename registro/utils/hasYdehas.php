
<?php
// Este es le que crea en este momento, cada vez diferente y luego lo compara -- la comparación da bien 
$password ='beluca';
$passHash = password_hash($password, PASSWORD_DEFAULT);
echo $passHash.'<br>';
$result = password_verify($password, $passHash);
echo " El resultado de la  primer comparacion de BELUCA es ".$result.'<br>';

// Este es le que guardó en la BD al registrar un usuario BELUCA -- la comparación no da ningún resultado
$passHash ='$2y$10$FzFQY3tpgAOHsu2N4hFXPOj44HHY9fDbnkNZUk';
$result = password_verify($password, $passHash);
echo " El resultado de la segunda comparacion de BELUCA es ".$result.'<br>';

// Este es le que guardó para un usuario PEPE en la BD al registrarlo-- la comparación da bien 
$password ='pepe';
$passHash ='$2y$10$ri0HjoK9AJTECyBCNgovhOk4RK/lr9AFr8C94D4r.zEBbhoNxPuXG';
$result = password_verify($password, $passHash);
echo " El resultado de la comparacion de PEPE es ".$result.'<br>';
?>