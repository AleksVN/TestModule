<?php


namespace Voloshkov\News\Controller\Novyna;

use Magento\Analytics\Model\Exception\State\SubscriptionUpdateException;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\LocalizedException;
use Voloshkov\News\Model\ResourceModel\NewsResource;

class Save extends Action
{

    private $factoryModel;
    private $resourceNews;

    public function __construct(
        Context $context,
        NewsResource $newsResource,
        \Voloshkov\News\Model\NewsModelFactory $modelFactory
    ) {
        parent::__construct($context);
        $this->resourceNews = $newsResource;
        $this->factoryModel = $modelFactory;
    }

    public function execute()
    {

        $title = $this->getRequest()->getParam('title');
        $description = $this->getRequest()->getParam('description');
        $content = $this->getRequest()->getParam('content');

        $model = $this->factoryModel->create();

        $id = $this->getRequest()->getParam('id');

        if (!$id) {
            $model->setData('title', $title);
            $model->setData('description', $description);
            $model->setData('content', $content);

            $this->resourceNews->save($model);
        } else {
            $model->setId($id);
            $model->setData('title', $title);
            $model->setData('description', $description);
            $model->setData('content', $content);

            $this->resourceNews->save($model);
        }

        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $this->messageManager->addSuccessMessage(__('Saved'));
        $resultRedirect->setPath("*/*/view/id/{$model->getId()}");

        return $resultRedirect;

    }
}

