<?php

namespace App\Controllers;

use App\Core\BladeServiceProvider;
use App\Models\SettingModel;

class SettingController
{
    private $settingModel;

    public function __construct()
    {
        $this->settingModel = new SettingModel();
    }

    public function index()
    {
        $title = "Cài đặt";
        $setting = $this->settingModel->getSetting();
        BladeServiceProvider::render('admin.setting.index', compact('setting', 'title'));
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = [];

            if (isset($_FILES['banner']) && $_FILES['banner']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = 'uploads/';
                $imageName = basename($_FILES['banner']['name']);
                $imagePath = $uploadDir . time() . "_" . $imageName;

                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                $fileType = $_FILES['banner']['type'];

                if (!in_array($fileType, $allowedTypes)) {
                    $errors['banner'] = 'Only JPG, PNG, and GIF files are allowed';
                } else {
                    if (!move_uploaded_file($_FILES['banner']['tmp_name'], $imagePath)) {
                        $errors['banner'] = 'Failed to upload image';
                    }
                }
            } else {
                $errors['banner'] = 'Image is required';
            }

            if (empty($errors)) {
                $this->settingModel->create($imagePath);
                header('Location: /admin/setting');
                exit;
            } else {
                var_dump($errors);
            }
        }
    }
}
