<?php

namespace App\Livewire\Seller;

use App\Livewire\Admin\AdminProfile;
use App\Mail\SentSellerNewPassword;
use App\Models\Seller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Livewire\Component;

class SellerTabs extends Component
{
    public $tab = null;
    public $tabName = "personal_details";
    public $seller, $name, $email, $userName,$phone,$address;
    public $current_password,$new_password,$new_password_confirmation;
    protected $listeners = ['refresh' => '$refresh'];
    protected $queryString = ['tab' => ['keep' => true]];
    public function mount()
    {
        $this->tab = request()->tab? request()->tab : $this->tabName;
        $this->seller = auth()->user();
        $this->name = $this->seller->name;
        $this->email = $this->seller->email;
        $this->userName = $this->seller->username;
        $this->phone = $this->seller->phone;
        $this->address = $this->seller->address;
    }
    public function selectTab($tab){
        $this->tab = $tab;
    }
    public function updateSellerPersonalDetails()
    {
       $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:sellers,email,'.$this->seller->id],
            'userName' => ['required', 'string', 'max:255', 'unique:sellers,username,'.$this->seller->id],
        ]);
        $userName =
        $this->seller->update([
            'name' => $this->name,
            'email' => $this->email,
            'username' => $this->userName,
            'phone' => $this->phone,
            'address' => $this->address,
        ]);
        session()->flash('success', 'Admin Personal Details Updated Successfully');
        $this->dispatch('refresh')->to(AdminProfile::class);
    }
    public function updatePassword()
    {
        $seller = Seller::findOrFail(auth('seller')->id());
        $this->validate([
            'current_password'=>['required',
                function ($attribute, $value, $fail) use ($seller) {
                    if (!Hash::check($value, $seller->password)) {
                        return $fail(__('The current password is incorrect.'));
                    }
                }],
            'new_password'=>['required','min:5','confirmed'],
        ]);
        Mail::to($seller->email)->send(new SentSellerNewPassword($seller,$this->new_password));
        $seller->update(['password'=>Hash::make($this->new_password)]);
        $this->showToastr('success', 'Password successfully changed.');
        $this->reset('current_password','new_password','new_password_confirmation');
    }
    public function showToastr($type, $message)
    {
        return $this->dispatch('showToastr', [
            'type' => $type,
            'message' => $message
        ]);
    }
    public function render()
    {
        return view('livewire.seller.seller-tabs');
    }
}
