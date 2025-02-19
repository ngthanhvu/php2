<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use App\Core\BladeServiceProvider;

class CategoryController
{

    private $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
    }

    public function index()
    {
        $title = "Categories";
        $categories = $this->categoryModel->index();
        BladeServiceProvider::render('admin.categories.index', compact('categories', 'title'));
    }

    public function create()
    {
        $title = "Create Category";
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = [];

            $name = $_POST['name'] ?? '';

            if (empty($name)) {
                $errors['name'] = 'Name is required';
            }

            if (!empty($errors)) {
                BladeServiceProvider::render('admin.categories.create', compact('errors', 'title'));
            } else {
                $this->categoryModel->create($name);
                $_SESSION['message'] = "Category created successfully!";
                header("Location: /admin/categories");
                exit;
            }
        } else {
            BladeServiceProvider::render('admin.categories.create', compact('title'));
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
            $title = "Edit Category";
            BladeServiceProvider::render('admin.categories.edit', compact('category', 'title'));
        }
    }

    public function delete($id)
    {
        $this->categoryModel->delete($id);
        $_SESSION['message'] = "Category deleted successfully!";
        header("Location: /admin/categories");
    }
}
