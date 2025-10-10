<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ChildLaborer;

class ChildLaborerManagement extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = '';
    public $perPage = 10;

    protected $queryString = [
        'search' => ['except' => ''],
        'statusFilter' => ['except' => ''],
    ];

    protected $listeners = ['childLaborerAdded' => '$refresh'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function deleteChildLaborer($id)
    {
        $childLaborer = ChildLaborer::findOrFail($id);
        $childLaborer->delete();
        
        $this->dispatchBrowserEvent('swal:modal', [
            'title' => 'Success!',
            'text' => 'Child laborer deleted successfully.',
            'icon' => 'success',
        ]);
    }

    public function render()
    {
        $childLaborers = ChildLaborer::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('first_name', 'like', '%' . $this->search . '%')
                      ->orWhere('last_name', 'like', '%' . $this->search . '%')
                      ->orWhere('middle_name', 'like', '%' . $this->search . '%');
                });
            })
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.child-laborer-management', compact('childLaborers'));
    }
}