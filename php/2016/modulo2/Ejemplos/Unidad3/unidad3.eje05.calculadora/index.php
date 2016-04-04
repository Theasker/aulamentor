<HTML>
<HEAD><TITLE>Ejemplo 5 - Unidad 3 - Curso Iniciación de PHP 5</TITLE></HEAD>
<BODY>

<?php

// La POO (Programación Orientada a Objetos)

echo "<CENTER>
		<H1>La Programación Orientada a Objetos (POO)</H1><P>
		<H3>Creamos una clase que llamamos \$calculadora1
			y un objeto que llamamos \$calculos. Pasamos como argumentos 
			del objeto las variables \$a, que contiene 25, y \$b, que 
			contiene 5.</H3>
     </CENTER>";

class calculadora1
{
      protected $op1=0;
      protected $op2=0;
      function calculadora1 ($a,$b) //Esto es el constructor
      {
            $this->op1=$a;
            $this->op2=$b;
      }
      function sumar1()
      {
            return ($this->op1+$this->op2);
      }
      function restar1()
      {
            return ($this->op1-$this->op2);
      }
      function producto1()
      {
            return ($this->op1*$this->op2);
      }
      function cociente1()
      {
            return ($this->op1/$this->op2);
      }
}

$a=25;
$b=5;
$calculos1=new calculadora1($a,$b);
print ("La suma es: <B>".$calculos1->sumar1()."</B>.<P>");
print ("La resta es: <B>".$calculos1->restar1()."</B>.<P>");
print ("El producto es: <B>".$calculos1->producto1()."</B>.<P>");
print ("El cociente es: <B>".$calculos1->cociente1()."</B>.<P>");


echo "<H3><CENTER>Creamos otra clase que llamamos \$calculadora2
     que hereda de \$calculadora1 las propiedades y métodos. Además,
     calcula el cuadrado del primer número que recibe (\$a=25).
     </H3></CENTER>";

class calculadora2 extends calculadora1
{
      function cuadrado()
      {
           return ($this->op1*$this->op1);
      }
}
$a=25;
$b=5;
$calculos2=new calculadora2($a,$b);
print ("La suma es: <B>".$calculos2->sumar1()."</B>.<P>");
print ("La resta es: <B>".$calculos2->restar1()."</B>.<P>");
print ("El producto es: <B>".$calculos2->producto1()."</B>.<P>");
print ("El cociente es: <B>".$calculos2->cociente1()."</B>.<P>");
print ("El cuadrado del primer número es: <B>".$calculos2->cuadrado()."</B>.<P>");

?>
</BODY>
</HTML>

