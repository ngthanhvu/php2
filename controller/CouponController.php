<?php

namespace App\Controllers;

use App\Models\CouponModel;
use App\Core\BladeServiceProvider;

class CouponController
{

    private $couponModel;
    public function __construct()
    {
        $this->couponModel = new CouponModel();
    }

    public function index()
    {
        $title = "Quản lý mã giảm giá";
        $coupons = $this->couponModel->getAllCoupons();
        BladeServiceProvider::render('admin.coupons.index', compact('title', 'coupons'));
    }

    public function create()
    {
        $title = "Thêm mã giảm giá";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $errors = [];
            $code = $_POST['code'];
            $discount = $_POST['discount'];
            $type = $_POST['type'];
            $expiry_date = $_POST['expiry_date'];

            if (empty($code)) {
                $errors['code'] = 'Code is required';
            }

            if (empty($discount)) {
                $errors['discount'] = 'Discount is required';
            }

            if (empty($type)) {
                $errors['type'] = 'Type is required';
            }

            if (empty($expiry_date)) {
                $errors['expiry_date'] = 'Expiry date is required';
            }

            if (!empty($errors)) {
                BladeServiceProvider::render('admin.coupons.create', compact('errors', 'title'));
            } else {
                $this->couponModel->create($code, $discount, $type, $expiry_date);
                $_SESSION['message'] = 'Coupon created successfully';
                header('Location: /admin/coupons');
                exit;
            }
        } else {
            BladeServiceProvider::render('admin.coupons.create', compact('title'));
        }
    }

    public function update($id)
    {
        $title = "Cập nhật mã giảm giá";
        $coupon = $this->couponModel->getCouponById($id);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $errors = [];
            $code = $_POST['code'];
            $discount = $_POST['discount'];
            $type = $_POST['type'];
            $expiry_date = $_POST['expiry_date'];
            $status = $_POST['status'];

            $this->couponModel->update($id, $code, $discount, $type, $expiry_date, $status);
            $_SESSION['message'] = 'Coupon updated successfully';
            header('Location: /admin/coupons');
            exit;
        } else {
            BladeServiceProvider::render('admin.coupons.update', compact('title', 'coupon'));
        }
    }

    public function getCoupon()
    {
        $code = $_GET['code'];
        $coupon = $this->couponModel->getCouponByCode($code);
        // echo json_encode($coupon);
        if ($coupon) {
            echo json_encode($coupon);
        } else {
            echo json_encode(['success' => false]);
        }
    }
}
