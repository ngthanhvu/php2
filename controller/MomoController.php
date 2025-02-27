<?php

namespace App\Controllers;

use App\Core\BladeServiceProvider;
use App\Models\OrderModel;
use App\Models\MailModel;

class MomoController
{
    private $partnerCode;
    private $accessKey;
    private $secretKey;
    private $momoUrl;
    private $returnUrl;
    private $orderModel;
    private $mailModel;

    public function __construct()
    {
        $this->partnerCode = 'MOMO';
        $this->accessKey = $_ENV['MOMO_ACCESS_KEY'];
        $this->secretKey = $_ENV['MOMO_SECRET_KEY'];
        $this->momoUrl = $_ENV['MOMO_URL'];
        $this->returnUrl = $_ENV['MOMO_RETURN_URL'];
        $this->orderModel = new OrderModel();
        $this->mailModel = new MailModel();
    }

    public function createPayment()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $orderId = time();
            $amount = $_POST['amount'];
            $requestId = $this->partnerCode . time();
            $orderInfo = "Thanh toán đơn hàng #$orderId";
            $requestType = "payWithATM";
            $extraData = "";

            $rawSignature = "accessKey={$this->accessKey}" .
                "&amount=$amount" .
                "&extraData=$extraData" .
                "&ipnUrl={$this->returnUrl}" .
                "&orderId=$orderId" .
                "&orderInfo=$orderInfo" .
                "&partnerCode={$this->partnerCode}" .
                "&redirectUrl={$this->returnUrl}" .
                "&requestId=$requestId" .
                "&requestType=$requestType";

            $signature = hash_hmac('sha256', $rawSignature, $this->secretKey);

            $requestData = json_encode([
                "partnerCode" => $this->partnerCode,
                "accessKey" => $this->accessKey,
                "requestId" => $requestId,
                "amount" => $amount,
                "orderId" => $orderId,
                "orderInfo" => $orderInfo,
                "redirectUrl" => $this->returnUrl,
                "ipnUrl" => $this->returnUrl,
                "extraData" => $extraData,
                "requestType" => $requestType,
                "signature" => $signature,
                "lang" => "vi"
            ]);

            // Gửi request đến MoMo API
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->momoUrl);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Content-Length: ' . strlen($requestData)
            ]);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $requestData);

            $response = curl_exec($ch);
            curl_close($ch);

            $result = json_decode($response, true);

            if (!empty($result['payUrl'])) {
                header("Location: " . $result['payUrl']);
                exit;
            } else {
                echo "Lỗi khi tạo thanh toán MoMo";
            }
        }
    }

    public function momoCallback()
    {
        $data = $_GET;

        if (!isset($data['orderId']) || !isset($data['resultCode'])) {
            echo "Dữ liệu callback không hợp lệ";
            return;
        }

        $secretKey = $_ENV['MOMO_SECRET_KEY'];

        $orderId = $data['orderId'];
        $amount = $data['amount'];
        $extraData = $data['extraData'] ?? '';
        $message = $data['message'] ?? '';
        $orderInfo = $data['orderInfo'] ?? '';
        $orderType = $data['orderType'] ?? '';
        $partnerCode = $data['partnerCode'] ?? '';
        $payType = $data['payType'] ?? '';
        $requestId = $data['requestId'] ?? '';
        $responseTime = $data['responseTime'] ?? '';
        $resultCode = $data['resultCode'] ?? '';
        $transId = $data['transId'] ?? '';

        $rawSignature = "accessKey=$this->accessKey" .
            "&amount=$amount" .
            "&extraData=$extraData" .
            "&message=$message" .
            "&orderId=$orderId" .
            "&orderInfo=$orderInfo" .
            "&orderType=$orderType" .
            "&partnerCode=$partnerCode" .
            "&payType=$payType" .
            "&requestId=$requestId" .
            "&responseTime=$responseTime" .
            "&resultCode=$resultCode" .
            "&transId=$transId";

        $calculatedSignature = hash_hmac('sha256', $rawSignature, $secretKey);

        if ($calculatedSignature === $data['signature']) {
            if ($resultCode == '0') {
                $code = $_SESSION['order_data']['code'];
                $this->orderModel->createOrder(
                    $_SESSION['order_data']['user_id'],
                    "completed",
                    $_SESSION['order_data']['payment_method'],
                    $amount,
                    $_SESSION['order_data']['address_id'],
                    $_SESSION['order_data']['new_address_data'],
                    $code
                );
                $this->mailModel->send(
                    $_SESSION['order_data']['email'],
                    "Xác nhận đơn hàng",
                    "mail_order",
                    ['order_id' => $orderId, 'code' => $code]
                );
                unset($_SESSION['order_data']);
                header("Location: /success?code=$code");
            } else {
                echo "Thanh toán thất bại.";
                header("Location: /errors");
            }
        } else {
            echo "Chữ ký không hợp lệ! <br>";
            echo "Chữ ký tính toán: $calculatedSignature <br>";
            echo "Chữ ký MoMo gửi về: " . $data['signature'] . "<br>";
            echo "Chuỗi dữ liệu ký: $rawSignature";
        }
    }
}
