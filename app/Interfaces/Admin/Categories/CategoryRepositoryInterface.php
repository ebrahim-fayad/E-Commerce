<?php
namespace App\Interfaces\Admin\Categories;
interface CategoryRepositoryInterface {
    public function index();
    public function editSubCategories($id);
    public function store($request);
    public function update($request,$id);
    public function updateSubCategory($request,$id);
    public function addSubCategories();
    public function storeSubCategory($request);
}
