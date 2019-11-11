<?php

require_once 'clases/Ovni.php';

require_once __DIR__ . '/vendor/autoload.php';

header('content-type:application/pdf');

$mpdf = new \Mpdf\Mpdf(['orientation' => 'P', 
                        'pagenumPrefix' => 'Página nro. ',
                        'pagenumSuffix' => ' - ',
                        'nbpgPrefix' => ' de ',
                        'nbpgSuffix' => ' páginas']);


$mpdf->SetHeader('{PAGENO}{nbpg}');
$mpdf->setFooter('{PAGENO}');

/*----------------------------------------------------------------------------------------------------- */
$listado=(Ovni::Traer());
        
$tabla='<table border="5"><tr><td>TIPO</td><td>VELOCIDAD</td><td>PLANETA</td><td>FOTO</td>
                    <td>VEL WARP</td></tr>';
    for($i=0;$i<count($listado);$i++)
        {
            $tabla.="<tr><td>".$listado[$i]->tipo."</td><td>".$listado[$i]->velocidad."</td>
                        <td>".$listado[$i]->planeta."</td><td><img src='ovnis/imagenes/".$listado[$i]->foto."' height='100px' width='100px'></td>
                        <td>".$listado[$i]->ActivarVelocidadWarp()."</td></tr>";
        }
$tabla.="</table>";
/*----------------------------------------------------------------------------------------------------- */

$mpdf->WriteHTML($tabla);

$mpdf->Output();