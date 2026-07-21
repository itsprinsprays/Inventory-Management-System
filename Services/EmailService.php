<?php

class EmailService
{
    private $apiKey = "";

    public function sendRequestNotification($adminEmail, $requester, $product, $quantity)
    {
        $data = [
            "sender" => [
                "name" => "Inventory Management System",
                "email" => "prncbntz@gmail.com"
            ],
            "to" => [
                [
                    "email" => $adminEmail
                ]
            ],
            "subject" => "New Inventory Request",
            "htmlContent" => "
                <h2>New Inventory Request</h2>

                <p><strong>Requested By:</strong> {$requester}</p>

                <p><strong>Product:</strong> {$product}</p>

                <p><strong>Quantity:</strong> {$quantity}</p>

                <p>Please login to review this request.</p>
            "
        ];

        $ch = curl_init("https://api.brevo.com/v3/smtp/email");

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);

        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "accept: application/json",
            "api-key: {$this->apiKey}",
            "content-type: application/json"
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if (curl_errno($ch)) {
            error_log("cURL Error: " . curl_error($ch));
        } else {
            error_log("Brevo HTTP Code: " . $httpCode);
            error_log("Brevo Response: " . $response);
        }

        curl_close($ch);

        return $response;
    }
}