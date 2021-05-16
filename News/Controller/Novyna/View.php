<?php

namespace Voloshkov\News\Controller\Novyna;

use Magento\Authorization\Model\UserContextInterface;
use Magento\Framework\App\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\ResultFactory;
use Voloshkov\News\Model\ResourceModel\NewsResource;

class View extends Action\Action
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
        $id = $this->getRequest()->getParam('id');

        if ($id) {
            $model = $this->factoryModel->create();
            $this->resourceNews->load($model, $id);

            if ($model->getId()) {

                $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);

                $block = $resultPage->getLayout()->getBlock('news.view');
                $block->setData('novyna', $model);

                $userType = $this->userContext->getUserType();
                $block->setData('userType', $userType);

               return $resultPage;

            }
        }

        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $this->messageManager->addErrorMessage(__('Not found'));

        return $resultRedirect->setPath("*/*/");
    }
}
