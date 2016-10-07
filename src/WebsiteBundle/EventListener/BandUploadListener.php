<?php
namespace WebsiteBundle\EventListener;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\DependencyInjection\Container;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use WebsiteBundle\Entity\Band;
use WebsiteBundle\FileUploader;

class BandUploadListener
{
    private $uploader;
    private $targetDir;
    protected $container;

    public function __construct(Container $container, FileUploader $uploader, $dir)
    {
        if (!$entity instanceof Band) {
            return;
        }
        $this->container = $container;
        $this->uploader = $uploader;
        $this->targetDir = $dir;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        if (!$entity instanceof Band) {
            return;
        }
        $entity = $args->getEntity();

        $this->uploadFile($entity);
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        if (!$entity instanceof Band) {
            return;
        }
        $entity = $args->getEntity();

        $this->uploadFile($entity);
    }

    private function uploadFile($entity)
    {
        // upload only works for Product entities
        if (!$entity instanceof Band) {
            return;
        }

        $file = $entity->getHeadshot();

        // only upload new files
        if (!$file instanceof UploadedFile) {
            return;
        }

        $fileName = $this->uploader->upload($file);
        $entity->setHeadshot($fileName);
    }
    
    public function postLoad(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
    if ($entity instanceof Band) {
        $fileName = $entity->getHeadshot();

        $entity->setHeadshot(new File($this->targetDir.'/'.$fileName));
    }
    }
}