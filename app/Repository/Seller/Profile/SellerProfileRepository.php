<?php
namespace App\Repository\Seller\Profile;

use App\Interfaces\Seller\Profile\SellerProfileRepositoryInterface;
use App\Models\Seller;
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
                unlink(public_path($path. $old_picture));
            }
            $seller->update(['picture' => $imageName]);
            return response()->json(['status' => 1, 'msg' => 'Your profile picture has been successfully updated.']);
        }else{
            return response()->json(['status' => 0, 'msg' => 'Failed']);

        }
    }

}
