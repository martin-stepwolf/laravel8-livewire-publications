<?php

namespace App\ViewModels\Publication;

use App\Models\Publication;
use App\States\Comment\Approved;
use Illuminate\Database\Eloquent\Collection;
use Spatie\ViewModels\ViewModel;

class ShowPublicationViewModel extends ViewModel
{
    public function __construct(public $user, public Publication $publication)
    {
    }

    public function userHasCommentedPublication(): bool
    {
        $commentsCount = $this->user->comments()
                ->where('publication_id', $this->publication->getKey())
                ->count();

        return $commentsCount !== 0;
    }

    public function getApprovedCommentsFormPublication(): Collection
    {
        return $this->publication->comments()
            ->where('state', Approved::$name)
            ->get();
    }
}
