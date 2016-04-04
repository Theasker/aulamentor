<?php

// Creamos variables para que contengan los valores siguientes:
$radio = 200;
$margen = 20;
$paginas = 2;  // El documento sólo tiene 2.

try {
	// Creamos el objeto pdf y abrimos el documento PDF.
    $pdf = new PDFlib();
	// Forzamos el documento en formato UTF8 compatible con diferentes sistemas operativos
	$pdf->set_parameter("textformat", "utf8");
    if ($pdf->begin_document("", "") == 0) {
        die("Error al crear documento PDF: " . $pdf->get_errmsg());
    }
	
    // Incluimos algunos datos generales sobre el documento.
    $pdf->set_info("Author", "Curso de Iniciación PHP 5");
    $pdf->set_info("Creator", "index.php");
    $pdf->set_info("Title", "Reloj analógico");
    $pdf->set_info("CustomField", "Ejemplo 5 - Unidad 8 - Curso de Iniciación PHP 5");

	while($paginas-- > 0)  // Abrimos un bucle para crear las dos páginas.
 	{
        // Abrimos la página que tiene este documento y fijamos su tamaño.
        $pdf->begin_page_ext(0, 0, "width=a4.width height=a4.height");

        // Fijamos la fuente, su tamaño y color para el título.
        $pdf->setfont($pdf->load_font("Courier", "winansi", ""), 30);
        $pdf->setcolor("both", "rgb", 1.0, 0.0, 0.0, 0.0);        

        // Escribimos el título de la página.
        $pdf->show_xy("Curso de Iniciación de PHP 5",75,530);

        // Fijamos la fuente, su tamaño y color para el subtítulo.
        $pdf->setfont($pdf->load_font("Courier", "winansi",""), 20);
        $pdf->setcolor("both", "rgb", 0.0, 0.0, 1.0, 0.0);

        // Escribimos el subtítulo de la página.
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
            // Combinando esta cuatro órdenes logramos dibujar
            // las rayitas de los minutos en el aro de la esfera.

            // En cada vuelta del bucle hacemos esto:

            // Hacer rotar el puntero 6 grados.
            $pdf->rotate(6.0);
            // Llevarlo a la posición donde tiene que escribir.
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
        // Con la fórmula fijamos los grados que debe rotar
        // la manilla de las horas para reflejar la hora actual.
        $pdf->rotate(-(($hora['minutes']/60.0)+$hora['hours']-3.0)*30.0);
        $pdf->moveto(-$radio/10,-$radio/20);
        // Dibujamos una línea de la aguja.
        $pdf->lineto($radio/2,0.0);
        // Dibujamos la otra línea de la aguja.
        $pdf->lineto(-$radio/10,$radio/20);
        // Cerramos el camino abierto.
        $pdf->closepath();
        // Rellenamos con negro (color actual) el interior de las dos líneas.
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

        // Dibujamos el círculo que aparece en el centro.
        $pdf->circle(0,0,$radio/30);
        $pdf->fill();
        $pdf->restore();
     	// Cerramos la página
        $pdf->end_page_ext("");
    } // end while
	// Cerramos documento	
    $pdf->end_document("");
    // Obtenemos en un bufer el contenido del fichero PDF creado	 
    $bufer=$pdf->get_buffer();
	// Leemos el tamaño de este contenido
    $len=strlen($bufer);
    // Creamos una cabecera de tipo PDF y longitud len
    header("Content-type: application/pdf");
    header("Content-Length: $len");
    header("Content-Disposition: inline; filename=reloj.pdf");
    
    // Presentamos en la pantalla el resultado volcando el bufer. Como se trata de
    // un documento PDF, se arranca el programa Acrobat Reader.
    print $bufer;
}
catch (PDFlibException $e) {
    die("Ocurrió un Excepción PDFlib en el ejemplo reloj:\n" .
    "[" . $e->get_errnum() . "] " . $e->get_apiname() . ": " .
    $e->get_errmsg() . "\n");
}
catch (Exception $e) {
    die($e);
}
$pdf->delete();
$pdf = 0;
?>