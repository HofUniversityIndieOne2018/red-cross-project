<?php
namespace OliverHader\PlanningApp\Tests\Unit\Controller;

use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

/**
 * Test case.
 */
class ResourceControllerTest extends UnitTestCase
{
    /**
     * @var \OliverHader\PlanningApp\Controller\ResourceManagementController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\OliverHader\PlanningApp\Controller\ResourceManagementController::class)
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
    public function listActionFetchesAllResourcesFromRepositoryAndAssignsThemToView()
    {

        $allResources = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $resourceRepository = $this->getMockBuilder(\OliverHader\PlanningApp\Domain\Repository\ResourceRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $resourceRepository->expects(self::once())->method('findAll')->will(self::returnValue($allResources));
        $this->inject($this->subject, 'resourceRepository', $resourceRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('resources', $allResources);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenResourceToView()
    {
        $resource = new \OliverHader\PlanningApp\Domain\Model\Resource();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('resource', $resource);

        $this->subject->showAction($resource);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenResourceToResourceRepository()
    {
        $resource = new \OliverHader\PlanningApp\Domain\Model\Resource();

        $resourceRepository = $this->getMockBuilder(\OliverHader\PlanningApp\Domain\Repository\ResourceRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $resourceRepository->expects(self::once())->method('add')->with($resource);
        $this->inject($this->subject, 'resourceRepository', $resourceRepository);

        $this->subject->createAction($resource);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenResourceToView()
    {
        $resource = new \OliverHader\PlanningApp\Domain\Model\Resource();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('resource', $resource);

        $this->subject->editAction($resource);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenResourceInResourceRepository()
    {
        $resource = new \OliverHader\PlanningApp\Domain\Model\Resource();

        $resourceRepository = $this->getMockBuilder(\OliverHader\PlanningApp\Domain\Repository\ResourceRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $resourceRepository->expects(self::once())->method('update')->with($resource);
        $this->inject($this->subject, 'resourceRepository', $resourceRepository);

        $this->subject->updateAction($resource);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenResourceFromResourceRepository()
    {
        $resource = new \OliverHader\PlanningApp\Domain\Model\Resource();

        $resourceRepository = $this->getMockBuilder(\OliverHader\PlanningApp\Domain\Repository\ResourceRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $resourceRepository->expects(self::once())->method('remove')->with($resource);
        $this->inject($this->subject, 'resourceRepository', $resourceRepository);

        $this->subject->deleteAction($resource);
    }
}
