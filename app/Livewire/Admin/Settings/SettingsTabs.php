<?php

namespace App\Livewire\Admin\Settings;

use App\Models\GeneralSetting;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithFileUploads;

class SettingsTabs extends Component
{
    use WithFileUploads;
    public $tab = null;
    public$default_tab = 'general_settings';
    public $general_settings, $site_name, $site_email, $site_phone, $site_address, $site_meta_keywords,$site_meta_description,$logo,$favicon;
    protected $queryString = ['tab' => ['keep' => true]];
    public function mount()
    {
        $this->tab = request()->tab ? request()->tab: $this->default_tab;
        $this->general_settings= GeneralSetting::findOrFail(1);
        $this->site_name= $this->general_settings->site_name;
        $this->site_email= $this->general_settings->site_email;
        $this->site_phone= $this->general_settings->site_phone;
        $this->site_address= $this->general_settings->site_address;
        $this->site_meta_keywords= $this->general_settings->site_meta_keywords;
        $this->site_meta_description= $this->general_settings->site_meta_keywords;
    }
    public function updateGeneralSettings()
    {
        $this->validate([
           'site_name'=>'required|string|max:255',
           'site_email'=>'required|email|max:255',

        ]);
        $this->general_settings->update([
           'site_name' => $this->site_name,
           'site_email' => $this->site_email,
           'site_phone' => $this->site_phone,
           'site_address' => $this->site_address,
           'site_meta_keywords' => $this->site_meta_keywords,
           'site_meta_description' => $this->site_meta_description,
           ]);
           $this->dispatch('settingsUpdating');

    }
    public function selectTab($tab)
    {
        $this->tab = $tab;
    }
    public function uploadLogo()
    {
        $this->validate([
            'logo'=>'image|required'
        ]);
        $path = 'images/site/';
        $old_logos = $this->general_settings->getAttributes()['logo'];
        $filename = 'SITE_LOGO_' . rand(2, 1000) . $this->general_settings->id . time() . uniqid(). '.jpg';
        $upload = $this->logo->storeAs('site', $filename,'upload_image');
        if ($upload) {
            if ($old_logos != null && File::exists(public_path($path . $old_logos))) {
                File::delete(public_path($path . $old_logos));
            }
            $this->general_settings->update(['logo'=>$filename]);
            $this->dispatch('settingsUpdating');

            $this->reset('logo');
        }else{
            throw ValidationException::withMessages([
                'logo' => 'logo is required'
            ]);
        }

    }
    public function uploadFavicon()
    {
        $this->validate([
            'favicon'=>'image|required'
        ]);
        $path = 'images/site/';
        $old_favicons = $this->general_settings->getAttributes()['site_favicon'];
        $filename = 'SITE_FAVICON' . rand(2, 1000) . $this->general_settings->id . time() . uniqid(). '.jpg';
        $upload = $this->favicon->storeAs('site', $filename,'upload_image');
        if ($upload) {
            if ($old_favicons != null && File::exists(public_path($path . $old_favicons))) {
                File::delete(public_path($path . $old_favicons));
            }
            $this->general_settings->update(['site_favicon'=>$filename]);
            $this->dispatch('settingsUpdating');

            $this->reset('favicon');
        }else{
            throw ValidationException::withMessages([
                'favicon' => 'logo is not valid',
            ]);
        }
        // dd('test');
    }
    public function render()
    {
        return view('livewire.admin.settings.settings-tabs');
    }
}
