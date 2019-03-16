<?php

namespace App\Listener;

use App\AdminBundle\Entity\Contacts;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
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
            "preUpdate"
        ];
    }

    /**
     * Permet de supprimer l'image en cache d'une entité supprimée
     */
    public function preRemove(LifecycleEventArgs $args){
        $entity = $args->getEntity();
        if(!$entity instanceof Contacts){
            return;
        }
        $this->cacheManager->remove($this->helper->asset($entity, "imageFile"));
    }

    /**
     * Permet de supprimer l'ancienne image du cache lors de l'upload d'une nouvelle image
     */
    public function preUpdate(PreUpdateEventArgs $args){
        $entity = $args->getEntity();
        if(!$entity instanceof Contacts){
            return;
        }
        dump($args);
        if($entity->getImageFile() instanceof UploadedFile){
            dump("toto");
            $this->cacheManager->remove($this->helper->asset($entity, "imageFile"));
        }
    }
}
