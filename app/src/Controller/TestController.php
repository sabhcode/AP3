<?php

namespace App\Controller;

use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    #[Route('/test/pdf', name: 'app_test_pdf')]
    public function indexPDF(Request $request)
    {
        $options = new Options();
        $options->set('isRemoteEnabled', true);

        $pdf = new Dompdf($options);

        $imgdata = "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";

        $html = <<<HTML
            <!DOCTYPE html>
            <html lang="fr">
                <head>
                    <title>Confirmation de commande</title>
                    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;800;900&display=swap" rel="stylesheet"
                    <style>
        
                        * {
                            margin: 0;
                            padding: 0;
                            box-sizing: border-box;
                        }
                        
                        body {
                            font-family: "Montserrat", sans-serif;
                            line-height: 1;
                            padding: 40px 20px;
                        }
                        
                        .text_center {
                            text-align: center;
                        }
                    
                        .user_name {
                            font-size: 1.2em;
                            font-weight: bold;
                        }
                        
                        .header {
                            margin-bottom: 50px;
                        }
                        
                        .header a {
                            position: absolute;
                        }
                        
                        .user_infos {
                            margin-bottom: 50px;
                        }
                        
                        table {
                            width: 100%;
                            border: 1px solid #000;
                            border-collapse: collapse;
                        }
                        
                        th,
                        td {
                            padding: 8px 10px;
                        }
                        
                        th {
                            background-color: #000;
                            color: #fff;
                            text-transform: uppercase;
                        }

                        td {
                            border: 1px solid #000;
                        }
                        
                        .product_quantity {
                            width: 8%;
                        }
                        
                        .product_name {
                            width: 52%;
                        }
                        
                        .product_price {
                            width: 20%;
                        }
                        
                        .product_total_price {
                            width: 20%;
                        }
                    </style>
                </head>
                <body>
                    <div class="header">
                        <a href="http://localhost:8000">
                            <img src="data:image/png;base64,$imgdata" alt="Logo All4Sport" width="40">
                        </a>
                        <h1 class="text_center">Confirmation de commande</h1>
                    </div>
                    <div class="user_infos">
                        <p>Facturé et envoyé à</p>
                        <p class="user_name">Corentin HANNOYE</p>
                        <p>user1@gmail.com</p>
                        <p>12 rue des XXXXXXXX</p>
                        <p>XXXXX Valenciennes</p>
                    </div>
                    <div>
                        <table>
                            <tbody>
                                <tr>
                                    <th class="first">Qté</th>
                                    <th class="second">Désignation</th>
                                    <th class="third">Prix unit</th>
                                    <th class="four">Montant</th>
                                </tr>
                                <tr>
                                    <td class="text_center product_quantity">3</td>
                                    <td class="product_name">Mon super produit testtesttesttesttesttesttest</td>
                                    <td class="text_center product_price">12,00 €</td>
                                    <td class="text_center product_total_price">36,00 €</td>
                                </tr>
                                <tr>
                                    <td class="text_center product_quantity">1</td>
                                    <td class="product_name">Mon super produit2</td>
                                    <td class="text_center product_price">99,90 €</td>
                                    <td class="text_center product_total_price">99,90 €</td>
                                </tr>
                                <tr>
                                    <td class="text_center product_quantity">10</td>
                                    <td class="product_name">Mon super produit3</td>
                                    <td class="text_center product_price">10,01 €</td>
                                    <td class="text_center product_total_price">100,10 €</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </body>
            </html>
        HTML;
        $pdf->loadHtml($html);
        $pdf->render();
        $pdf->stream("confirmation-de-commande", ["Attachment" => false]);

        exit();
    }

    #[Route('/test', name: 'app_test')]
    public function index(Request $request): Response
    {
        return $this->render("test/test.html.twig");
    }
}
