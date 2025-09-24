<?php

/**
 * @author Helmi Adi Prasetyo <helmi.prasetyo12@gmail.com>
 * @copyright Copyright (c) Helmi Adi Prasetyo
 */


namespace Tests;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use zhikariz\yii2\fixer\Console\Commands\FixCommand;

class FixCommandTest extends TestCase
{
    /**
     * @return mixed
     */
    public function testCommandExists()
    {
        $application = new Application();
        $application->add(new FixCommand());

        $command = $application->find('fix');
        $this->assertInstanceOf(FixCommand::class, $command);
    }

    /**
     * @return mixed
     */
    public function testCommandDescription()
    {
        $command = new FixCommand();
        $this->assertEquals('Fix code style in Yii2 projects with Yii2 Fixer', $command->getDescription());
    }
}
