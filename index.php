<?php
require 'vendor/autoload.php';

use Picqer\Barcode\BarcodeGeneratorPNG;

$generator = new BarcodeGeneratorPNG();
$barcodeNumber = '8991002101630'; // angka barcode mu, 13 digit (EAN-13)

// hasil barcode sebagai base64 image
$barcode = base64_encode($generator->getBarcode($barcodeNumber, $generator::TYPE_EAN_13));
?>
<!DOCTYPE html>
<html>
<head>
    <title>Print Barcode</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 20px;
        }
        .barcode-box {
            border: 1px solid #000;
            width: 300px;
            padding: 15px;
            margin: auto;
        }
        .barcode-top-text {
            font-size: 12px;
            letter-spacing: 4px;
            margin-bottom: 8px;
        }
        .barcode-img {
            width: 260px;
        }
        .barcode-bottom-number {
            font-size: 20px;
            font-weight: bold;
            letter-spacing: 3px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
<div class="barcode-box">
    <div class="barcode-top-text">jaoharil.com</div>
    <img class="barcode-img" src="data:image/png;base64,<?= $barcode ?>" alt="barcode">
    <div class="barcode-bottom-number"><?= $barcodeNumber ?></div>
</div>


</body>
</html>
