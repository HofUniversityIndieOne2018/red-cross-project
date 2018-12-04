<?php
namespace OliverHader\PlanningApp\Controller;

use OliverHader\PlanningApp\Domain\Model\Volunteer;
use OliverHader\PlanningApp\Domain\Repository\ActivityRepository;
use OliverHader\PlanningApp\Domain\Repository\VolunteerRepository;
use OliverHader\SessionService\SubjectResolver;

/***
 * This file is part of the "Planning App" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 ***/

/**
 * VolunteerController
 */
class VolunteerController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * @var VolunteerRepository
     */
    protected $volunteerRepository = null;

    /**
     * @var ActivityRepository
     */
    protected $activityRepository;

    /**
     * @var Volunteer
     */
    private $currentVolunteer;

    /**
     * @param VolunteerRepository $volunteerRepository
     */
    public function injectVolunteerRepository(VolunteerRepository $volunteerRepository)
    {
        $this->volunteerRepository = $volunteerRepository;
    }

    /**
     * @param ActivityRepository $activityRepository
     */
    public function injectActivityRepository(ActivityRepository $activityRepository)
    {
        $this->activityRepository = $activityRepository;
    }

    public function initializeAction()
    {
        parent::initializeAction();
        $this->currentVolunteer = SubjectResolver::get()
            ->forClassName(Volunteer::class)
            ->forPropertyName('user')
            ->resolve();
    }

    /**
     */
    public function listAction()
    {
        $this->view->assign('volunteers', [$this->currentVolunteer]);
    }

    /**
     * @param Volunteer $volunteer
     */
    public function showAction(Volunteer $volunteer)
    {
        if ($this->currentVolunteer->getUid() !== $volunteer->getUid()) {
            $this->addErrorFlashMessage('Insufficient permissions');
            $this->redirect('list');
        }

        $activities = $this->activityRepository->findByVolunteer($volunteer);
        $this->view->assignMultiple([
            'allowed' => true,
            'volunteer' => $volunteer,
            'activities' => $activities,
        ]);
    }

    /**
     * action new
     *
     * @return void
     */
    public function newAction()
    {

    }

    /**
     * action create
     *
     * @param Volunteer $newVolunteer
     * @return void
     */
    public function createAction(Volunteer $newVolunteer)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->volunteerRepository->add($newVolunteer);
        $this->redirect('list');
    }

    /**
     * action edit
     *
     * @param Volunteer $volunteer
     * @ignorevalidation $volunteer
     * @return void
     */
    public function editAction(Volunteer $volunteer)
    {
        $this->view->assign('volunteer', $volunteer);
    }

    /**
     * action update
     *
     * @param Volunteer $volunteer
     * @return void
     */
    public function updateAction(Volunteer $volunteer)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->volunteerRepository->update($volunteer);
        $this->redirect('list');
    }

    /**
     * action delete
     *
     * @param Volunteer $volunteer
     * @return void
     */
    public function deleteAction(Volunteer $volunteer)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->volunteerRepository->remove($volunteer);
        $this->redirect('list');
    }
}
