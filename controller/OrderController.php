<?php

namespace App\Controllers;

use App\Models\OrderModel;
use App\Models\MailModel;
use App\Core\BladeServiceProvider;

class OrderController
{
    private $orderModel;
    private $mailModel;

    public function  __construct()
    {
        $this->orderModel = new OrderModel();
        $this->mailModel = new MailModel();
    }

    public function index()
    {
        $title = 'Orders';
        $orders = $this->orderModel->getAllOrders();
        BladeServiceProvider::render('admin.orders.index', compact('orders', 'title'));
    }

    public function createOrder()
    {
        $user_id = $_SESSION['user']['id'];
        $status = "pending";
        $payment_method = $_POST['payment_method'];
        $total_amount = $_POST['total_amount'];
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $email = $_POST['email'];

        $compact_address = "$name, $phone, $address, $email";

        if ($payment_method == "cod") {
            $order_id = $this->orderModel->createOrder($user_id, $status, $payment_method, $total_amount, $compact_address);
            $this->mailModel->send($email, "Order Confirmation", "Your order " . $order_id . " has been placed successfully");
            var_dump("Created Order ID:", $order_id);
            header('Location: /success');
        } elseif ($payment_method == "vnpay") {
            echo "VNPAY";
            //            header('Location: /payment');
        } elseif ($payment_method == "momo") {
            echo "Momo";
        }
    }

    public function updateStatus()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $status = $_POST['status'];
            $order_id = $_POST['order_id'];
            $this->orderModel->updateOrder($order_id, $status);
            $this->mailModel->send("vuntpk03365@gmail.com", "Order Status Update", "Order " . $order_id . " has been updated to " . $status);
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
}
