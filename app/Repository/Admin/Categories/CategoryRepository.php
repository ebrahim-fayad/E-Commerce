<?php
namespace App\Repository\Admin\Categories;
use App\Interfaces\Admin\Categories\CategoryRepositoryInterface;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\SubCategory;
class CategoryRepository implements CategoryRepositoryInterface{
    public function index()
    {
        return view('Back.pages.Admin.Categories.index');
    }
    /**
     * @inheritDoc
     */
    public function store($request) {
        $path = 'images/categories/';
        $image = $request->file('category_image');
        $fileName = Str::slug($request->category_name) . time() . uniqid() . '.'.$image->getClientOriginalExtension();
        $upload = $image->storeAs('categories',$fileName,'upload_image');
        Category::create([
            'category_name'=>$request->category_name,
            'category_image'=>$fileName,
        ]);
        return redirect()->route('admin.categories.index')->with('success', ucfirst($request->category_name).' category has been created successfully');
    }
    /**
     * @inheritDoc
     */
    public function update($request, $id) {
        $category = Category::find($id);
        $category->category_name = $request->category_name;
        if($request->hasFile('category_image')){
            $path = 'images/categories/';
            $oldPic = $category->getAttributes()['category_image'];
            $image = $request->file('category_image');
            $fileName = Str::slug($request->category_name) . time() . uniqid() . '.'.$image->getClientOriginalExtension();
            $upload = $image->storeAs('categories',$fileName,'upload_image');
            if ($upload) {
                if ($oldPic != null && File::exists("$path$oldPic")) {
                    File::delete(public_path("$path$oldPic"));
                }
            }
            $category->category_image = $fileName;
        }
        $category->save();
        return redirect()->route('admin.categories.index')->with('success', ucfirst($request->category_name).' category has been updated successfully');
    }
    /**
     * @inheritDoc
     */
    public function addSubCategories() {
        $categories = Category::all();
        $subcategories = SubCategory::where('is_child_of', 0)->get();
        return view('Back.pages.Admin.Categories.add-subCategory', compact('categories', 'subcategories'));
    }
    public function storeSubCategory($request)
    {
        SubCategory::create([
            'category_id'=>$request->category_id,
            'subcategory_name'=>$request->subcategory_name,
            'is_child_of'=>$request->is_child_of,
        ]);
        return redirect()->route('admin.categories.index')->with('success', 'Subcategory has been created successfully');

    }
    public function editSubCategories($id)
    {
        $categories = Category::all();
        $subcategory = SubCategory::find($id);
        $subcategories = SubCategory::where('is_child_of', 0)->get();
        return view('Back.pages.Admin.Categories.edit-subCategory', compact('categories','subcategory', 'subcategories'));
    }
    /**
     * @inheritDoc
     */
    public function updateSubCategory($request, $id) {
        $subcategory = SubCategory::find($id);
        if ($subcategory->children()->count() && $request->is_child_of != 0)   {
            return back()->with('fail', 'This sub category has (' . $subcategory->children->count() . ') children. You can not change "Is Child Of" option unless you free its children.');
        }
        $subcategory->subcategory_name = $request->subcategory_name;
        $subcategory->category_id = $request->category_id;
        $subcategory->is_child_of = $request->is_child_of;
        $subcategory->save();
        return redirect()->route('admin.categories.index')->with('success', 'Subcategory has been updated successfully');
    }
}
