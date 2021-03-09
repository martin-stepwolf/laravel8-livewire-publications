<?php

namespace App\Http\Livewire;

use App\Models\Publication;
use Livewire\WithPagination;
use Livewire\Component;

class PublicationComponent extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.publication-component', [
            'publications' => Publication::orderBy('id', 'desc')->paginate()
        ]);
    }
}
