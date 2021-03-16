<?php

namespace Voloshkov\News\Controller\Novyna;

use Magento\Authorization\Model\UserContextInterface;
use Magento\Framework\App\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\ResultFactory;
use Voloshkov\News\Model\ResourceModel\NewsResource;

class Edit extends Action\Action
{
    private $resourceNews;
    private $factoryModel;
    private $userContext;

    public function __construct(
        Context $context,
        NewsResource $newsResource,
        \Voloshkov\News\Model\NewsModelFactory $modelFactory,
        UserContextInterface $userContext
    ) {
        parent::__construct($context);
        $this->resourceNews = $newsResource;
        $this->factoryModel = $modelFactory;
        $this->userContext = $userContext;
    }

    public function execute()
    {

        $userType = $this->userContext->getUserType();
        if ($userType != \Magento\Authorization\Model\UserContextInterface::USER_TYPE_CUSTOMER) {
            $resultForward = $this->resultFactory->create(ResultFactory::TYPE_FORWARD);
            $resultForward->forward('noroute');

            return $resultForward;
        }
        $id = $this->getRequest()->getParam('id');

        $model = $this->factoryModel->create();
        $this->resourceNews->load($model, $id);

        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);

        $block = $resultPage->getLayout()->getBlock('testBlock');
        $block->setData('novyna', $model);

        return $resultPage;

    }
}
