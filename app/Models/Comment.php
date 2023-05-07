<?php

namespace App\Models;

use App\States\Comment\CommentState;
use Carbon\Carbon;
use Database\Factories\CommentFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\ModelStates\HasStates;

/**
 * @property string $id
 * @property string $user_id
 * @property string $publication_id
 * @property CommentState $state
 * @property string $content
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property User $user
 * @property Publication $publication
 *
 * @method static CommentFactory factory(...$parameters)
 */
class Comment extends Model
{
    use HasFactory;
    use HasStates;

    protected $fillable = [
        'user_id', 'publication_id', 'state', 'content',
    ];

    protected $casts = [
        'state' => CommentState::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function publication(): BelongsTo
    {
        return $this->belongsTo(Publication::class);
    }
}
