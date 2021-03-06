<?php
namespace OliverHader\PlanningApp\Tests\Unit\Controller;

use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

/**
 * Test case.
 */
class LocationControllerTest extends UnitTestCase
{
    /**
     * @var \OliverHader\PlanningApp\Controller\LocationManagementController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\OliverHader\PlanningApp\Controller\LocationManagementController::class)
            ->setMethods(['redirect', 'forward', 'addFlashMessage'])
            ->disableOriginalConstructor()
            ->getMock();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function listActionFetchesAllLocationsFromRepositoryAndAssignsThemToView()
    {

        $allLocations = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $locationRepository = $this->getMockBuilder(\OliverHader\PlanningApp\Domain\Repository\LocationRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $locationRepository->expects(self::once())->method('findAll')->will(self::returnValue($allLocations));
        $this->inject($this->subject, 'locationRepository', $locationRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('locations', $allLocations);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenLocationToView()
    {
        $location = new \OliverHader\PlanningApp\Domain\Model\Location();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('location', $location);

        $this->subject->showAction($location);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenLocationToLocationRepository()
    {
        $location = new \OliverHader\PlanningApp\Domain\Model\Location();

        $locationRepository = $this->getMockBuilder(\OliverHader\PlanningApp\Domain\Repository\LocationRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $locationRepository->expects(self::once())->method('add')->with($location);
        $this->inject($this->subject, 'locationRepository', $locationRepository);

        $this->subject->createAction($location);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenLocationToView()
    {
        $location = new \OliverHader\PlanningApp\Domain\Model\Location();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('location', $location);

        $this->subject->editAction($location);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenLocationInLocationRepository()
    {
        $location = new \OliverHader\PlanningApp\Domain\Model\Location();

        $locationRepository = $this->getMockBuilder(\OliverHader\PlanningApp\Domain\Repository\LocationRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $locationRepository->expects(self::once())->method('update')->with($location);
        $this->inject($this->subject, 'locationRepository', $locationRepository);

        $this->subject->updateAction($location);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenLocationFromLocationRepository()
    {
        $location = new \OliverHader\PlanningApp\Domain\Model\Location();

        $locationRepository = $this->getMockBuilder(\OliverHader\PlanningApp\Domain\Repository\LocationRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $locationRepository->expects(self::once())->method('remove')->with($location);
        $this->inject($this->subject, 'locationRepository', $locationRepository);

        $this->subject->deleteAction($location);
    }
}
