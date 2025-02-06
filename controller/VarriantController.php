<?php
require_once "model/ColorModel.php";
require_once "model/SizeModel.php";
require_once 'view/helpers.php';

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
        $sizes = $this->sizeModel->getAllSizes();
        renderView('admin/sizes/index.php', compact('sizes'), "Sizes", 'admin');
    }

    public function indexColor()
    {
        $colors = $this->colorModel->getAllColors();
        renderView('admin/colors/index.php', compact('colors'), "Colors", 'admin');
    }

    public function createColor()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = [];
            $name = $_POST['name'];
            if (empty($name)) {
                $errors['name'] = 'Name is required';
            }

            if (!empty($errors)) {
                renderView('admin/colors/create.php', ['errors' => $errors], 'Create Color', 'admin');
            } else {
                $this->colorModel->create($name);
                $_SESSION['message'] = 'Color created successfully';
                header('Location: /admin/colors');
            }
        } else {
            renderView('admin/colors/create.php', [], 'Create Color', 'admin');
        }
    }

    public function createSize()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = [];
            $name = $_POST['name'] ?? '';
            if (empty($name)) {
                $errors['name'] = 'Name is required';
            }

            if (!empty($errors)) {
                renderView('admin/sizes/create.php', compact('errors'), 'Create Size', 'admin');
            } else {
                $this->sizeModel->create($name);
                $_SESSION['message'] = 'Size created successfully';
                header('Location: /admin/sizes');
            }
        } else {
            renderView('admin/sizes/create.php', [], 'Create Size', 'admin');
        }
    }

    public function updateColor($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = [];
            $name = $_POST['name'] ?? '';
            if (empty($name)) {
                $errors['name'] = 'Name is required';
            }

            if (!empty($errors)) {
                renderView('admin/colors/update.php', ['errors' => $errors], 'Update Color', 'admin');
            } else {
                $this->colorModel->update($id, $name);
                $_SESSION['message'] = 'Color updated successfully';
                header('Location: /admin/colors');
            }
        } else {
            $color = $this->colorModel->getColorById($id);
            renderView('admin/colors/update.php', ['color' => $color], 'Update Color', 'admin');
        }
    }

    public function updateSize($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = [];
            $name = $_POST['name'] ?? '';
            if (empty($name)) {
                $errors['name'] = 'Name is required';
            }

            if (!empty($errors)) {
                renderView('admin/sizes/update.php', ['errors' => $errors], 'Update Size', 'admin');
            } else {
                $this->sizeModel->update($id, $name);
                $_SESSION['message'] = 'Size updated successfully';
                header('Location: /admin/sizes');
            }
        } else {
            $size = $this->sizeModel->getSizeById($id);
            renderView('admin/sizes/update.php', ['size' => $size], 'Update Size', 'admin');
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
