<?php

namespace App\ViewModels\Publication;

use App\Models\Publication;
use App\States\Comment\Approved;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Spatie\ViewModels\ViewModel;

class IndexPublicationsViewModel extends ViewModel
{
    public function __construct(public ?string $q)
    {
    }

    public function getPublicationsWithApprovedComments(): LengthAwarePaginator
    {
        return Publication::query()
            ->where('title', 'LIKE', "%{$this->q}%")
            ->orWhere('content', 'LIKE', "%{$this->q}%")
            ->orderBy('created_at', 'desc')
            ->withCount(['comments' => function ($q) {
                $q->where('state', Approved::$name);
            }])
            ->with(['user' => function ($q) {
                $q->select('id', 'name');
            }])
            ->paginate(8);
    }
}
