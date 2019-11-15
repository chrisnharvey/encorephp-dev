<?php

namespace Encore\Dev;

use Encore\Application as EncoreApplication;
use Encore\Dev\Command\BuildCommand;

class Application extends EncoreApplication
{
    protected $name = 'EncorePHP';
    protected $version = '1.0.0';

    public function commands(): array
    {
        return [
            'build' => BuildCommand::class
        ];
    }
}