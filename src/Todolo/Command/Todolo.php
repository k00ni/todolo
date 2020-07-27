<?php

namespace Todolo\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Todolo extends Command
{
    protected static $defaultName = 'todolo';

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('todolo');

        return 0;
    }
}
