<?php
namespace OliverHader\PlanningApp\Controller;

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
 * VolunteerController
 */
class VolunteerController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * volunteerRepository
     *
     * @var \OliverHader\PlanningApp\Domain\Repository\VolunteerRepository
     * @inject
     */
    protected $volunteerRepository = null;

    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $volunteers = $this->volunteerRepository->findAll();
        $this->view->assign('volunteers', $volunteers);
    }

    /**
     * action show
     *
     * @param \OliverHader\PlanningApp\Domain\Model\Volunteer $volunteer
     * @return void
     */
    public function showAction(\OliverHader\PlanningApp\Domain\Model\Volunteer $volunteer)
    {
        $this->view->assign('volunteer', $volunteer);
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
     * @param \OliverHader\PlanningApp\Domain\Model\Volunteer $newVolunteer
     * @return void
     */
    public function createAction(\OliverHader\PlanningApp\Domain\Model\Volunteer $newVolunteer)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->volunteerRepository->add($newVolunteer);
        $this->redirect('list');
    }

    /**
     * action edit
     *
     * @param \OliverHader\PlanningApp\Domain\Model\Volunteer $volunteer
     * @ignorevalidation $volunteer
     * @return void
     */
    public function editAction(\OliverHader\PlanningApp\Domain\Model\Volunteer $volunteer)
    {
        $this->view->assign('volunteer', $volunteer);
    }

    /**
     * action update
     *
     * @param \OliverHader\PlanningApp\Domain\Model\Volunteer $volunteer
     * @return void
     */
    public function updateAction(\OliverHader\PlanningApp\Domain\Model\Volunteer $volunteer)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->volunteerRepository->update($volunteer);
        $this->redirect('list');
    }

    /**
     * action delete
     *
     * @param \OliverHader\PlanningApp\Domain\Model\Volunteer $volunteer
     * @return void
     */
    public function deleteAction(\OliverHader\PlanningApp\Domain\Model\Volunteer $volunteer)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->volunteerRepository->remove($volunteer);
        $this->redirect('list');
    }
}
