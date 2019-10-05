<?php

require_once  '../vendor/autoload.php';
include_once './usuario.php';
require_once './AccesoDatos.php';

header('content-type:application/pdf');

$mpdf = new \Mpdf\Mpdf(['orientation' => 'P', 
                        'pagenumPrefix' => 'Página nro. ',
                        'pagenumSuffix' => ' - ',
                        'nbpgPrefix' => ' de ',
                        'nbpgSuffix' => ' páginas']);//P-> vertical; L-> horizontal



$mpdf->SetHeader('{DATE j-m-Y}||{PAGENO}{nbpg}');
//alineado izquierda | centro | alineado derecha
$mpdf->setFooter('{DATE Y}|Programacón III|{PAGENO}');

$traigo_usuarios=usuario::TraerTodosLosUsuarios();


$grilla = '<table class="table" border="1" align="center">
            <thead>
                <tr>
                    <th>  ID </th>
                    <th>  NOMBRE     </th>
                    <th>  APELLIDO     </th>
                    <th>  PERFIL     </th>
                    <th>  FOTO       </th>
                </tr> 
                </thead>'; 

foreach ($traigo_usuarios as $user){
    $grilla .= "<tr>
                        <td>".$user->id."</td>
                        <td>".$user->nombre."</td>
                        <td>".$user->apellido."</td>
                        <td>".$user->perfil."</td>
                        <td><img src='archivos/".$user->foto."' width='100px' height='100px'/></td>
                        </tr>";
                }
                
$grilla .= '</table>';


$mpdf->WriteHTML("<h3>Listado de usuarios</h3>");
$mpdf->WriteHTML("<br>");

$mpdf->WriteHTML($grilla);
                
                
$mpdf->Output('mi_pdf_users.pdf', 'I');
                