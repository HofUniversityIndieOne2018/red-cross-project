<?php
namespace OliverHader\PlanningApp\Domain\Repository;

use OliverHader\PlanningApp\Domain\Model\Activity;
use OliverHader\PlanningApp\Domain\Model\Volunteer;
use TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

/***
 * This file is part of the "Planning App" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 ***/

/**
 * The repository for Activities
 */
class ActivityRepository extends Repository
{
    /**
     * @param Volunteer $volunteer
     * @param null|int $limit
     * @return QueryResultInterface|Activity[]
     * @throws InvalidQueryException
     */
    public function findByVolunteer(Volunteer $volunteer, int $limit = null)
    {
        $query = $this->createQuery();
        $query->matching(
            $query->contains('volunteers', $volunteer)
        );
        if ($limit !== null) {
            $query->setLimit($limit);
        }
        return $query->execute();
        return $query->execute();
    }
}
