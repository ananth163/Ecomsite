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
     * Generates new MD5 hashed Filename
     *
     * @param string $fileName 
     *
     * @param string $newName
     *
     **/
    protected static function generateName($fileName, $newName="")
    {
        if (empty($newName)) {
            
            $newName = pathinfo($fileName, PATHINFO_FILENAME);
        }

        $newName = strtolower(str_replace(['_', ' '], '-', $newName));

        $extension = pathinfo($fileName, PATHINFO_EXTENSION);

        $hash = md5(microtime());

        return "{$newName}-{$hash}.{$extension}";
    }

    /**
     * Store Uploaded File
     *
     * @param object $file
     *
     * @param string $newLocation
     *
     * @param string $newFileName
     *
     **/
    public static function storeAs($file, $newLocation, $newFileName = '')
    {
        
        if (! is_dir($newLocation)) {
            
            mkdir($newLocation, 0777, true);
        }

        $ds = DIRECTORY_SEPARATOR;

        $destination = BASE_PATH . "{$ds}public{$ds}{$newLocation}";

        $fileName = self::generateName($file['name'], $newFileName);

        if(move_uploaded_file($file['tmp_name'], "{$destination}{$ds}{$fileName}"))
        {
            return "{$newLocation}{$ds}{$fileName}";
        }

        throw new \Exception("Error Uploading File");
        
    }

    /**
     * Move given File
     *
     * @param string $oldLocation
     *
     * @param string $newLocation
     *
     **/
    public static function move($oldLocation, $newLocation)
    {
        
        if (! is_dir($newLocation)) {
            
            mkdir($newLocation, 0777, true);
        }

        $ds = DIRECTORY_SEPARATOR;

        $source      = BASE_PATH . "{$ds}public{$ds}{$oldLocation}";
        
        $destination = BASE_PATH . "{$ds}public{$ds}{$newLocation}";

        // move("images\upload\products\korb-ac7d99a645444708d35263c5ce13b46e.jpg", "images{$ds}archive{$ds}products")

        $fileName = pathinfo($oldLocation, PATHINFO_BASENAME);

        if(rename($source, "{$destination}{$ds}{$fileName}"))
        {
            return "{$newLocation}{$ds}{$fileName}";
        }

        throw new \Exception("Error Moving File {$fileName} to archive");
        
    }

    /**
     * Delete the file at given path
     *
     * @param string|array $fileLocation
     *
     * @return bool return True if success
     *
     **/
    public static function delete($paths)
    {
        
        $paths = is_array($paths) ? $paths : func_get_args();

        $success = true;

        // If exception or failure, only then success is set to false
        foreach ($paths as $path)
        {
            try
            {
                if (! unlink($path))
                {
                    $success = false;
                }
            } catch(Exception $e)
            {
                $success = false;
            }

            return $success; 
        }       
    }
}
