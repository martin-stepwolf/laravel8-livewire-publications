<?php

namespace App\States\Comment;

use Spatie\ModelStates\Exceptions\InvalidConfig;
use Spatie\ModelStates\State;
use Spatie\ModelStates\StateConfig;

abstract class CommentState extends State
{
    public static string $name;

    /**
     * @throws InvalidConfig
     */
    public static function config(): StateConfig
    {
        return parent::config()
            ->default(Pending::class)
            ->allowTransition(Pending::class, Approved::class)
            ->allowTransition(Pending::class, Rejected::class);
    }
}
