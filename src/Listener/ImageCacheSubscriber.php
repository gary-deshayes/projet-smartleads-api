<?php

namespace App\Listener;

use App\AdminBundle\Entity\Company;
use App\AdminBundle\Entity\Contacts;
use App\AdminBundle\Entity\Salesperson;
use App\AdminBundle\Entity\SettingsOperation;
use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;

class ImageCacheSubscriber implements EventSubscriber
{

    /**
     * var CacheManager
     */
    private $cacheManager;

    /**
     * var UploaderHelper
     */
    private $helper;

    public function __construct(CacheManager $cacheManager, UploaderHelper $helper)
    {
        $this->cacheManager = $cacheManager;
        $this->helper = $helper;
    }

    public function getSubscribedEvents()
    {
        return [
            "preRemove",
            "preUpdate",
        ];
    }

    /**
     * Permet de supprimer l'image en cache d'une entité supprimée
     */
    public function preRemove(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if ($entity instanceof Contacts || $entity instanceof Salesperson || $entity instanceof Company || $entity instanceof SettingsOperation) {
            if ($entity instanceof SettingsOperation) {
                if ($entity->getMailVisual() instanceof UploadedFile) {
                    $this->cacheManager->remove($this->helper->asset($entity, "mail_visual"));
                }
                if ($entity->getPageVisual() instanceof UploadedFile) {
                    $this->cacheManager->remove($this->helper->asset($entity, "page_visual"));
                }
            } else {
                if ($entity->getImageFile() instanceof UploadedFile) {
                    $this->cacheManager->remove($this->helper->asset($entity, "imageFile"));
                }
            }
        } else {
            return;
        }
    }

    /**
     * Permet de supprimer l'ancienne image du cache lors de l'upload d'une nouvelle image
     */
    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();
        if ($entity instanceof Contacts || $entity instanceof Salesperson || $entity instanceof Company || $entity instanceof SettingsOperation) {
            if ($entity instanceof SettingsOperation) {
                if ($entity->getMailVisual() instanceof UploadedFile) {
                    $this->cacheManager->remove($this->helper->asset($entity, "mail_visual"));
                }
                if ($entity->getPageVisual() instanceof UploadedFile) {
                    $this->cacheManager->remove($this->helper->asset($entity, "page_visual"));
                }
            } else {
                if ($entity->getImageFile() instanceof UploadedFile) {
                    $this->cacheManager->remove($this->helper->asset($entity, "imageFile"));
                }
            }
        } else {
            return;
        }

    }
}
