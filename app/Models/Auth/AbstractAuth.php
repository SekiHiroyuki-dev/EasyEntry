<?php

namespace App\Models\Auth;

abstract class AbstractAuth
{
    abstract public static function isAuthed(): bool;

	abstract public static function auth(array $params);

    abstract public static function release(): void;
}
