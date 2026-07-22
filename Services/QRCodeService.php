<?php

class QRCodeService
{
    public function generateQRCode($text)
    {
        $encodedText = urlencode($text);
        $url = "https://api.qrserver.com/v1/create-qr-code/?size=250x250&data={$encodedText}";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);

        $imageData = curl_exec($ch);

        if (curl_errno($ch)) {
            error_log("QR Code API Error: " . curl_error($ch));
            curl_close($ch);
            return null;
        }

        curl_close($ch);

        // Return as base64 so it can be embedded directly in HTML
        return base64_encode($imageData);
    }
}