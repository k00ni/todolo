<?php

declare(strict_types=1);

namespace Todolo\Helper;

use Symfony\Component\Console\Output\OutputInterface;

class OutputHelper
{
    /**
     * @param array<int|string, array<array>> $todos
     */
    protected function dirHasFilesWithTodos(array $todos, string $dirToCheck): bool
    {
        foreach ($todos as $dir => $entries) {
            foreach ($entries as $todoList) {
                if ($dir == $dirToCheck && 0 < \count($todoList)) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * @param array<int|string, array<array>> $todos
     * @param array<int|string, mixed>        $config
     */
    public function printTodos(OutputInterface $output, array $todos, array $config): void
    {
        $output->writeln('');
        foreach ($todos as $dir => $entries) {
            $dir = (string) $dir;
            $dirIsShown = false;
            $firstFileInDir = true;

            /*
             * if show_empty_dir_info is ON only show dir name if we have TODOs
             */
            if ($config['show_empty_dir'] && !$this->dirHasFilesWithTodos($todos, $dir)) {
                $output->writeln('');
                $output->writeln('> '.$dir);
                $dirIsShown = true;
            } elseif ($this->dirHasFilesWithTodos($todos, $dir)) {
                $output->writeln('');
                $output->writeln('> '.$dir);
                $dirIsShown = true;
            }

            if (0 == \count($entries)) {
                /*
                 * show_no_files_info
                 */
                if ($config['show_no_files_info'] && $dirIsShown) {
                    $output->writeln('      <fg=cyan>No files found.</>');
                }
                continue;
            }

            foreach ($entries as $file => $todoList) {
                if (0 == \count($todoList)) {
                    if ($config['show_files_with_no_todos']) {
                        $output->writeln('     '.$file);
                    }
                } else {
                    if (!$firstFileInDir) {
                        $output->writeln('');
                    } else {
                        $firstFileInDir = false;
                    }

                    $output->writeln('     /'.$dir.$file);
                    foreach ($todoList as $todo) {
                        $output->writeln('     - '.$todo['message']);
                    }
                }
            }
        }
        $output->writeln('');
    }
}
