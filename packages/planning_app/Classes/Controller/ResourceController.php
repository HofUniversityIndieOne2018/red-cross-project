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
 * ResourceController
 */
class ResourceController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * resourceRepository
     *
     * @var \OliverHader\PlanningApp\Domain\Repository\ResourceRepository
     * @inject
     */
    protected $resourceRepository = null;

    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $resources = $this->resourceRepository->findAll();
        $this->view->assign('resources', $resources);
    }

    /**
     * action show
     *
     * @param \OliverHader\PlanningApp\Domain\Model\Resource $resource
     * @return void
     */
    public function showAction(\OliverHader\PlanningApp\Domain\Model\Resource $resource)
    {
        $this->view->assign('resource', $resource);
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
     * @param \OliverHader\PlanningApp\Domain\Model\Resource $newResource
     * @return void
     */
    public function createAction(\OliverHader\PlanningApp\Domain\Model\Resource $newResource)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->resourceRepository->add($newResource);
        $this->redirect('list');
    }

    /**
     * action edit
     *
     * @param \OliverHader\PlanningApp\Domain\Model\Resource $resource
     * @ignorevalidation $resource
     * @return void
     */
    public function editAction(\OliverHader\PlanningApp\Domain\Model\Resource $resource)
    {
        $this->view->assign('resource', $resource);
    }

    /**
     * action update
     *
     * @param \OliverHader\PlanningApp\Domain\Model\Resource $resource
     * @return void
     */
    public function updateAction(\OliverHader\PlanningApp\Domain\Model\Resource $resource)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->resourceRepository->update($resource);
        $this->redirect('list');
    }

    /**
     * action delete
     *
     * @param \OliverHader\PlanningApp\Domain\Model\Resource $resource
     * @return void
     */
    public function deleteAction(\OliverHader\PlanningApp\Domain\Model\Resource $resource)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->resourceRepository->remove($resource);
        $this->redirect('list');
    }
}
