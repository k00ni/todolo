<?php

namespace Todolo\Helper;

use DirectoryIterator;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class FileHelper
{
    /**
     * @return array<string>
     */
    public function getListOfAllPHPFiles(string $dir): array
    {
        $result = [];

        $rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));

        foreach ($rii as $file) {
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
