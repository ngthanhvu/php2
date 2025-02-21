<?php

namespace App\Controllers;

use App\Models\ColorModel;
use App\Models\SizeModel;
use App\Core\BladeServiceProvider;

class VarriantController
{
    public $colorModel;
    public $sizeModel;

    public function __construct()
    {
        $this->colorModel = new ColorModel();
        $this->sizeModel = new SizeModel();
    }

    public function indexSize()
    {
        $title = "Kích cỡ";
        $sizes = $this->sizeModel->getAllSizes();
        BladeServiceProvider::render('admin.sizes.index', compact('sizes', 'title'));
    }

    public function indexColor()
    {
        $title = "Màu sắc";
        $colors = $this->colorModel->getAllColors();
        BladeServiceProvider::render('admin.colors.index', compact('colors', 'title'));
    }

    public function createColor()
    {
        $title = "Thêm màu sắc";
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = [];
            $name = $_POST['name'];
            if (empty($name)) {
                $errors['name'] = 'Name is required';
            }

            if (!empty($errors)) {
                BladeServiceProvider::render('admin.colors.create', compact('errors', 'title'));
            } else {
                $this->colorModel->create($name);
                $_SESSION['message'] = 'Color created successfully';
                header('Location: /admin/colors');
            }
        } else {
            BladeServiceProvider::render('admin.colors.create', compact('title'));
        }
    }

    public function createSize()
    {
        $title = "Thêm kích cỡ";
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = [];
            $name = $_POST['name'] ?? '';
            if (empty($name)) {
                $errors['name'] = 'Name is required';
            }

            if (!empty($errors)) {
                BladeServiceProvider::render('admin.sizes.create', compact('errors', 'title'));
            } else {
                $this->sizeModel->create($name);
                $_SESSION['message'] = 'Size created successfully';
                header('Location: /admin/sizes');
            }
        } else {
            BladeServiceProvider::render('admin.sizes.create', compact('title'));
        }
    }

    public function updateColor($id)
    {
        $title = "Cập nhật màu sắc";
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = [];
            $name = $_POST['name'] ?? '';
            if (empty($name)) {
                $errors['name'] = 'Name is required';
            }

            if (!empty($errors)) {
                BladeServiceProvider::render('admin.colors.update', compact('errors', 'title'));
            } else {
                $this->colorModel->update($id, $name);
                $_SESSION['message'] = 'Color updated successfully';
                header('Location: /admin/colors');
            }
        } else {
            $color = $this->colorModel->getColorById($id);
            BladeServiceProvider::render('admin.colors.update', compact('color', 'title'));
        }
    }

    public function updateSize($id)
    {
        $title = "Cập nhật kích cỡ";
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = [];
            $name = $_POST['name'] ?? '';
            if (empty($name)) {
                $errors['name'] = 'Name is required';
            }

            if (!empty($errors)) {
                BladeServiceProvider::render('admin.sizes.update', compact('errors', 'title'));
            } else {
                $this->sizeModel->update($id, $name);
                $_SESSION['message'] = 'Size updated successfully';
                header('Location: /admin/sizes');
            }
        } else {
            $size = $this->sizeModel->getSizeById($id);
            BladeServiceProvider::render('admin.sizes.update', compact('size', 'title'));
        }
    }

    public function deleteColor($id)
    {
        $this->colorModel->delete($id);
        $_SESSION['message'] = 'Color deleted successfully';
        header('Location: /admin/colors');
    }

    public function deleteSize($id)
    {
        $this->sizeModel->delete($id);
        $_SESSION['message'] = 'Size deleted successfully';
        header('Location: /admin/sizes');
    }
}
