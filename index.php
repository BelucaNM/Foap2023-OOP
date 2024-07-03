
<?php
require "classes.php";

// $persona1 = new Person();
// $persona1->nom = 'Ikram';
// $persona1->edad = 37;  da error porque no se puede acceder a un atributo privado
// $persona1->genere = 'femenino'; da error porque no se puede acceder a un atributo protected
// $persona1->saludar();

/* $persona2 = new Person('juan',40,'hombre','','',80);
$persona2->saludar();
echo $persona2->getEdat();
$persona2 ->setEdat(38);
*/
/*
$coche1 = new Coche('AlteaEcomotive','8172HHT',5,'Gris metalizado');
echo $coche1->getModelo().'<br>';
echo $coche1->getMatricula().'<br>';
echo $coche1->getPuertas().'<br>';
echo 'El coche ahora es '.$coche1->getColor().'<br>';
$coche1->arranca();
$coche1->para();
$coche1->setColor('blanco');
echo 'El coche ahora es '.$coche1->getColor().'<br>';
*/

/*$client1 = new Client ('Ikram',37,'mujer','123456789Z','Vilanova' , 50);
$client1->saludar();
$client1->asignarAgente();
echo $client1->getEdat().'<br>';

$empleat1 = new Empleat ('Juan',30,'hombre','123456789X','Sitges' , 60);
$empleat1->saludar();
$empleat1->setOficina('oficina1');
$empleat1->getOficina();
*/
$persona3 = new Person('juan',40,'hombre','','',80);
echo $persona3->getEdat();
Person::setDrinkingAge(21);
echo Person::$drinkingAge;
echo $persona3->getDrinkingAge();
// echo $persona3->$drinkingAge; da error
// echo $persona3->saludar('Jole!!'); da error porque la clase ya tiene una function saludar 

?>
