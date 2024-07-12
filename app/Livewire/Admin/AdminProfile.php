<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class AdminProfile extends Component
{
    protected $listeners = ['refresh'=>'$refresh'];
    public function showToastr($type, $message)
    {
        return $this->dispatch('showToastr', [
            'type' => $type,
            'message' => $message
        ]);
    }

    public function render()
    {
        return view('livewire.admin.admin-profile');
    }
}
