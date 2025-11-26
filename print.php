<?php
require 'vendor/autoload.php';

use Picqer\Barcode\BarcodeGeneratorPNG;

$kode = $_POST['id'] ?? '';
$tipe = $_POST['tipe_barcode'] ?? '';

$generator = new BarcodeGeneratorPNG();
$typeConst = constant("Picqer\\Barcode\\BarcodeGenerator::" . $tipe);
// VALIDASI PANJANG BARCODE
$lengthRules = [
    'TYPE_ITF_14' => 14,
    'TYPE_EAN_13' => 13,
    'TYPE_UPC_A' => 12,
    'TYPE_UPC_E' => 8,
];

if (isset($lengthRules[$tipe])) {
    $required = $lengthRules[$tipe];
    if (strlen($kode) != $required) {
        die("<h3 style='font-family:Arial;color:red'>
            ❌ Barcode tipe $tipe harus $required digit<br>
            Anda memasukkan: " . strlen($kode) . " digit
            <br><a href='index.php'>Kembali</a>
        </h3>");
    }
}

$barcode = $generator->getBarcode($kode, $typeConst);

$barcodeBase64 = base64_encode($barcode);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Print Barcode</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f3f3;
            display: flex;
            justify-content: center;
            padding: 30px;
        }
        .label {
            width: 330px;
            background: #fff;
            border: 2px solid #000;
            border-radius: 12px;
            padding: 12px 16px;
            text-align: center;
        }
        .barcode img {
            width: 100%;
        }
        .kode {
            font-size: 20px;
            font-weight: bold;
            letter-spacing: 3px;
            margin-top: 5px;
        }
        /* Agar saat print border hilang & tampak profesional */
        @media print {
            body { background: none; }
            .label { border: none; }
        }
    </style>
</head>
<body>

<div class="label">
    <div class="barcode">
        <img src="data:image/png;base64,<?= $barcodeBase64 ?>">
    </div>
    <div class="kode"><?= $kode ?></div>
</div>



</body>
</html>
