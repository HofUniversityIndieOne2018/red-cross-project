<?php
namespace OliverHader\PlanningApp\Domain\Model;

/***
 *
 * This file is part of the "Planning App" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2018
 *
 ***/

/**
 * Date Period
 */
class DatePeriod extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * Start Time
     *
     * @var \DateTime
     * @validate NotEmpty
     */
    protected $startTime = null;

    /**
     * End Time
     *
     * @var \DateTime
     * @validate NotEmpty
     */
    protected $endTime = null;

    /**
     * Returns the startTime
     *
     * @return \DateTime $startTime
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * Sets the startTime
     *
     * @param \DateTime $startTime
     * @return void
     */
    public function setStartTime(\DateTime $startTime)
    {
        $this->startTime = $startTime;
    }

    /**
     * Returns the endTime
     *
     * @return \DateTime $endTime
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * Sets the endTime
     *
     * @param \DateTime $endTime
     * @return void
     */
    public function setEndTime(\DateTime $endTime)
    {
        $this->endTime = $endTime;
    }
}
