<?php

namespace App\Controllers;

use App\Models\AddressModel;
use App\Core\BladeServiceProvider;

class AddressController
{
    private $addressModel;

    public function __construct()
    {
        $this->addressModel = new AddressModel();
    }

    public function createAddress()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user_id = $_SESSION['user']['id'];
            $full_name = $_POST['full_name'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $this->addressModel->create($user_id, $full_name, $phone, $address);
            header('Location: /profile#address');
        }
    }

    public function updateAddress($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $full_name = $_POST['full_name'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $this->addressModel->update($id, $full_name, $phone, $address);
            header('Location: /profile#address');
        }
    }
}
