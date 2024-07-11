<?php

namespace App\Livewire\Seller;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductList extends Component
{
    use WithPagination;
    protected $listeners = ['refresh' => '$refresh'];
    public $productsPerPage = 9;
    public function render()
    {
        return view('livewire.seller.product-list',[
            'products' => Product::where('user_type','seller')->where('seller_id', auth()->user()->id)->paginate($this->productsPerPage, ['*'], 'productsPage')
        ]);
    }
}
