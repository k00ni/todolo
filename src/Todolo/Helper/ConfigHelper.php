<?php

declare(strict_types=1);

namespace Todolo\Helper;

use Exception;

class ConfigHelper
{
    /**
     * @return array<string, array<int, string>|bool>
     */
    public function getStandardConfig(): array
    {
        return [
            'dirs_to_check' => [
                'src',
            ],
            // show
            'show_empty_dir' => false,
            'show_files_with_no_todos' => false,
            'show_no_files_info' => true,
        ];
    }

    /**
     * @param array<int|string, mixed> $config
     *
     * @throws Exception if a required field is not set
     */
    public function validateConfig(array $config): void
    {
        /*
         * check required config
         */
        foreach ([
            'dirs_to_check',
            'show_empty_dir',
            'show_files_with_no_todos',
            'show_no_files_info',
        ] as $key) {
            if (!isset($config[$key])) {
                throw new Exception('Field "'.$key.'" not set in config.');
            }
        }

        /*
         * setting: dirs_to_check
         */
        if (!\is_array($config['dirs_to_check'])) {
            throw new Exception('Field "dirs_to_check" is not of type array.');
        }
    }
}
