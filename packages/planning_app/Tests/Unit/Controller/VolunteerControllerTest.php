<?php
namespace OliverHader\PlanningApp\Tests\Unit\Controller;

/**
 * Test case.
 */
class VolunteerControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \OliverHader\PlanningApp\Controller\VolunteerController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\OliverHader\PlanningApp\Controller\VolunteerController::class)
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
    public function listActionFetchesAllVolunteersFromRepositoryAndAssignsThemToView()
    {

        $allVolunteers = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $volunteerRepository = $this->getMockBuilder(\OliverHader\PlanningApp\Domain\Repository\VolunteerRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $volunteerRepository->expects(self::once())->method('findAll')->will(self::returnValue($allVolunteers));
        $this->inject($this->subject, 'volunteerRepository', $volunteerRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('volunteers', $allVolunteers);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenVolunteerToView()
    {
        $volunteer = new \OliverHader\PlanningApp\Domain\Model\Volunteer();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('volunteer', $volunteer);

        $this->subject->showAction($volunteer);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenVolunteerToVolunteerRepository()
    {
        $volunteer = new \OliverHader\PlanningApp\Domain\Model\Volunteer();

        $volunteerRepository = $this->getMockBuilder(\OliverHader\PlanningApp\Domain\Repository\VolunteerRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $volunteerRepository->expects(self::once())->method('add')->with($volunteer);
        $this->inject($this->subject, 'volunteerRepository', $volunteerRepository);

        $this->subject->createAction($volunteer);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenVolunteerToView()
    {
        $volunteer = new \OliverHader\PlanningApp\Domain\Model\Volunteer();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('volunteer', $volunteer);

        $this->subject->editAction($volunteer);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenVolunteerInVolunteerRepository()
    {
        $volunteer = new \OliverHader\PlanningApp\Domain\Model\Volunteer();

        $volunteerRepository = $this->getMockBuilder(\OliverHader\PlanningApp\Domain\Repository\VolunteerRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $volunteerRepository->expects(self::once())->method('update')->with($volunteer);
        $this->inject($this->subject, 'volunteerRepository', $volunteerRepository);

        $this->subject->updateAction($volunteer);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenVolunteerFromVolunteerRepository()
    {
        $volunteer = new \OliverHader\PlanningApp\Domain\Model\Volunteer();

        $volunteerRepository = $this->getMockBuilder(\OliverHader\PlanningApp\Domain\Repository\VolunteerRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $volunteerRepository->expects(self::once())->method('remove')->with($volunteer);
        $this->inject($this->subject, 'volunteerRepository', $volunteerRepository);

        $this->subject->deleteAction($volunteer);
    }
}