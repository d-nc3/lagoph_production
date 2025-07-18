<?php

/**
 * @author   Natan Felles <natanfelles@gmail.com>
 */
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
defined('BASEPATH') or exit('No direct script access allowed');



if (!function_exists('generate_qr_code')) {
    function generate_qr_code($data)
    {
        // Create a new QR code with the provided data
        $qrCode = new QrCode($data);
        $qrCode->setSize(300); // Set size of QR code

        // Use the PngWriter to write the QR code as PNG
        $writer = new PngWriter();

        // Set the content type to image/png to tell the browser to expect a PNG image
        header('Content-type: image/png');

        // Output the QR code directly to the browser
        echo $writer->write($qrCode)->getString();
    }
}

