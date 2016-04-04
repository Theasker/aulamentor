<?php

try {
	// Creamos el objeto pdf y abrimos el documento PDF.
    $pdf = new PDFlib();
	// Forzamos el documento en formato UTF8 compatible con diferentes sistemas operativos
	$pdf->set_parameter("textformat", "utf8");
    if ($pdf->begin_document("", "") == 0) {
        die("Error al crear documento PDF: " . $pdf->get_errmsg());
    }
	
    // Incluimos algunos datos generales sobre el documento.
    $pdf->set_info("Author", "Curso de Iniciaci�n PHP 5");
    $pdf->set_info("Creator", "index.php");
    $pdf->set_info("Title", "Imagen");
    $pdf->set_info("CustomField", "Ejemplo 6 - Unidad 8 - Curso de Iniciaci�n PHP 5");
    
    // El fichero de tipo jpg.
    $fic_imagen=getcwd() . "\\imagen.jpg";
    
    $imagen=$pdf->load_image("jpeg",$fic_imagen,"");
    if (!$imagen) {
    	die("No existe el fichero de la imagen ".$fic_imagen);
    }
    
    // Tomamos el tama�o (ancho y alto) de la imagen.
    $ancho=$pdf->get_value("imagewidth",$imagen);
    $alto=$pdf->get_value("imageheight",$imagen);
    
    // Generamos una p�gina que tenga las mismas dimensiones
    // que la imagen.
    $pdf->begin_page_ext($ancho,$alto, "");
    $pdf->fit_image($imagen,0,0, "");
    $pdf->close_image($imagen);
    $fuente = $pdf->load_font("Courier", "winansi", "");
    $pdf->setfont($fuente, 22);
    $pdf->setcolor("both", "rgb", 0.0, 0.0, 1.0, 0.0);
    // Escribimos el t�tulo de la p�gina.
    $pdf->show_xy("Final del ejemplo 6",15,10);
    // Cerramos la p�gina
    $pdf->end_page_ext("");
	// Cerramos documento	
    $pdf->end_document("");
    
    $bufer=$pdf->get_buffer();
    $len=strlen($bufer);
    
    header("Content-type: application/pdf");
    header("Content-Length: $len");
    header("Content-Disposition: inline; filename=imagen.pdf");
    
    // Presentamos en la pantalla el resultado. Como se trata de
    // un documento PDF, se arranca el programa Acrobat Reader.
    print $bufer;
    
    $pdf->delete();  // Borramos de la memoria el documento.
    exit;

	while($paginas-- > 0)  // Abrimos un bucle para crear las dos p�ginas.
 	{
        // Abrimos la p�gina que tiene este documento y fijamos su tama�o.
        $pdf->begin_page_ext(460,590, "");

        // Fijamos la fuente, su tama�o y color para el t�tulo.
        $pdf->setfont($pdf->load_font("Courier", "winansi", ""), 30);
        $pdf->setcolor("both", "rgb", 1.0, 0.0, 0.0, 0.0);        

        // Escribimos el t�tulo de la p�gina.
        $pdf->show_xy("Curso de Iniciaci�n de PHP 5",135,530);

        // Fijamos la fuente, su tama�o y color para el subt�tulo.
        $pdf->setfont($pdf->load_font("Courier", "winansi",""), 20);
        $pdf->setcolor("both", "rgb", 0.0, 0.0, 1.0, 0.0);

        // Escribimos el subt�tulo de la p�gina.
        $pdf->show_xy("CNICE - MECD",170,475);

        $pdf->setcolor("both", "rgb", 0.0, 0.0, 0.0, 0.0);
		
        // Definimos el origen de las coordenadas, es decir,
        // el punto relativo desde el cual se va a iniciar
        // el dibujo de las figuras.
        $pdf->translate($radio+$margen,$radio+$margen);
        $pdf->save();  // Guardamos estos valores de entorno.
        $pdf->setcolor("both", "rgb", 0.0, 0.0, 1.0, 0.0);
        $pdf->setlinewidth(2.0); // Fijamos la anchura del trazo.
        
        //  Dibujamos en la esfera los 60 trazos de los minutos.
        for ($i=0;$i<360;$i+=6)
        {
            // Combinando esta cuatro �rdenes logramos dibujar
            // las rayitas de los minutos en el aro de la esfera.

            // En cada vuelta del bucle hacemos esto:

            // Hacer rotar el puntero 6 grados.
            $pdf->rotate(6.0);
            // Llevarlo a la posici�n donde tiene que escribir.
            $pdf->moveto($radio,0.0);
            // Especificar la longitud de la raya.
            $pdf->lineto($radio-$margen/3,0.0);
            // Dibujar el trazo.
            $pdf->stroke();
        }
        // Recuperamos los valores de entorno guardados antes.
        $pdf->restore();
        $pdf->save();

	   // Fijamos una anchura mayor del trazo.
        $pdf->setlinewidth(3.0); 

        // Dibujamos en la esfera los 12 trazos cada cinco minutos
        // siguiendo los mismo pasos del bucle anterior, con otros
        // valores.
        for ($i=0;$i<360;$i+=30)
        {
            $pdf->rotate(30.0);
            $pdf->moveto($radio,0.0);
            $pdf->lineto($radio-$margen,0.0);
            $pdf->stroke();
        }

        // Tomamos la hora del sistema para representarla luego.
        $hora = getdate();

        // Dibujar la aguja de las horas.

        $pdf->save();
        // Con la f�rmula fijamos los grados que debe rotar
        // la manilla de las horas para reflejar la hora actual.
        $pdf->rotate(-(($hora['minutes']/60.0)+$hora['hours']-3.0)*30.0);
        $pdf->moveto(-$radio/10,-$radio/20);
        // Dibujamos una l�nea de la aguja.
        $pdf->lineto($radio/2,0.0);
        // Dibujamos la otra l�nea de la aguja.
        $pdf->lineto(-$radio/10,$radio/20);
        // Cerramos el camino abierto.
        $pdf->closepath();
        // Rellenamos con negro (color actual) el interior de las dos l�neas.
        $pdf->fill();
        $pdf->restore();

        // Dibujar la aguja de los minutos igual que la de las
        // horas con valores parecido.
        $pdf->save();
        $pdf->rotate(-(($hora['seconds']/60.0)+$hora['minutes']-15.0)*6.0);
        $pdf->moveto(-$radio/10,-$radio/20);
        $pdf->lineto($radio*0.8,0.0);
        $pdf->lineto(-$radio/10,$radio/20);
        $pdf->closepath();
        $pdf->fill();
        $pdf->restore();

        // Dibujamos la aguja de los segundos.
        $pdf->setcolor("both", "rgb", 1.0, 0.0, 0.0, 0.0);
        $pdf->setlinewidth(2);
        $pdf->save();
        $pdf->rotate(-(($hora['seconds']-15.0)*6.0));
        $pdf->moveto(-$radio/5,0.0);
        $pdf->lineto($radio,0.0);
        $pdf->stroke();
        $pdf->restore();

        // Dibujamos el c�rculo que aparece en el centro.
        $pdf->circle(0,0,$radio/30);
        $pdf->fill();
        $pdf->restore();
     	// Cerramos la p�gina
        $pdf->end_page_ext("");
    } // end while
	// Cerramos documento	
    $pdf->end_document("");
    	 
    $buf = $pdf->get_buffer();
    $len = strlen($buf);

    header("Content-type: application/pdf");
    header("Content-Length: $len");
    header("Content-Disposition: inline; filename=reloj.pdf");
    print $buf;
}
catch (PDFlibException $e) {
    die("Ocurri� un Excepci�n PDFlib en el ejemplo imagen:\n" .
    "[" . $e->get_errnum() . "] " . $e->get_apiname() . ": " .
    $e->get_errmsg() . "\n");
}
catch (Exception $e) {
    die($e);
}
$pdf->delete();
$pdf = 0;
?>


