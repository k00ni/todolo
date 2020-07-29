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

        $result = array_merge(
            $result,
            $this->extractSingleLineAtTODOs($fileContent),
            $this->extractSingleLineFIXMEs($fileContent),
            $this->extractSingleLineTODOs($fileContent)
        );

        return $result;
    }

    /**
     * Extracted single line @todo.
     *
     * @return array<int, array>
     */
    public function extractSingleLineAtTODOs(string $fileContent): array
    {
        $result = [];

        preg_match_all('/\*\s+@todo\s*(.*)/mi', $fileContent, $matches);

        if (isset($matches[1])) {
            foreach ($matches[1] as $match) {
                $result[] = [
                    'message' => trim($match),
                ];
            }
        }

        return $result;
    }

    /**
     * Extracted single line FIXME.
     *
     * @return array<int, array>
     */
    public function extractSingleLineFIXMEs(string $fileContent): array
    {
        $result = [];

        preg_match_all('/[\/\/|\*]\s+FIXME[:]*\s*(.*)/mi', $fileContent, $matches);

        if (isset($matches[1])) {
            foreach ($matches[1] as $match) {
                $result[] = [
                    'message' => trim($match),
                ];
            }
        }

        return $result;
    }

    /**
     * Extracted single line TODO.
     *
     * @return array<int, array>
     */
    public function extractSingleLineTODOs(string $fileContent): array
    {
        $result = [];

        preg_match_all('/[\/\/|\*]\s+TODO[:]*\s*(.*)/mi', $fileContent, $matches1);

        if (isset($matches1[1])) {
            foreach ($matches1[1] as $match) {
                $result[] = [
                    'message' => trim($match),
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
            if (0 < \strlen($fileContent)) {
                $result[$filePathInDir] = $this->extractAllTodos($fileContent);
            } else {
                continue;
            }
        }

        return $result;
    }
}
