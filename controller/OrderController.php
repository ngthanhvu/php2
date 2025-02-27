<?php

namespace App\Controllers;

use App\Models\OrderModel;
use App\Models\ProductModel;
use App\Models\MailModel;
use App\Models\CouponModel;
use App\Core\BladeServiceProvider;

class OrderController
{
    private $orderModel;
    private $mailModel;
    private $productModel;
    private $couponModel;

    public function  __construct()
    {
        $this->orderModel = new OrderModel();
        $this->mailModel = new MailModel();
        $this->productModel = new ProductModel();
        $this->couponModel = new CouponModel();
    }

    public function index()
    {
        $title = 'Đơn hàng';
        $orders = $this->orderModel->getAllOrders();
        BladeServiceProvider::render('admin.orders.index', compact('orders', 'title'));
    }

    public function createOrder()
    {
        $user_id = $_SESSION['user']['id'];
        $status = "pending";
        $payment_method = $_POST['payment_method'];
        $total_amount = $_POST['total_amount'];
        $code = rand(100000, 999999);

        // Xử lý địa chỉ
        $address_id = isset($_POST['address_id']) ? $_POST['address_id'] : null;
        $new_address_data = null;

        if (!$address_id && isset($_POST['new_address'])) {
            $new_address_data = [
                'name' => $_POST['name'],
                'phone' => $_POST['phone'],
                'address' => $_POST['new_address'],
                'email' => $_POST['email']
            ];
        } elseif (!$address_id) {
            die("Vui lòng chọn địa chỉ hoặc nhập địa chỉ mới.");
        }

        $_SESSION['order_data'] = [
            'user_id' => $user_id,
            'status' => $status,
            'payment_method' => $payment_method,
            'total_amount' => $total_amount,
            'address_id' => $address_id,
            'new_address_data' => $new_address_data,
            'code' => $code
        ];

        if ($payment_method == "cod") {
            $order_id = $this->orderModel->createOrder($user_id, $status, $payment_method, $total_amount, $address_id, $new_address_data, $code);
            $this->mailModel->send($new_address_data['email'] ?? $_SESSION['user']['email'], "Xác nhận đơn hàng", "mail_order", ['order_id' => $order_id, 'code' => $code]);
            $products = $this->orderModel->getOrderDetailsById($order_id);
            if (is_array($products) && !empty($products)) {
                foreach ($products as $product) {
                    $this->productModel->UpdateQuanityAfterBuy($product['id'], $product['quantity']);
                }
            }
            header('Location: /success?code=' . $code);
        } elseif ($payment_method == "vnpay") {
            echo '<form id="vnpayForm" action="/payment/create" method="POST">';
            echo '<input type="hidden" name="amount" value="' . $total_amount . '">';
            echo '</form>';
            echo '<script>document.getElementById("vnpayForm").submit();</script>';
        } elseif ($payment_method == "momo") {
            echo '<form id="momoForm" action="/payment/momo/create" method="POST">';
            echo '<input type="hidden" name="amount" value="' . $total_amount . '">';
            echo '</form>';
            echo '<script>document.getElementById("momoForm").submit();</script>';
        }
    }

    public function updateStatus()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $status = $_POST['status'];
            $order_id = $_POST['order_id'];

            $shipping_address = $this->orderModel->updateOrder($order_id, $status);

            $parts = explode(", ", $shipping_address);

            $email = end($parts);

            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->mailModel->send(
                    $email,
                    "Cập nhật trạng thái đơn hàng",
                    "mail_status",
                    [
                        'name' => 'Khách hàng',
                        'order_id' => $order_id,
                        'status' => $status
                    ]
                );
            } else {
                var_dump("Invalid email format!");
            }

            $_SESSION['message_orders'] = "Order status updated successfully!";
            header('Location: /admin/orders');
        }
    }


    public function deleteOrder($order_id)
    {
        $this->orderModel->detailOrder($order_id);
        $_SESSION['message_orders'] = "Order deleted successfully!";
        header('Location: /admin/orders');
    }

    public function getOrdersById($id)
    {
        // $orders = $this->orderModel->getOrderById($id);
        $orders = $this->orderModel->detailOrder($id);
        if ($orders) {
            echo json_encode($orders);
        } else {
            echo json_encode(['success' => false]);
        }
    }
}
