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
 * Activity
 */
class Activity extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * Title
     *
     * @var string
     * @validate NotEmpty
     */
    protected $title = '';

    /**
     * Location
     *
     * @var \OliverHader\PlanningApp\Domain\Model\Location
     */
    protected $location = null;

    /**
     * Time Frames
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\OliverHader\PlanningApp\Domain\Model\DatePeriod>
     * @cascade remove
     */
    protected $timeFrames = null;

    /**
     * Volunteers
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\OliverHader\PlanningApp\Domain\Model\Volunteer>
     */
    protected $volunteers = null;

    /**
     * Resources
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\OliverHader\PlanningApp\Domain\Model\Resource>
     */
    protected $resources = null;

    /**
     * Returns the title
     *
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Sets the title
     *
     * @param string $title
     * @return void
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * __construct
     */
    public function __construct()
    {
        //Do not remove the next line: It would break the functionality
        $this->initStorageObjects();
    }

    /**
     * Initializes all ObjectStorage properties
     * Do not modify this method!
     * It will be rewritten on each save in the extension builder
     * You may modify the constructor of this class instead
     *
     * @return void
     */
    protected function initStorageObjects()
    {
        $this->timeFrames = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->volunteers = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->resources = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * Returns the location
     *
     * @return \OliverHader\PlanningApp\Domain\Model\Location $location
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Sets the location
     *
     * @param \OliverHader\PlanningApp\Domain\Model\Location $location
     * @return void
     */
    public function setLocation(\OliverHader\PlanningApp\Domain\Model\Location $location)
    {
        $this->location = $location;
    }

    /**
     * Adds a DatePeriod
     *
     * @param \OliverHader\PlanningApp\Domain\Model\DatePeriod $timeFrame
     * @return void
     */
    public function addTimeFrame(\OliverHader\PlanningApp\Domain\Model\DatePeriod $timeFrame)
    {
        $this->timeFrames->attach($timeFrame);
    }

    /**
     * Removes a DatePeriod
     *
     * @param \OliverHader\PlanningApp\Domain\Model\DatePeriod $timeFrameToRemove The DatePeriod to be removed
     * @return void
     */
    public function removeTimeFrame(\OliverHader\PlanningApp\Domain\Model\DatePeriod $timeFrameToRemove)
    {
        $this->timeFrames->detach($timeFrameToRemove);
    }

    /**
     * Returns the timeFrames
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\OliverHader\PlanningApp\Domain\Model\DatePeriod> $timeFrames
     */
    public function getTimeFrames()
    {
        return $this->timeFrames;
    }

    /**
     * Sets the timeFrames
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\OliverHader\PlanningApp\Domain\Model\DatePeriod> $timeFrames
     * @return void
     */
    public function setTimeFrames(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $timeFrames)
    {
        $this->timeFrames = $timeFrames;
    }

    /**
     * Adds a Volunteer
     *
     * @param \OliverHader\PlanningApp\Domain\Model\Volunteer $volunteer
     * @return void
     */
    public function addVolunteer(\OliverHader\PlanningApp\Domain\Model\Volunteer $volunteer)
    {
        $this->volunteers->attach($volunteer);
    }

    /**
     * Removes a Volunteer
     *
     * @param \OliverHader\PlanningApp\Domain\Model\Volunteer $volunteerToRemove The Volunteer to be removed
     * @return void
     */
    public function removeVolunteer(\OliverHader\PlanningApp\Domain\Model\Volunteer $volunteerToRemove)
    {
        $this->volunteers->detach($volunteerToRemove);
    }

    /**
     * Returns the volunteers
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\OliverHader\PlanningApp\Domain\Model\Volunteer> $volunteers
     */
    public function getVolunteers()
    {
        return $this->volunteers;
    }

    /**
     * Sets the volunteers
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\OliverHader\PlanningApp\Domain\Model\Volunteer> $volunteers
     * @return void
     */
    public function setVolunteers(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $volunteers)
    {
        $this->volunteers = $volunteers;
    }

    /**
     * Adds a Resource
     *
     * @param \OliverHader\PlanningApp\Domain\Model\Resource $resource
     * @return void
     */
    public function addResource(\OliverHader\PlanningApp\Domain\Model\Resource $resource)
    {
        $this->resources->attach($resource);
    }

    /**
     * Removes a Resource
     *
     * @param \OliverHader\PlanningApp\Domain\Model\Resource $resourceToRemove The Resource to be removed
     * @return void
     */
    public function removeResource(\OliverHader\PlanningApp\Domain\Model\Resource $resourceToRemove)
    {
        $this->resources->detach($resourceToRemove);
    }

    /**
     * Returns the resources
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\OliverHader\PlanningApp\Domain\Model\Resource> $resources
     */
    public function getResources()
    {
        return $this->resources;
    }

    /**
     * Sets the resources
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\OliverHader\PlanningApp\Domain\Model\Resource> $resources
     * @return void
     */
    public function setResources(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $resources)
    {
        $this->resources = $resources;
    }
}
