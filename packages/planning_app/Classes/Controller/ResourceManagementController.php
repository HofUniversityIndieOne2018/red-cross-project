<?php
namespace OliverHader\PlanningApp\Controller;

use OliverHader\PlanningApp\Domain\Model\Resource;
use OliverHader\PlanningApp\Domain\Repository\ResourceRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/***
 * This file is part of the "Planning App" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 ***/

class ResourceManagementController extends ActionController
{
    /**
     * @var ResourceRepository
     */
    protected $resourceRepository = null;

    /**
     * @param ResourceRepository $resourceRepository
     */
    public function injectResourceRepository(ResourceRepository $resourceRepository)
    {
        $this->resourceRepository = $resourceRepository;
    }

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
     * @param Resource $resource
     * @return void
     */
    public function showAction(Resource $resource)
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
     * @param Resource $newResource
     * @return void
     */
    public function createAction(Resource $newResource)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->resourceRepository->add($newResource);
        $this->redirect('list');
    }

    /**
     * action edit
     *
     * @param Resource $resource
     * @ignorevalidation $resource
     * @return void
     */
    public function editAction(Resource $resource)
    {
        $this->view->assign('resource', $resource);
    }

    /**
     * action update
     *
     * @param Resource $resource
     * @return void
     */
    public function updateAction(Resource $resource)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->resourceRepository->update($resource);
        var_dump($resource->getImage());
        #$this->redirect('list');
    }

    /**
     * action delete
     *
     * @param Resource $resource
     * @return void
     */
    public function deleteAction(Resource $resource)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->resourceRepository->remove($resource);
        $this->redirect('list');
    }
}
