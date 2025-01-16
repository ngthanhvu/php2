<?php
require_once "model/CategoryModel.php";
require_once "view/helpers.php";

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
        renderView("view/categories/index.php", compact('categories'), "Categories");
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
                renderView("view/categories/create.php", compact('errors'), "Create Category");
            } else {
                $this->categoryModel->create($name);
                $_SESSION['message'] = "Category created successfully!";
                header("Location: /categories");
                exit;
            }
        } else {
            renderView("view/categories/create.php", [], "Create Category");
        }
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];

            $this->categoryModel->update($id, $name);
            $_SESSION['message'] = "Category updated successfully!";
            header("Location: /categories");
        } else {
            $category = $this->categoryModel->getCategoryById($id);
            renderView("view/categories/edit.php", compact('category'), "Edit Category");
        }
    }

    public function delete($id)
    {
        $this->categoryModel->delete($id);
        $_SESSION['message'] = "Category deleted successfully!";
        header("Location: /categories");
    }
}
