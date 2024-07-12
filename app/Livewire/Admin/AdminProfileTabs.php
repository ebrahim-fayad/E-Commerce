<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class AdminProfileTabs extends Component
{
    public $tab= null;
    public $tabName = "personal_details";
    protected $queryString = ['tab' => ['keep' => true]];
    public $admin, $name, $userName, $email;
    public $current_password, $new_password, $new_password_confirmation;
    public function selectTab($tab)
    {
        $this->tab = $tab;
    }
    public function mount()
    {
        $this->tab = request()->tab ? request()->tab : $this->tabName;
        $this->admin = auth()->user();
        $this->name = $this->admin->name;
        $this->email = $this->admin->email;
        $this->userName = $this->admin->username;
    }
    public function updateAdminPersonalDetails()
    {
        $this->validate([
            'name' =>'required|string|max:255',
            'email' =>'required|email|max:255|unique:admins,email,'. $this->admin->id,
            'userName' =>'required|string|min:3|max:20|alpha_dash|unique:admins,username,'. $this->admin->id,
        ]);
        $this->admin->update([
            'name' => $this->name,
            'email' => $this->email,
            'username' => $this->userName,
        ]);
        // session()->flash('success', 'Admin Personal Details Updated Successfully!');
        $this->dispatch('refresh')->to(AdminProfile::class);
        $this->dispatch('updateAdminInfo', [
            'adminName' => $this->name,
            'adminEmail' => $this->email
            ]);
        $this->showToastr('success','Personal Details successfully changed.');
        // return redirect()->route('admin.profile');
    }
    public function showToastr($type, $message)
    {
        return $this->dispatch('showToastr', [
            'type' => $type,
            'message' => $message
            ]);
        }
        public function updatePassword()
        {
            $this->validate([
                'current_password' => 'required|string|min:8',
                'new_password' => 'required|string|min:8|confirmed',
                ]);
                if (Hash::check($this->current_password, $this->admin->password))  {
                    $this->admin->update(['password'=> Hash::make( $this->new_password)]);
                    $this->reset('current_password','new_password','new_password_confirmation');
                    $this->dispatch('successFlash');
                    $this->dispatch('refresh')->to(AdminProfile::class);
                }else{
                    $this->reset('current_password','new_password','new_password_confirmation');
                    throw ValidationException::withMessages([
                        'current_password' => 'Current_Password is incorrect.',
                        ])->status(429);
                    }

                    $this->showToastr('success','Password successfully changed.');
                }

    public function render()
    {
        return view('livewire.admin.admin-profile-tabs');
    }
}
