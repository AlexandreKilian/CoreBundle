<?php

namespace Brix\CoreBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;


class TranslationRepository extends EntityRepository {

    private $locale;

    public function setLocale(\Brix\CoreBundle\Entity\Language $locale){
        $this->locale = $locale;
    }

    public function find($id){

        if($this->locale){
            $qb = $this->createQueryBuilder('tra');

            $qb->where($qb->expr()->orX(
            $qb->expr()->eq('tra.id', '?1'),
            $qb->expr()->eq('tra.original', '?1')
            ))
            ->andWhere('tra.language = ?2')
            ->setParameter(1,$id)
            ->setParameter(2,$this->locale)
            ->setMaxResults(1)
            ;
            $query = $qb->getQuery();

            if($result = $query->getResult()){
                return $result[0];
                return $result;
            } else{
                return false;
            }

        }
        return parent::find($id);

    }

    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        $mergedCriteria = $criteria;
        if($this->locale){
            $langCriteria = array('language'=>$this->locale);
            $mergedCriteria = array_merge($criteria,$langCriteria);
        }
        if($result = parent::findBy($mergedCriteria,$orderBy,$limit,$offset)){
            return $result;
        } else{
            $langCriteria = array('original'=>null);
            $mergedCriteria = array_merge($criteria,$langCriteria);
            return parent::findBy($mergedCriteria,$orderBy,$limit,$offset);
        }

    }


    public function findOneBy(array $criteria){

        $mergedCriteria = $criteria;
        if($this->locale){
            $langCriteria = array('language'=>$this->locale);
            $mergedCriteria = array_merge($criteria,$langCriteria);
        }
        if($result = parent::findOneBy($mergedCriteria)){
            return $result;
        } else{
            $langCriteria = array('original'=>null);
            $mergedCriteria = array_merge($criteria,$langCriteria);
            return parent::findOneBy($mergedCriteria);
        }

    }

}
