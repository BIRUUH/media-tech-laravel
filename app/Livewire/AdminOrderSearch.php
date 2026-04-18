<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class AdminOrderSearch extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public $search = '';

    protected $queryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $lists = Order::with('user')
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%')
                      ->orWhere('id', 'like', '%' . $this->search . '%')
                      ->orWhere('payment_status', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(15);

        return view('livewire.admin-order-search', [
            'lists' => $lists
        ]);
    }
}
