<?php

namespace Core;

use Illuminate\Foundation\Application as BaseApplication;

class Application extends BaseApplication
{
    /**
     * Get the version number of the application.
     *
     * @return string
     */
    public function version()
    {
        return '1.0.0 beta version';
    }
}
