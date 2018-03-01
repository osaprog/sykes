<?php

namespace AppBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * SearchRepository
 *
 * @author Osama Abufara <oabufara@gmail.com>
 */
class PropertyRepository extends EntityRepository {

    public function search($criteria) {

        $qb = $this->createQueryBuilder('p');

        $qb->innerJoin('AppBundle:Location', 'l', 'WITH', 'l.__pk = p._fk_location');
        if ($criteria["location_name"]) {
            $qb->andWhere($qb->expr()->like('l.location_name', ':location_name'))
                    ->setParameter('location_name', "%" . $criteria["location_name"] . "%");
        }
        $date_filter = false;
        list($date_from, $date_to) = $this->formatDateToSql($criteria);

        if ($date_from && !$date_to) {
            $qb->leftJoin('AppBundle:Booking', 'b', 'WITH', $qb->expr()->andx(
                            $qb->expr()->eq('p.__pk', 'b._fk_property'), $qb->expr()->gte('b.start_date', ':date_from')
            ));
            $qb->setParameter(':date_from', $date_from);
            $date_filter = true;
        }
        if (!$date_from && $date_to) {
            $qb->leftJoin('AppBundle:Booking', 'b', 'WITH', $qb->expr()->andx(
                            $qb->expr()->eq('p.__pk', 'b._fk_property'), $qb->expr()->lte('b.end_date', ':date_end')
            ));
            $qb->setParameter(':date_end', $date_to);
            $date_filter = true;
        }
        if ($date_from && $date_to) {

            $qb->leftJoin('AppBundle:Booking', 'b', 'WITH', $qb->expr()->andx(
                            $qb->expr()->eq('p.__pk', 'b._fk_property'), $qb->expr()->gte('b.start_date', ':date_from'), $qb->expr()->lte('b.end_date', ':date_end')
            ));
            $qb->setParameter(':date_from', $date_from);
            $qb->setParameter(':date_end', $date_to);
            $date_filter = true;
        }
        if ($date_filter) {
            $qb->andWhere($qb->expr()->isNull('b._fk_property'));
        }

        foreach ($criteria as $field => $value) {
            if (!$this->getClassMetadata()->hasField($field)) {
                //Make sure we only use existing fields (avoid any injection)
                continue;
            }
            if (!empty($value)) {

                if ($field == 'sleeps') {
                    $qb->andWhere($qb->expr()->gte('p.' . $field, ':p_' . $field))
                            ->setParameter('p_' . $field, $value);
                } elseif ($field == 'beds') {
                    $qb->andWhere($qb->expr()->gte('p.' . $field, ':p_' . $field))
                            ->setParameter('p_' . $field, $value);
                } else {

                    $qb->andWhere($qb->expr()->eq('p.' . $field, ':p_' . $field))
                            ->setParameter('p_' . $field, $value);
                }
            }
        }

        return $qb->getQuery();
    }

    private function formatDateToSql($criteria) {
        $date_from = null;
        if (($criteria['check_in']['year']) && ($criteria['check_in']['month']) &&
                ($criteria['check_in']['day'])) {
            $year = $criteria['check_in']['year'];
            $month = $criteria['check_in']['month'];
            $day = $criteria['check_in']['day'];
            $date_from = date("$year-$month-$day");
        }

        $date_to = null;
        if (($criteria['check_out']['year']) && ($criteria['check_out']['month']) &&
                ($criteria['check_out']['day'])) {
            $year = $criteria['check_out']['year'];
            $month = $criteria['check_out']['month'];
            $day = $criteria['check_out']['day'];
            $date_to = date("$year-$month-$day");
        }

        return array($date_from, $date_to);
    }

}
