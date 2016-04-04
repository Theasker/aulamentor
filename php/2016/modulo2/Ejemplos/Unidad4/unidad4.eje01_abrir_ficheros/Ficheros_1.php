<HTML>
<HEAD></HEAD>
<BODY>

<?

// La POO (Programación Orientada a Objetos)

echo "<H1><CENTER>La Programación Orientada a Objetos (POO)</H1></CENTER><P> ";
echo "<H3><CENTER>Creamos una clase que llamamos \$calculadora1
     y un objeto que llamamos \$calculos. Pasamos como argumentos del objeto
     las variables \$a, que contiene 25, y \$b, que contiene 5.</H3></CENTER>";

class calculadora1
{
      function calculadora1 ($a,$b)
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
     y un objeto que llamamos \$calculos2. Pasamos como argumentos
     las variables \$a, que contiene 100, y \$b, que contiene 20,
     ahora como parámetros de los métodos.</H3></CENTER>";
class calculadora2
{
      function sumar2($a,$b)
      {
             $this->op1=$a;
             $this->op2=$b;
             return ($this->op1+$this->op2);
      }
      function restar2($a,$b)
      {
             return ($this->op1-$this->op2);
      }
      function producto2($a,$b)
      {
             return ($this->op1*$this->op2);
      }
      function cociente2($a,$b)
      {
             return ($this->op1/$this->op2);
      }

}
$calculos2=new calculadora2();
$a=100;
$b=20;
print ("La suma es: <B>".$calculos2->sumar2($a,$b)."</B>.<P>");
print ("La resta es: <B>".$calculos2->restar2($a,$b)."</B>.<P>");
print ("El producto es: <B>".$calculos2->producto2($a,$b)."</B>.<P>");
print ("El cociente es: <B>".$calculos2->cociente2($a,$b)."</B>.<P>");

echo "<H3><CENTER>Creamos otra clase que llamamos \$calculadora3
     que hereda de \$calculadora1 las propiedades y métodos. Además,
     calcula el cuadrado del primer número que recibe (\$a=25).</H3></CENTER>";

class calculadora3 extends calculadora1
{
      function cuadrado()
      {
           return ($this->op1*$this->op1);
      }
}
$a=25;
$b=5;
$calculos3=new calculadora3($a,$b);
print ("La suma es: <B>".$calculos3->sumar1()."</B>.<P>");
print ("La resta es: <B>".$calculos3->restar1()."</B>.<P>");
print ("El producto es: <B>".$calculos3->producto1()."</B>.<P>");
print ("El cociente es: <B>".$calculos3->cociente1()."</B>.<P>");
print ("El cuadrado del primer número es: <B>".$calculos3->cuadrado()."</B>.<P>");

?>
</BODY>
</HTML>

