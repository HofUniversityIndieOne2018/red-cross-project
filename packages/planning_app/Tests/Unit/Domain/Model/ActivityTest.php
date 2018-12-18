<?php
namespace OliverHader\PlanningApp\Tests\Unit\Domain\Model;

use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

/**
 * Test case.
 */
class ActivityTest extends UnitTestCase
{
    /**
     * @var \OliverHader\PlanningApp\Domain\Model\Activity
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \OliverHader\PlanningApp\Domain\Model\Activity();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getTitleReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getTitle()
        );
    }

    /**
     * @test
     */
    public function setTitleForStringSetsTitle()
    {
        $this->subject->setTitle('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'title',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getLocationReturnsInitialValueForLocation()
    {
        self::assertEquals(
            null,
            $this->subject->getLocation()
        );
    }

    /**
     * @test
     */
    public function setLocationForLocationSetsLocation()
    {
        $locationFixture = new \OliverHader\PlanningApp\Domain\Model\Location();
        $this->subject->setLocation($locationFixture);

        self::assertAttributeEquals(
            $locationFixture,
            'location',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getTimeFramesReturnsInitialValueForDatePeriod()
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getTimeFrames()
        );
    }

    /**
     * @test
     */
    public function setTimeFramesForObjectStorageContainingDatePeriodSetsTimeFrames()
    {
        $timeFrame = new \OliverHader\PlanningApp\Domain\Model\DatePeriod();
        $objectStorageHoldingExactlyOneTimeFrames = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneTimeFrames->attach($timeFrame);
        $this->subject->setTimeFrames($objectStorageHoldingExactlyOneTimeFrames);

        self::assertAttributeEquals(
            $objectStorageHoldingExactlyOneTimeFrames,
            'timeFrames',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function addTimeFrameToObjectStorageHoldingTimeFrames()
    {
        $timeFrame = new \OliverHader\PlanningApp\Domain\Model\DatePeriod();
        $timeFramesObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $timeFramesObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($timeFrame));
        $this->inject($this->subject, 'timeFrames', $timeFramesObjectStorageMock);

        $this->subject->addTimeFrame($timeFrame);
    }

    /**
     * @test
     */
    public function removeTimeFrameFromObjectStorageHoldingTimeFrames()
    {
        $timeFrame = new \OliverHader\PlanningApp\Domain\Model\DatePeriod();
        $timeFramesObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $timeFramesObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($timeFrame));
        $this->inject($this->subject, 'timeFrames', $timeFramesObjectStorageMock);

        $this->subject->removeTimeFrame($timeFrame);
    }

    /**
     * @test
     */
    public function getVolunteersReturnsInitialValueForVolunteer()
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getVolunteers()
        );
    }

    /**
     * @test
     */
    public function setVolunteersForObjectStorageContainingVolunteerSetsVolunteers()
    {
        $volunteer = new \OliverHader\PlanningApp\Domain\Model\Volunteer();
        $objectStorageHoldingExactlyOneVolunteers = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneVolunteers->attach($volunteer);
        $this->subject->setVolunteers($objectStorageHoldingExactlyOneVolunteers);

        self::assertAttributeEquals(
            $objectStorageHoldingExactlyOneVolunteers,
            'volunteers',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function addVolunteerToObjectStorageHoldingVolunteers()
    {
        $volunteer = new \OliverHader\PlanningApp\Domain\Model\Volunteer();
        $volunteersObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $volunteersObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($volunteer));
        $this->inject($this->subject, 'volunteers', $volunteersObjectStorageMock);

        $this->subject->addVolunteer($volunteer);
    }

    /**
     * @test
     */
    public function removeVolunteerFromObjectStorageHoldingVolunteers()
    {
        $volunteer = new \OliverHader\PlanningApp\Domain\Model\Volunteer();
        $volunteersObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $volunteersObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($volunteer));
        $this->inject($this->subject, 'volunteers', $volunteersObjectStorageMock);

        $this->subject->removeVolunteer($volunteer);
    }

    /**
     * @test
     */
    public function getResourcesReturnsInitialValueForResource()
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getResources()
        );
    }

    /**
     * @test
     */
    public function setResourcesForObjectStorageContainingResourceSetsResources()
    {
        $resource = new \OliverHader\PlanningApp\Domain\Model\Resource();
        $objectStorageHoldingExactlyOneResources = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneResources->attach($resource);
        $this->subject->setResources($objectStorageHoldingExactlyOneResources);

        self::assertAttributeEquals(
            $objectStorageHoldingExactlyOneResources,
            'resources',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function addResourceToObjectStorageHoldingResources()
    {
        $resource = new \OliverHader\PlanningApp\Domain\Model\Resource();
        $resourcesObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $resourcesObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($resource));
        $this->inject($this->subject, 'resources', $resourcesObjectStorageMock);

        $this->subject->addResource($resource);
    }

    /**
     * @test
     */
    public function removeResourceFromObjectStorageHoldingResources()
    {
        $resource = new \OliverHader\PlanningApp\Domain\Model\Resource();
        $resourcesObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $resourcesObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($resource));
        $this->inject($this->subject, 'resources', $resourcesObjectStorageMock);

        $this->subject->removeResource($resource);
    }
}
