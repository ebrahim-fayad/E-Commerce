<?php
namespace App\Interfaces\Admin\Profile;

interface AdminProfileRepositoryInterface
{
    public function profileView();
    public function changeProfilePicture($request);
}
