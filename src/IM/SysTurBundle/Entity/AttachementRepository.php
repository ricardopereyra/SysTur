<?php

namespace IM\SysTurBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * AttachementRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AttachementRepository extends EntityRepository
{
    public function getAttachements($source, $id) {
        $em = $this->getEntityManager();
        $query = $em->createQuery('SELECT a from IMSysTurBundle:Attachement a 
        WHERE a.tabla = :source 
        AND a.idSource = :id_source');
        $query->setParameter('source', $source);
        $query->setParameter('id_source', $id);
        $attachements = $query->getResult();

        return $attachements;
    }
    
    public function getCantidad($source, $idSource) {
        $em = $this->getEntityManager();
        $query = $em->createQuery('SELECT COUNT(a) as cantidad from IMSysTurBundle:Attachement a 
        WHERE a.tabla = :source 
        AND a.idSource = :id_source');
        $query->setParameter('source', $source);
        $query->setParameter('id_source', $idSource);
        $cantidad = $query->getSingleResult();

        return $cantidad;
    }
}
