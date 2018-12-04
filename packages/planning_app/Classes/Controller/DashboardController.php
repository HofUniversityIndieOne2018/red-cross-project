<?php
namespace OliverHader\PlanningApp\Controller;

use OliverHader\PlanningApp\Domain\Model\Activity;
use OliverHader\PlanningApp\Domain\Model\Volunteer;
use OliverHader\PlanningApp\Domain\Repository\ActivityRepository;
use OliverHader\PlanningApp\Domain\Repository\VolunteerRepository;
use OliverHader\SessionService\SubjectResolver;
use TYPO3\CMS\Core\Messaging\FlashMessage;

/***
 * This file is part of the "Planning App" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 ***/

/**
 * VolunteerController
 */
class DashboardController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
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

    public function indexAction()
    {
        $activities = $this->activityRepository->findByVolunteer(
            $this->currentVolunteer,
            3
        );

        $this->view->assign('activities', $activities);
        $this->view->assign('currentVolunteer', $this->currentVolunteer);
    }

    public function editProfileAction()
    {
        $this->view->assign('currentVolunteer', $this->currentVolunteer);
    }

    public function updateProfileAction(Volunteer $volunteer)
    {
        if ($volunteer->getUid() !== $this->currentVolunteer->getUid()) {
            $this->addFlashMessage('Invalid volunteer', '', FlashMessage::ERROR);
            $this->redirect('index');
        }

        $this->volunteerRepository->update($volunteer);
        $this->redirect('index');
    }

    public function myActivitiesAction()
    {
        $activities = $this->activityRepository->findByVolunteer(
            $this->currentVolunteer
        );

        $this->view->assign('activities', $activities);
        $this->view->assign('currentVolunteer', $this->currentVolunteer);
        $this->view->assign('previousAction', 'myActivities');
    }

    /**
     */
    public function allActivitiesAction()
    {
        $activities = $this->activityRepository->findAll();
        $this->view->assign('activities', $activities);
        $this->view->assign('currentVolunteer', $this->currentVolunteer);
        $this->view->assign('previousAction', 'allActivities');
    }

    /**
     * @param Activity $activity
     * @param string $previousAction
     */
    public function showActivityAction(Activity $activity, string $previousAction = null)
    {
        $this->view->assign('activity', $activity);
        $this->view->assign('currentVolunteer', $this->currentVolunteer);
        $this->view->assign('previousAction', $previousAction);
    }

    public function subscribeAction(Activity $activity)
    {
        if ($activity->getVolunteers()->offsetExists($this->currentVolunteer)) {
            $this->addFlashMessage('Already subscribed', '', FlashMessage::NOTICE);
            $this->redirect('allActivities');
        }

        $activity->addVolunteer($this->currentVolunteer);
        $this->activityRepository->update($activity);
        $this->addFlashMessage('Sucessfully subscribed');
        $this->redirect('myActivities');
    }

    public function unsubscribeAction(Activity $activity)
    {
        if (!$activity->getVolunteers()->offsetExists($this->currentVolunteer)) {
            $this->addFlashMessage('Not subscribed', '', FlashMessage::NOTICE);
            $this->redirect('myActivities');
        }

        $activity->removeVolunteer($this->currentVolunteer);
        $this->activityRepository->update($activity);
        $this->addFlashMessage('Sucessfully unsubscribed');
        $this->redirect('allActivities');
    }
}
