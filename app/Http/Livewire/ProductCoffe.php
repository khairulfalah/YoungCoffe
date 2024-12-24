<?php

namespace App\Http\Livewire;

use App\Coffe;
use App\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductCoffe extends Component
{
    use WithPagination;
    
    public $search, $coffe;
    
    protected $updateQueryString = ['search'];


    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function mount($coffeId)
    {
        $coffeDetail = Coffe::find($coffeId);

        if($coffeDetail) {
            $this->coffe = $coffeDetail;
        }
    }
    
    public function render()
    {
        if ($this->search) {
            $products = Product::where('coffe_id', $this->coffe->id)->where('nama', 'like', '%' . $this->search . '%')->paginate(8);
        } else {
            $products = Product::where('coffe_id', $this->coffe->id)->paginate(8);
        }
        
        return view('livewire.product-index', [
            'products' => $products,
            'title' => ''.$this->coffe->nama
        ]);
    }
}
