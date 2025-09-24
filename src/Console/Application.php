<?php

/**
 * @author Helmi Adi Prasetyo <helmi.prasetyo12@gmail.com>
 * @copyright Copyright (c) Helmi Adi Prasetyo
 */

namespace zhikariz\yii2\fixer\Console;

use Symfony\Component\Console\Application as BaseApplication;
use zhikariz\yii2\fixer\Console\Commands\DocBlockCommand;
use zhikariz\yii2\fixer\Console\Commands\FixCommand;
use zhikariz\yii2\fixer\Console\Commands\VersionCommand;

class Application extends BaseApplication
{
    /**
     * @return mixed
     */
    public function __construct()
    {
        parent::__construct('Yii2 Fixer By zhikariz', '1.1.0');

        $this->add(new DocBlockCommand());
        $this->add(new FixCommand());
        $this->add(new VersionCommand());
    }
}
