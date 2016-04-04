<?php
    $fichero_pdf= getcwd() . "\\prueba.pdf";
    if (file_exists($fichero_pdf)) 
    		@unlink($fichero_pdf) 
    		or die("<b>No se puede borrar fichero pdf: '$fichero_pdf'. <br>Compruebe que no 
    				lo tiene abierto con otra aplicación</b>");
    
    // Creamos el objeto pdf y abrimos el documento PDF.
    $pdf = new PDFlib();
	// Forzamos el documento en formato UTF8 compatible con diferentes sistemas operativos
	$pdf->set_parameter("textformat", "utf8");
    if ($pdf->begin_document($fichero_pdf, "") == 0) { 
          die("<b>No se puede crear el fichero pdf: '$fichero_pdf'. <br>Compruebe que no 
    				lo tiene abierto con otra aplicación.</b> Error: ".$pdf->get_errmsg());
    }
    
    // Incluimos algunos datos generales sobre el documento.
    $pdf->set_info("Author", "Clodoaldo y David Robledo");
    $pdf->set_info("Creator", "Mentor - CNICE - MECD - 2014");
    $pdf->set_info("Title", "Confeccionar un documento PDF");
    $pdf->set_info("Subject", "Prueba");
    $pdf->set_info("Keywords", "Palabras de búsqueda");
    $pdf->set_info("CustomField", "Ejemplo 4 - Unidad 8 - Curso Iniciación de PHP 5");

    /* Abrimos la única página que tiene este documento y 
    	 fijamos su tamaño.*/
    $pdf->begin_page_ext(0, 0, "width=a4.width height=a4.height");
    
    $fuente = $pdf->load_font( "Courier", "winansi", "");
    $pdf->setfont( $fuente, 30);
    $pdf->setcolor( "both", "rgb", 0.0, 0.0, 1.0, 0.0);
        
    // Escribimos el título de la página.
    $pdf->show_xy("Curso de PHP 5",210,750);

    // Escribimos tres líneas con la fuente Times-Roman de 12 puntos
    // cambiando los colores, el espacio entre letras y entre palabras
    // en cada frase.
    $fuente = $pdf->load_font( "Times-Roman", "winansi", "");
    $pdf->setfont( $fuente, 12);    
    
    $pdf->setcolor( "both", "rgb", 0.0, 0.0, 0.0, 0.0);
    $pdf->show_xy("Este curso está pensado para aprender a crear páginas web dinámicas con PHP.",15,700);
    $pdf->setcolor( "both", "rgb", 1.0, 0.0, 0.0, 0.0);
    $pdf->set_value( "charspacing", 4);
    $pdf->show_xy("Pueden sacarle provecho las personas que ya sepan programar.",15,675);
    $pdf->set_value( "charspacing", 0);    
    $pdf->setcolor( "both", "rgb", 0.0, 1.0, 0.0, 0.0);
    $pdf->set_value( "wordspacing", 5);
    $pdf->show_xy("También conviene que tengan conocimientos de Internet y SQL.",15,650);
    $pdf->set_value( "wordspacing", 0);
    
    // Llevamos el puntero a otra posición, fijamos un nuevo color,
    // una nueva fuente y un espacio interlineal, y escribimos tres
    // líneas con tamaños de fuente diferentes.
    $pdf->set_text_pos(40,625);
    $pdf->setcolor( "both", "rgb", 0.0, 0.0, 0.0, 0.0);
    $pdf->set_value( "leading", 15);
    $fuente = $pdf->load_font( "Courier", "winansi", "");
    $pdf->setfont( $fuente, 18);
    $pdf->continue_text("Ministerio de Educación, Cultura y Deporte");
    $fuente = $pdf->load_font( "Courier", "winansi", "");
    $pdf->setfont( $fuente, 16);
    $pdf->continue_text("Centro Nacional de Información y Comunicación Educativas");
    $fuente = $pdf->load_font( "Courier", "winansi", "");
    $pdf->setfont( $fuente, 14);
    $pdf->continue_text("Proyecto Mentor");

    // En medio de la página mostramos el texto "PHP Versión 5"
    // bastante grande y con efectos especiales, en letra hueca
    // la primera palabra y resaltada el resto.
    $fuente = $pdf->load_font( "Times-Roman", "winansi", "");
    $pdf->setfont( $fuente, 50); 
    $pdf->set_value( "textrendering", 1);    
    $pdf->show_xy("PHP",200,520);
    $fuente = $pdf->load_font( "Courier", "winansi", "");
    $pdf->setfont( $fuente, 20);
    $pdf->set_value( "textrise", 30);
    $pdf->set_value( "textrendering", 0);
    $pdf->show_xy("Versión 5.5",350,500);

    // Mostramos otras tres frases, cada una en su línea,
    // mezclando los colores.
    $fuente = $pdf->load_font( "Times-Roman", "winansi", "");
    $pdf->setfont( $fuente, 16); 
    $pdf->setcolor( "both", "rgb", 0.5, 0.3, 0.9, 0.0);
    $pdf->set_text_pos(100,400);
    $pdf->show("Se utiliza un servidor XAMPP instalado en modo local.");
    $pdf->setcolor( "both", "rgb", 0.7, 0.4, 0.5, 0.0);    
    $pdf->set_text_pos(94,350);
    $pdf->show("XAMPP incluye un servidor de datos MySQL instalado en modo local.");
    $pdf->setcolor( "both", "rgb", 0.2, 0.2, 0.6, 0.0);    
    $pdf->set_text_pos(120,300);
    $pdf->show("Para las consultas se usa el lenguaje SQL.");
    
    // Cerramos la página que acabamos de elaborar.
    $pdf->end_page_ext("");
	
    // Cerramos documento
    $pdf->end_document("");

    echo "<HTML><HEAD>
    		<TITLE>Ejemplo 4 - Unidad 8 - Curso Iniciación de PHP 5</TITLE>
    	  </HEAD>
          <BODY><CENTER>
    			<H3>Hemos creado un documento PDF</H3><P>
    			<A HREF=prueba.pdf>Ver el resultado</A>
    	  </CENTER></BODY></HTML>";

?>
