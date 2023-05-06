<?php

namespace App\Models;

use Carbon\Carbon;
use Database\Factories\CommentFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $id
 * @property string $user_id
 * @property string $publication_id
 * @property string $comment_state_id
 * @property string $content
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property User $user
 * @property Publication $publication
 * @property CommentState $comment_state
 *
 * @method static CommentFactory factory(...$parameters)
 */
class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'publication_id', 'comment_state_id', 'content',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function publication(): BelongsTo
    {
        return $this->belongsTo(Publication::class);
    }

    public function comment_state(): BelongsTo
    {
        return $this->belongsTo(CommentState::class);
    }
}
