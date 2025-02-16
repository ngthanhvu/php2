<?php
require_once "model/OrderModel.php";
require_once "view/helpers.php";
class OrderController
{
    private $orderModel;

    public function  __construct()
    {
        $this->orderModel = new OrderModel();
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

        var_dump("Creating Order with:", $compact_address, $total_amount, $payment_method, $status, $user_id);

        $order_id = $this->orderModel->createOrder($user_id, $status, $payment_method, $total_amount, $compact_address);

        // var_dump("Created Order ID:", $order_id);
        header('Location: /success');
    }
}
