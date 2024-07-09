<?php
namespace App\Repository\Admin\Profile;

use App\Interfaces\Admin\Profile\AdminProfileRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Admin;
use Illuminate\Support\Facades\File;

class AdminProfileRepository implements AdminProfileRepositoryInterface{
    public function profileView() : View
    {
        $admin = Auth::user();
        return view('Back.pages.Admin.Profile.profileView',compact('admin'));
    }
    /**
     * @inheritDoc
     */
    public function changeProfilePicture( $request)
    {
        $admin = Admin::findOrFail(auth('admin')->id());
        $path = 'images/users/admins/';
        $file = $request->file('adminProfilePictureFile');
        $old_picture = $admin->getAttributes()['picture'];
        $file_path = $path . $old_picture;
        $filename = 'ADMIN_IMG_' . rand(2, 1000) . $admin->id . time() . uniqid() . '.jpg';

        $upload = $file->move(public_path($path), $filename);

        if ($upload) {
            if ($old_picture != null && File::exists(public_path($path . $old_picture))) {
                File::delete(public_path($path . $old_picture));
            }
            $admin->update(['picture' => $filename]);
            return response()->json(['status' => 1, 'msg' => 'Your profile picture has been successfully updated.']);
        } else {
            return response()->json(['status' => 0, 'msg' => 'Something went wrong.']);
        }
    }
}
