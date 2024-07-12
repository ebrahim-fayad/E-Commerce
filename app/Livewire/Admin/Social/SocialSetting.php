<?php

namespace App\Livewire\Admin\Social;

use App\Models\SocialNetwork;
use Livewire\Component;

class SocialSetting extends Component
{
    public $socialNetwork,$facebook_url, $twitter_url, $instagram_url, $youtube_url, $github_url, $linkedin_url;
    public function mount()
    {
        $this->socialNetwork= SocialNetwork::findOrFail(1);
        $this->facebook_url= $this->socialNetwork->facebook_url;
        $this->twitter_url= $this->socialNetwork->twitter_url;
        $this->instagram_url= $this->socialNetwork->instagram_url;
        $this->youtube_url= $this->socialNetwork->youtube_url;
        $this->linkedin_url= $this->socialNetwork->linkedin_url;
        $this->github_url= $this->socialNetwork->github_url;
    }
    public function updateSocialNetworks()
    {
        $this->socialNetwork->update([
            'facebook_url'=>$this->facebook_url,
            'twitter_url'=>$this->twitter_url,
            'instagram_url'=>$this->instagram_url,
            'youtube_url'=>$this->youtube_url,
            'linkedin_url'=>$this->linkedin_url,
            'github_url'=>$this->github_url,
        ]);
        $this->showToastr('success','Social Network updated successfully');
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
        return view('livewire.admin.social.social-setting');
    }
}
