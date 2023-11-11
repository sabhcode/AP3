<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use TCPDF;

class TestController extends AbstractController
{
    #[Route('/test', name: 'app_test')]
    public function index(Request $request): Response
    {
        $pdf = new TCPDF();

        $marginLR = 10;

        $pdf->setAuthor("ALL4SPORT");
        $pdf->setTitle("Récapitulatif de votre commande num. 2");
        $pdf->setPrintHeader(false);
        $pdf->SetCellPadding(0);
        $tagvs = array('p' => array(0 => array('h' => 0, 'n' => 0), 1 => array('h' => 0, 'n'
        => 0)));
        $pdf->setHtmlVSpace($tagvs);
        $pdf->SetMargins($marginLR, 0);
        $pdf->setCellHeightRatio(1.25);
        $pdf->setImageScale(0.47);
        $pdf->AddPage();

        $imgdata = base64_decode("QzpcVXNlcnNcY29yZW5cQnVyZWF1XEFQM1xhcHBccHVibGljXG1lZGlhL2ltYWdlcy9oZWFkZXIvbG9nby5wbmc=");
        $pdf->Image($imgdata, $marginLR, 10, 10, 10, 'PNG', $request->server->get("SYMFONY_PROJECT_DEFAULT_ROUTE_URL"));
        $pdf->SetFont('helvetica', '', 10);

        $html = <<<HTML
            <style>
                .user_name {
                    font-size: 1.2em;
                    font-weight: bold;
                }
                
                table {
                    font-family: helvetica, sans-serif;
                }

                td {
                    text-align: center;
                    border: 0 solid #000;
                }
                
                th {
                    background-color: #000;
                    color: #fff;
                    text-align: center;
                    font-weight: bold;
                }
                
                .padding {
                    font-size: .5em;
                    color: #fff;
                }
                
                th.first,
                td.first {
                    width: 20px;
                }
                
                th.second,
                td.second {
                    width: 127px;
                }
                td.second {
                    text-align: justify;
                }
                
                th.third,
                td.third {
                    width: 40px;
                }
                
                th.four,
                td.four {
                    width: 60px;
                }
            </style>
            <div>
                <h1 style="text-align: center;">Confirmation de commande</h1>
            </div>
            <div>
                <p>Facturé et envoyé à</p>
                <p class="user_name">Corentin HANNOYE</p>
                <p>user1@gmail.com</p>
                <p>12 rue des buissons</p>
                <p>XXXXX Valenciennes</p>
            </div>
            <div style="overflow: hidden;">
                <table>
                    <tbody>
                        <tr>
                            <th class="first">
                                <p class="padding">&nbsp;</p>
                                <p class="lineheight">QTÉ</p>
                                <p class="padding">&nbsp;</p>
                            </th>
                            <th class="second">
                                <p class="padding">&nbsp;</p>
                                <p class="lineheight">DÉSIGNATION</p>
                                <p class="padding">&nbsp;</p>
                            </th>
                            <th class="third">
                                <p class="padding">&nbsp;</p>
                                <p class="lineheight">PRIX UNIT</p>
                                <p class="padding">&nbsp;</p>
                            </th>
                            <th class="four">
                                <p class="padding">&nbsp;</p>
                                <p class="lineheight">MONTANT</p>
                                <p class="padding">&nbsp;</p>
                            </th>
                        </tr>
                        <tr>
                            <td class="first">
                                <p class="padding">&nbsp;</p>
                                <p class="lineheight">3</p>
                                <p class="padding">&nbsp;</p>
                            </td>
                            <td class="second">
                                <p class="padding">&nbsp;</p>
                                <p class="lineheight">Mon super produit</p>
                                <p class="padding">&nbsp;</p>
                            </td>
                            <td class="third">
                                <p class="padding">&nbsp;</p>
                                <p class="lineheight">12,00 €</p>
                                <p class="padding">&nbsp;</p>
                            </td>
                            <td class="four">
                                <p class="padding">&nbsp;</p>
                                <p class="lineheight">36,00 €</p>
                                <p class="padding">&nbsp;</p>
                            </td>
                        </tr>
                        <tr>
                            <td class="first">
                                <p class="padding">&nbsp;</p>
                                <p class="lineheight">1</p>
                                <p class="padding">&nbsp;</p>
                            </td>
                            <td class="second">
                                <p class="padding">&nbsp;</p>
                                <p class="lineheight">Mon super produit2</p>
                                <p class="padding">&nbsp;</p>
                            </td>
                            <td class="third">
                                <p class="padding">&nbsp;</p>
                                <p class="lineheight">99,90 €</p>
                                <p class="padding">&nbsp;</p>
                            </td>
                            <td class="four">
                                <p class="padding">&nbsp;</p>
                                <p class="lineheight">99,90 €</p>
                                <p class="padding">&nbsp;</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        HTML;
        $pdf->writeHTML($html);

        return $this->render('test/index.html.twig', [
            'pdf' => $pdf->Output()
        ]);
    }
}
