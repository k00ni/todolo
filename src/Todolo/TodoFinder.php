<?php

declare(strict_types=1);

namespace Todolo;

use Todolo\Helper\FileHelper;

class TodoFinder
{
    /**
     * @var FileHelper
     */
    protected $fileHelper;

    public function __construct(FileHelper $fileHelper)
    {
        $this->fileHelper = $fileHelper;
    }

    /**
     * @return array<array>
     */
    public function extractAllTodos(string $fileContent): array
    {
        $result = [];

        /*
         * single line TODO
         */
        preg_match_all('/\/\/\s*TODO\:*(.*)$/mi', $fileContent, $matches);

        if (isset($matches[1])) {
            foreach ($matches[1] as $match) {
                $result[] = [
                    'message' => \trim($match),
                ];
            }
        }

        return $result;
    }

    /**
     * @return array<array>
     */
    public function getAllTodosForPHPFilesIn(string $dir): array
    {
        $result = [];

        $phpFiles = $this->fileHelper->getListOfAllPHPFiles($dir);

        foreach ($phpFiles as $filePathInDir) {
            $fullpath = $dir.$filePathInDir;

            $fileContent = (string) file_get_contents($fullpath);

            // if file is not empty
            if (0 < strlen($fileContent)) {
                $result[$filePathInDir] = $this->extractAllTodos($fileContent);

            } else {
                continue;
            }
        }

        return $result;
    }
}
