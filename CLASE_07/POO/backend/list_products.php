<?php

require_once  '../vendor/autoload.php';
include_once './producto.php';
require_once './AccesoDatos.php';

echo "Listado Productos";
// header('content-type:application/pdf');

// $mpdf = new \Mpdf\Mpdf(['orientation' => 'P', 
//                         'pagenumPrefix' => 'Página nro. ',
//                         'pagenumSuffix' => ' - ',
//                         'nbpgPrefix' => ' de ',
//                         'nbpgSuffix' => ' páginas']);//P-> vertical; L-> horizontal



// $mpdf->SetHeader('{DATE j-m-Y}||{PAGENO}{nbpg}');
// //alineado izquierda | centro | alineado derecha
// $mpdf->setFooter('{DATE Y}|Programacón III|{PAGENO}');

// $traigo_productos=producto::TraerTodosLosProductos();
// var_dump($traigo_productos);

// $grilla = '<table class="table" border="1" align="center">
//             <thead>
//                 <tr>
//                     <th>  ID </th>
//                     <th>  CODIGO BARRA    </th>
//                     <th>  NOMBRE    </th>
//                     <th>  FOTO       </th>
//                 </tr> 
//                 </thead>'; 

// foreach ($traigo_productos as $prod){
//     $producto = array();
//     $producto["codigo_barra"] = $prod->GetCodBarra();
//     $producto["nombre"] = $prod->GetNombre();
                
//     $grilla .= "<tr>
//                     <td>".$prod->GetCodBarra()."</td>
//                     <td>".$prod->GetNombre()."</td>
//                     <td><img src='archivos/".$prod->GetPathFoto()."' width='100px' height='100px'/></td>
//                 </tr>";
//                 }
                
// $grilla .= '</table>';


// $mpdf->WriteHTML("<h3>Listado de productos</h3>");
// $mpdf->WriteHTML("<br>");

// $mpdf->WriteHTML($grilla);
                
                
// $mpdf->Output('mi_pdf_users.pdf', 'I');
                