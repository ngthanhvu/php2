<?php
// require_once "model/CategoryModel.php";
// require_once "view/helpers.php";
// require_once 'core/BladeServiceProvider.php';
namespace App\Controllers;

use App\Models\CategoryModel;

class CategoryController
{

    private $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
    }

    public function index()
    {
        $categories = $this->categoryModel->index();
        renderView("view/admin/categories/index.php", compact('categories'), "Categories", "admin");
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = [];

            $name = $_POST['name'] ?? '';

            if (empty($name)) {
                $errors['name'] = 'Name is required';
            }

            if (!empty($errors)) {
                renderView("view/admin/categories/create.php", compact('errors'), "Create Category", "admin");
            } else {
                $this->categoryModel->create($name);
                $_SESSION['message'] = "Category created successfully!";
                header("Location: /admin/categories");
                exit;
            }
        } else {
            renderView("view/admin/categories/create.php", [], "Create Category", "admin");
        }
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];

            $this->categoryModel->update($id, $name);
            $_SESSION['message'] = "Category updated successfully!";
            header("Location: /admin/categories");
        } else {
            $category = $this->categoryModel->getCategoryById($id);
            renderView("view/admin/categories/edit.php", compact('category'), "Edit Category", "admin");
        }
    }

    public function delete($id)
    {
        $this->categoryModel->delete($id);
        $_SESSION['message'] = "Category deleted successfully!";
        header("Location: /admin/categories");
    }
}
