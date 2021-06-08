<?php
namespace NeosRulez\CacheManager\Controller;

/*
 * This file is part of the NeosRulez.CacheManager package.
 */

use Neos\Error\Messages\Message;
use Neos\Flow\Annotations as Flow;
use Neos\Flow\Cache\CacheManager;
use Neos\Neos\Controller\Module\AbstractModuleController;
use Neos\Fusion\View\FusionView;

class CacheController extends AbstractModuleController
{

    protected $defaultViewObjectName = FusionView::class;

    /**
     * @Flow\Inject
     * @var CacheManager
     */
    protected $cacheManager;

    /**
     * @Flow\InjectConfiguration(path="caches")
     * @var array
     */
    protected $cacheConfiguration;


    /**
     * @return void
     * @throws \Neos\Cache\Exception\NoSuchCacheException
     */
    public function indexAction()
    {
        foreach ($this->cacheConfiguration as $cacheIdentifier => $label) {
            $this->cacheConfiguration[$cacheIdentifier]['backendType'] = get_class($this->cacheManager->getCache($cacheIdentifier)->getBackend());
        }
        $this->view->assign('caches', $this->cacheConfiguration);
    }

    /**
     * @param string $cacheIdentifier
     * @Flow\Validate(argumentName="cacheIdentifier", type="\Neos\Flow\Validation\Validator\NotEmptyValidator")
     * @return void
     * @throws \Neos\Cache\Exception\NoSuchCacheException
     * @throws \Neos\Flow\Mvc\Exception\StopActionException
     */
    public function flushAction($cacheIdentifier)
    {
        if(array_key_exists($cacheIdentifier, $this->cacheConfiguration)) {
            $this->cacheManager->getCache($cacheIdentifier)->flush();
            $this->addFlashMessage('Successfully flushed the cache "%s".', 'Cache cleared', Message::SEVERITY_OK, [$cacheIdentifier], 1448033946);
        }else{
            $this->addFlashMessage('Cache "%s" is not configured for flushing.', 'Not configured', Message::SEVERITY_ERROR, [$cacheIdentifier], 1550221927);
        }
        $this->redirect('index');
    }
}
