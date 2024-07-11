<?php
namespace App\Repository\Seller\Profile;

use App\Interfaces\Seller\Profile\SellerProfileRepositoryInterface;
use App\Models\Seller;
use App\Models\Shop;
use Illuminate\Support\Facades\File;
use Mberecall\Services\Library\Kropify;

class SellerProfileRepository implements SellerProfileRepositoryInterface
{

    /**
     * @inheritDoc
     */
    public function profileView()
    {
        $seller = auth()->guard('seller')->user();
        return view('Back.pages.Sellers.Profile.viewProfile',compact('seller'));
    }
    /**
     * @inheritDoc
     */
    public function changeProfilePicture($request) {
        $seller = Seller::findOrFail(auth('seller')->id());
        $path = 'images/users/sellers/';
        $file = $request->file('sellerProfilePictureFile');
        $old_picture = $seller->getAttributes()['picture'];
        $imageName = 'SELLER_IMG_' . rand(2, 1000) . $seller->id . time() . uniqid() . '.jpg';
        $upload = Kropify::getFile($file, $imageName)->maxWoH(712)->save($path);
        $infos = $upload->getInfo();
        if ($upload) {
            if ($old_picture != null && file_exists(public_path("$path$old_picture"))) {
                unlink(public_path("$path$old_picture"));
            }
            $seller->update(['picture' => $imageName]);
            return response()->json(['status' => 1, 'msg' => 'Your profile picture has been successfully updated.']);
        }else{
            return response()->json(['status' => 0, 'msg' => 'Failed']);

        }
    }

    /**
     * @inheritDoc
     */
    public function shopSetting() {
        $seller = Seller::findOrFail(auth('seller')->id())->first();
        $shop = Shop::where('seller_id', $seller->id);
        $shopInfo='';
        if ($shop->exists()) {
            $shopInfo = $shop->first();
        }else{
            $shop->create(['seller_id' => $seller->id]);
            $shopInfo = $shop->first();
        }

        return view('Back.pages.Sellers.Profile.shopSetting', compact('shopInfo'));
    }
    /**
     * @inheritDoc
     */
    public function shopSetup($request) {
        $seller = Seller::findOrFail(auth('seller')->id());
        $shop = Shop::where('seller_id', $seller->id)->first();
        $old_logo_name = $shop->shop_logo;
        $logo_name = '';
        $request->validate([
            'shop_name' => ['required', "unique:shops,shop_name,{$shop->id}"],
            'shop_phone' => 'required|numeric',
            'shop_address' => 'required',
            'shop_description' => 'required',
            'shop_logo' => 'nullable|mimes:jpeg,png,jpg'
        ]);
        $path = 'images/shop/';
        if ($request->hasFile('shop_logo')) {
            $file = $request->file('shop_logo');
            $filename = 'SHOP_LOGO_' . $seller->id . uniqid() . '.' . $file->getClientOriginalExtension();

            $upload = $file->move(public_path($path), $filename);

            if ($upload) {
                $logo_name = $filename;

                //Delete an existing shop logo
                if ($old_logo_name != null && File::exists(public_path("$path$old_logo_name"))) {
                    File::delete(public_path("$path$old_logo_name"));
                }
            }
        }
        $shop->update([
           'shop_name' => $request->shop_name,
           'shop_phone' => $request->shop_phone,
           'shop_description' => $request->shop_description,
           'shop_address' => $request->shop_address,
            'shop_logo' => $logo_name != null ? $logo_name : $old_logo_name
        ]);
        return redirect()->route('seller.shop-setting')->with('success', 'Shop settings updated successfully.');
    }
}
