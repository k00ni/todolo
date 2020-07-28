<?php

declare(strict_types = 1);

namespace Todolo\Helper;

use Symfony\Component\Console\Output\OutputInterface;

class OutputHelper
{
    /**
     * @param array<int|string, array<array>> $todos
     */
    public function printTodos(OutputInterface $output, array $todos): void
    {
        $output->writeln('');
        foreach ($todos as $dir => $entries) {
            $output->writeln('Dir: '.$dir);

            if (0 == count($entries)) {
                $output->writeln('  No files found.');
                continue;
            }

            foreach ($entries as $file => $todos) {
                if (0 == count($todos)) {
                    // no TODOs
                } else {
                    foreach ($todos as $todo) {
                        $output->writeln('     '.$file);
                        $output->writeln('     - '.$todo['message']);
                    }
                }
            }
        }
        $output->writeln('');
    }
}
