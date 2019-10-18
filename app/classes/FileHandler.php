<?php

namespace App\Classes;

class FileHandler
{
    const MAX_FILESIZE = 2097152;

    /**
     * @var string $fileName FileName
     **/
    protected $fileName;

    /**
     * @var int Filesize
     **/
    protected $fileSize;

    /**
     * Get the Filename
     *
     * @return string $filename
     *
     **/
    public function getName()
    {
        return $this->fileName;
    }

    /**
     * Set Filename
     *
     * @param string $file
     *
     * @param string $name=""
     *
     **/
    protected function setName($file, $name="")
    {
        if (empty($name)) {
            $name = pathinfo($file, PATH_FILENAME);
        }

        $name = strtolower(str_replace(['_', ' '], '-', $name));

        $extension = pathinfo($file, PATH_EXTENSION);

        $hash = mds(microtime());

        $this->fileName = "{$name}-{$hash}.{$extension}";
    }
}
