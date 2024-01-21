<?php

namespace Core;

trait RepositoryManagerTrait
{
    private static ?self $rm_instance = null;

    public static function getRm(): self
    {
        if(is_null(self::$rm_instance)) self::$rm_instance = new self();

        return self::$rm_instance;
    }

    protected function __construct(){}

}