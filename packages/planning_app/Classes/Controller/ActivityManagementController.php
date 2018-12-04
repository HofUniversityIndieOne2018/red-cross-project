<?php
namespace OliverHader\PlanningApp\Controller;

use OliverHader\PlanningApp\Domain\Repository\ActivityRepository;

/***
 * This file is part of the "Planning App" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 ***/

/**
 * ActivityController
 */
class ActivityManagementController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * @var ActivityRepository
     */
    protected $activityRepository = null;

    /**
     * @param ActivityRepository $activityRepository
     */
    public function injectActivityRepository(ActivityRepository $activityRepository)
    {
        $this->activityRepository = $activityRepository;
    }

    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $activities = $this->activityRepository->findAll();
        $this->view->assign('activities', $activities);
    }

    /**
     * action show
     *
     * @param \OliverHader\PlanningApp\Domain\Model\Activity $activity
     * @return void
     */
    public function showAction(\OliverHader\PlanningApp\Domain\Model\Activity $activity)
    {
        $this->view->assign('activity', $activity);
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
     * @param \OliverHader\PlanningApp\Domain\Model\Activity $newActivity
     * @return void
     */
    public function createAction(\OliverHader\PlanningApp\Domain\Model\Activity $newActivity)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->activityRepository->add($newActivity);
        $this->redirect('list');
    }

    /**
     * action edit
     *
     * @param \OliverHader\PlanningApp\Domain\Model\Activity $activity
     * @ignorevalidation $activity
     * @return void
     */
    public function editAction(\OliverHader\PlanningApp\Domain\Model\Activity $activity)
    {
        $this->view->assign('activity', $activity);
    }

    /**
     * action update
     *
     * @param \OliverHader\PlanningApp\Domain\Model\Activity $activity
     * @return void
     */
    public function updateAction(\OliverHader\PlanningApp\Domain\Model\Activity $activity)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->activityRepository->update($activity);
        $this->redirect('list');
    }

    /**
     * action delete
     *
     * @param \OliverHader\PlanningApp\Domain\Model\Activity $activity
     * @return void
     */
    public function deleteAction(\OliverHader\PlanningApp\Domain\Model\Activity $activity)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->activityRepository->remove($activity);
        $this->redirect('list');
    }
}
