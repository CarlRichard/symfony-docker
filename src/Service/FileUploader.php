<?php


namespace App\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

class FileUploader
{
    private $targetDirectory;

    public function __construct(string $targetDirectory)
    {
        $this->targetDirectory = $targetDirectory;
    }

    public function upload(UploadedFile $file)
    {
        // unique nom
        $fileName = uniqid().'.'.$file->guessExtension();

        try {
            // deplacer vers uploads
            $file->move($this->getTargetDirectory(), $fileName);
        } catch (IOExceptionInterface $exception) {
            throw new \Exception("Erreur lors de l'upload du fichier.");
        }
        return $fileName;
    }

    public function getTargetDirectory()
    {

        return $this->targetDirectory;
    }
}
