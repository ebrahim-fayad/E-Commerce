<?php

namespace App\Livewire\Admin\Categories;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryList extends Component
{
    use WithPagination;

    public $categoriesPerPage = 5;
    public $subcategoriesPerPage = 3;
    protected $listeners = [ 'test','updateCategoriesOrdering', 'updateSubCategoriesOrdering', 'updateChildSubCategoriesOrdering', 'deleteCategory', 'deleteSubCategory'];
    public function test($id)
    {
        $subcategory = SubCategory::findOrFail($id);

        if ($subcategory->children->count() > 0) {
            foreach ($subcategory->children as $child) {
                $child->delete();
            }
            $subcategory->delete();
        } else {
            //DELETE SUBCATEGORY FROM DB
            $subcategory->delete();
        }
        // $this->dispatch('deleteSubCategory');
    }
    public function updateCategoriesOrdering($positions)
    {
        foreach ($positions as $position) {
            $index = $position[0];
            $newPosition = $position[1];
            Category::where('id', $index)->update([
                'ordering' => $newPosition
            ]);
        }
        $this->dispatch('updateCategoriesOrderingSuccess');
    }
    public function updateSubCategoriesOrdering($positions)
    {
        foreach ($positions as $position) {
            $index = $position[0];
            $newPosition = $position[1];
            SubCategory::where('id', $index)->update([
                'ordering' => $newPosition
            ]);
            $this->dispatch('updateCategoriesOrderingSuccess');
        }
    }
    public function updateChildSubCategoriesOrdering($positions)
    {
        foreach ($positions as $position) {
            $index = $position[0];
            $newPosition = $position[1];
            SubCategory::where('id', $index)->update([
                'ordering' => $newPosition
            ]);
        }
        $this->dispatch('updateCategoriesOrderingSuccess');
    }
    public function deleteCategory($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        $path = 'images/categories/';
        $category_image = $category->category_image;
        if (File::exists(public_path($path . $category_image))) {
            File::delete($path . $category_image);
        }

        //DELETE CATEGORY FROM DB
        $this->dispatch('deleteSubCategorySuccess');
         $category->delete();
    }
    public function deleteSubCategory($subcategory_id)
    {
        $subcategory = SubCategory::findOrFail($subcategory_id);
        if ($subcategory->children->count() > 0) {
            foreach ($subcategory->children as $child) {
                SubCategory::where('id', $child->id)->delete();
            }
        }
        $subcategory->delete();
        $this->dispatch('deleteSubCategorySuccess');
    }


    public function render()
    {

        return view('livewire.admin.categories.category-list', [
            'categories' => Category::orderBy('ordering', 'asc')->paginate($this->categoriesPerPage, ['*'], 'categoriesPage'),
            'subCategories' => SubCategory::where('is_child_of', '0')->orderBy('ordering', 'asc')->paginate($this->subcategoriesPerPage, ['*'], 'subcategoriesPage'),
        ]);
    }
}
