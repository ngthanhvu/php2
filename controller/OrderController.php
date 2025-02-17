<?php
require_once "model/OrderModel.php";
require_once "model/MailModel.php";
require_once "view/helpers.php";
class OrderController
{
    private $orderModel;
    private $mailModel;

    public function  __construct()
    {
        $this->orderModel = new OrderModel();
        $this->mailModel = new Mailer();
    }

    public function index()
    {   
        $orders = $this->orderModel->getAllOrders();
        renderView('view/admin/orders/index.php', compact('orders'), 'Orders', 'admin');
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

        if($payment_method == "cod") {
            $order_id = $this->orderModel->createOrder($user_id, $status, $payment_method, $total_amount, $compact_address);
            $this->mailModel->send($email, "Order Confirmation", "Your order " . $order_id . " has been placed successfully");
            var_dump("Created Order ID:", $order_id);
            header('Location: /success');
        } elseif ($payment_method == "vnpay") {
            echo "VNPAY";
//            header('Location: /payment');
        } elseif($payment_method == "momo") {
            echo "Momo";
        }
    }

    public function updateStatus()
    {
        if($_SERVER["REQUEST_METHOD"] === "POST")
        {
            $status = $_POST['status'];
            $order_id = $_POST['order_id'];
            $this->orderModel->updateOrder($order_id, $status);
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
