<?php

namespace Voloshkov\News\Controller\Novyna;

use Magento\Framework\App\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\ResultFactory;
use Voloshkov\News\Model\ResourceModel\NewsResource;
use Voloshkov\News\Model\ResourceModel\Col\Collection;


class Index extends Action\Action
{

    private $resourceNews;
    private $factoryModel;
    private $factoryCollection;

    public function __construct(
        Context $context,
        NewsResource $newsResource,
        \Voloshkov\News\Model\NewsModelFactory $modelFactory,
        \Voloshkov\News\Model\ResourceModel\Col\CollectionFactory $collectionFactory
    ) {
        parent::__construct($context);
        $this->resourceNews = $newsResource;
        $this->factoryModel = $modelFactory;
        $this->factoryCollection = $collectionFactory;
    }

    public function execute()
    {
        $sortDate = $this->getRequest()->getParam('sort_date');
        $collection = $this->factoryCollection->create();
        $models = $collection->sort($sortDate)->load()->getItems();

        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);

        $block = $resultPage->getLayout()->getBlock('testBlock');
        $block->setData('novyni', $models);

        return $resultPage;

    }
}
