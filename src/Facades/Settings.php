<?php

namespace Codeminos\Settings\Facades;

use Illuminate\Support\Facades\Facade;

class Settings extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Codeminos\Settings\SettingsManager::class;
    }
}