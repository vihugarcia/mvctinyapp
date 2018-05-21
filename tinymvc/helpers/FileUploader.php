<?php
namespace TinyMVC\helpers;

class FileUploader
{
    private $targetDir;
    private $targetFile;
    private $fileName;
    private $fileData;
    private $uploadOk;
    private $imageType;

    public function __construct($targetDir, $key)
    {
        $this->targetDir = $targetDir;
        $this->fileName = $_FILES[$key]['name'];
        $this->fileData = $_FILES[$key]['tmp_name'];
        $this->targetFile = $this->targetDir . '/' . $this->fileName;
        $this->uploadOk = 1;
        $this->imageType = pathinfo( $this->targetFile, PATHINFO_EXTENSION );
    }

    public function save()
    {
        return move_uploaded_file($this->fileData, $this->targetFile);
    }
}