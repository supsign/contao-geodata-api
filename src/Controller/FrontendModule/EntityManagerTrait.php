<?php

namespace Supsign\ContaoGeoDataApiBundle\Controller\FrontendModule;

trait EntityManagerTrait {
    protected $entityNamespace = 'Supsign\ContaoGeoDataApiBundle\Entity\\';
    protected $entityManager = null;

    protected function getEntityManager() {
        if (!$this->entityManager)
            $this->entityManager = \Contao\System::getContainer()->get('doctrine.orm.default_entity_manager');

        return $this->entityManager;
    }

    protected function getRepository($entity) {
        return $this->getEntityManager()->getRepository($this->entityNamespace.$entity);
    }
}