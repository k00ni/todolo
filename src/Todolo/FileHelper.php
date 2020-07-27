<?php

namespace Todolo;

use DirectoryIterator;

class FileHelper
{
    /**
     * @return array<string>
     */
    public function getListOfAllPHPFiles(string $dir): array
    {
        $result = [];

        foreach (new DirectoryIterator($dir) as $file) {
            if ($file->isFile() && str_contains($file->getFilename(), '.php')) {
                $fullpath = $file->getPath().'/'.$file->getFilename();

                // remove given dir from fullpath
                $fullpath = str_replace($dir, '', $fullpath);

                $result[] = $fullpath;
            }
        }

        return $result;
    }
}
