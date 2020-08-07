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
        foreach ($todos as $dir => $entries) {
            $dir = (string) $dir;
            $showDir = false;
            $firstFileInDir = true;

            /*
             * if show_empty_dir_info is ON only show dir name if we have TODOs
             */
            if ($config['show_empty_dir'] && !$this->dirHasFilesWithTodos($todos, $dir)) {
                $showDir = true;
            } elseif ($this->dirHasFilesWithTodos($todos, $dir)) {
                $showDir = true;
            }

            if (0 == \count($entries)) {
                /*
                 * show_no_files_info
                 */
                if ($config['show_no_files_info'] && $showDir) {
                    $output->writeln('');
                    $output->writeln('-----------------------------------------------------');
                    $output->writeln('<info>'.$dir.'</info>');
                    $output->writeln('-----------------------------------------------------');
                    $output->writeln('<comment>No TODOs found.</comment>');
                    $output->writeln('-----------------------------------------------------');
                }
                continue;
            }

            foreach ($entries as $file => $todoList) {
                if (0 == \count($todoList)) {
                    if ($config['show_files_with_no_todos']) {
                        $output->writeln('');
                        $output->writeln('-----------------------------------------------------');
                        $output->writeln('<info>'.$dir.'</info>'.$file);
                        $output->writeln('-----------------------------------------------------');
                        $output->writeln('<comment>No TODOs found.</comment>');
                        $output->writeln('-----------------------------------------------------');
                    }
                } else {
                    if (!$firstFileInDir) {
                        $output->writeln('');
                    } else {
                        $firstFileInDir = false;
                    }

                    $output->writeln('');
                    $output->writeln('-----------------------------------------------------');
                    $output->writeln('<info>'.$dir.'</info>'.$file);
                    $output->writeln('-----------------------------------------------------');
                    foreach ($todoList as $todo) {
                        $output->writeln('- '.$todo['message']);
                    }
                }
            }
        }
        $output->writeln('');
    }
}
