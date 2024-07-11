<?php
namespace App\Repository\Seller\Products;

use App\Interfaces\Seller\Products\SellerProductRepositoryInterface;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use App\Rules\ValidatePrice;
use Illuminate\Http\Request;
class SellerProductRepository implements SellerProductRepositoryInterface
{
    public function allProducts()
    {
        return view('Back.pages.Sellers.Products.all-products');
    }

    /**
     * @inheritDoc
     */
    public function addProduct() {
        $categories = Category::orderBy('category_name', 'asc')->get();
        return view('Back.pages.Sellers.Products.add-product', compact('categories'));
    }

    /**
     * @inheritDoc
     */
    public function getProductCategory($request)
    {
        $category_id = $request->category_id;
        $category = Category::findOrFail($category_id);
        $subcategories = SubCategory::where('category_id', $category_id)
            ->where('is_child_of', 0)
            ->orderBy('subcategory_name', 'asc')
            ->get();

        $html = '';
        foreach ($subcategories as $item) {
            $html .= '<option value="' . $item->id . '">' . $item->subcategory_name . '</option>';
            if (count($item->children) > 0) {
                foreach ($item->children as $child) {
                    $html .= '<option value="' . $child->id . '">-- ' . $child->subcategory_name . '</option>';
                }
            }
        }
        return response()->json(['status' => 1, 'data' => $html]);
    }

    /**
     * @inheritDoc
     */
    public function createProduct($request) {
        $product_image = null;
        if ($request->hasFile('product_image')) {
            $path = 'images/products/';
            $file = $request->file('product_image');
            $filename = 'PRODUCT_IMG_' . time() . uniqid() . '.' . $file->getClientOriginalExtension();
            // $upload = $file->move(public_path($path), $filename);
            $upload = $file->move(public_path($path), $filename);
            ;
            if ($upload) {
                $product_image = $filename;
            }
        }

        //SAVE PRODUCT DETAILS
        $product = new Product();
        $product->user_type = 'seller';
        $product->seller_id = auth('seller')->id();
        $product->name = $request->name;
        $product->summary = $request->summary;
        $product->category = $request->category;
        $product->subcategory = $request->subcategory;
        $product->price = $request->price;
        $product->compare_price = $request->compare_price;
        $product->visibility = $request->visibility;
        $product->product_image = $product_image;
        $saved = $product->save();

        if ($saved) {
            return response()->json(['status' => 1, 'msg' => 'New product has been successfully created.']);
        } else {
            return response()->json(['status' => 0, 'msg' => 'Something went wrong.']);
        }
    }

}
