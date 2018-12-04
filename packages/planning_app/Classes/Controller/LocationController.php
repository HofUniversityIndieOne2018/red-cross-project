<?php
namespace OliverHader\PlanningApp\Controller;

/***
 * This file is part of the "Planning App" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 ***/

/**
 * LocationController
 */
class LocationController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * locationRepository
     *
     * @var \OliverHader\PlanningApp\Domain\Repository\LocationRepository
     * @inject
     */
    protected $locationRepository = null;

    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $locations = $this->locationRepository->findAll();
        $this->view->assign('locations', $locations);
    }

    /**
     * action show
     *
     * @param \OliverHader\PlanningApp\Domain\Model\Location $location
     * @return void
     */
    public function showAction(\OliverHader\PlanningApp\Domain\Model\Location $location)
    {
        $this->view->assign('location', $location);
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
     * @param \OliverHader\PlanningApp\Domain\Model\Location $newLocation
     * @return void
     */
    public function createAction(\OliverHader\PlanningApp\Domain\Model\Location $newLocation)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->locationRepository->add($newLocation);
        $this->redirect('list');
    }

    /**
     * action edit
     *
     * @param \OliverHader\PlanningApp\Domain\Model\Location $location
     * @ignorevalidation $location
     * @return void
     */
    public function editAction(\OliverHader\PlanningApp\Domain\Model\Location $location)
    {
        $this->view->assign('location', $location);
    }

    /**
     * action update
     *
     * @param \OliverHader\PlanningApp\Domain\Model\Location $location
     * @return void
     */
    public function updateAction(\OliverHader\PlanningApp\Domain\Model\Location $location)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->locationRepository->update($location);
        $this->redirect('list');
    }

    /**
     * action delete
     *
     * @param \OliverHader\PlanningApp\Domain\Model\Location $location
     * @return void
     */
    public function deleteAction(\OliverHader\PlanningApp\Domain\Model\Location $location)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->locationRepository->remove($location);
        $this->redirect('list');
    }
}
