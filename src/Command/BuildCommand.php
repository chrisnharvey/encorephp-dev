<?php

namespace Encore\Dev\Command;

use Encore\Command;
use Phar;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class BuildCommand extends Command
{
    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        $this
            ->setName('build')
            ->addArgument('entrypoint', InputArgument::REQUIRED, 'The entrypoint for the application.')
            ->setDescription('Build application into a single executable bundle');
    }

    /**
     * {@inheritdoc}
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $entryPoint = $input->getArgument('entrypoint');
        $appDir = getcwd();

        $phar = new Phar("{$appDir}/{$entryPoint}.phar");

        $phar->setSignatureAlgorithm(Phar::SHA256);

        $phar->buildFromDirectory(getcwd());

        $stub = file_get_contents(BASE_PATH.'/resources/encore.stub');
        $stub = str_replace('{ENTRYPOINT}', $entryPoint, $stub);

        $phar->setStub($stub);
    }
}