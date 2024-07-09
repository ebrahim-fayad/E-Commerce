<?php

namespace App\Http\Controllers\Admin\Categories;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubCategoryRequest;
use App\Interfaces\Admin\Categories\CategoryRepositoryInterface;

use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    private $Category;
    public function __construct(CategoryRepositoryInterface $Category)
    {
        $this->Category = $Category;
    }
    public function addSubCategories()
    {
        return $this->Category->addSubCategories();
    }
    public function storeSubCategory(SubCategoryRequest $request)
    {
        return $this->Category->storeSubCategory($request);
    }
    public function editSubCategories($id)
    {
        return $this->Category->editSubCategories($id);
    }
    public function updateSubCategory(SubCategoryRequest $request,$id)
    {
        return $this->Category->updateSubCategory($request,$id);
    }
}
