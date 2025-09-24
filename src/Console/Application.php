<?php

namespace zhikariz\yii2\fixer\Console;

use Symfony\Component\Console\Application as BaseApplication;
use zhikariz\yii2\fixer\Console\Commands\FixCommand;

class Application extends BaseApplication
{
    public function __construct()
    {
        parent::__construct('Yii2 Fixer By zhikariz', '1.0.0');

        $this->add(new FixCommand());
    }
}
