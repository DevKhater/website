<?php
namespace WebsiteBundle;

use Symfony\Component\HttpFoundation\File\UploadedFile;
/**
 * Description of FileUploader
 *
 * @author Michel
 */
class FileUploader
{
  private $targetDir;

    public function __construct($targetDir)
    {
        $this->targetDir = $targetDir;
    }

    public function upload(UploadedFile $file)
    {
        $fileName = md5(uniqid()).'.'.$file->guessExtension();

        $file->move($this->targetDir, $fileName);

        return $fileName;
    }
}
