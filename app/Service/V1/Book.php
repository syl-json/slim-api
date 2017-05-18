<?php

namespace App\Service\V1;

use App\Dao\Mongo\BookDao;
use App\Service\Service;
use Psr\Container\ContainerInterface;

class Book extends Service
{
    function __construct(ContainerInterface $c)
    {
        parent::__construct($c);
    }

    // 处理书籍列表请求
    public function handleActionList(&$resCode, &$resMsg, &$resData)
    {
        $dbData = $this->container->BookDao->getAll();

        $resData = $dbData;

        return;
    }

    // 处理书籍详情请求
    public function handleActionDetail($id, &$resCode, &$resMsg, &$resData)
    {
        $dbData = $this->container->BookDao->getById(['_id' => intval($id)]);

        if (!$dbData) {
            $resData = [];
            return;
        }

        $resData = $dbData;

        return;
    }

    // 处理书籍添加请求
    public function handleActionAdd($postData, &$resCode, &$resMsg, &$resData)
    {
        $id = $this->container->BookDao->addNew($postData);

        if (!$id) {
            $resCode = -1;
            $resMsg = 'failed';

            return;
        }

        $resData = $id;

        return;
    }

    // 处理书籍编辑请求
    public function handleActionUpdate($id, $putData, &$resCode, &$resMsg)
    {
        $result = $this->container->BookDao->updateById(['_id' => intval($id)], $resData);

        if (!$result) {
            $resCode = -1;
            $resMsg = 'failed';
        }

        return;
    }

    // 处理书籍删除请求
    public function handleActionDelete($id, &$resCode, &$resMsg)
    {
        $result = $this->container->BookDao->deleteById(['_id' => intval($id)]);

        if (!$result) {
            $resCode = -1;
            $resMsg = 'failed';
        }

        return;
    }
}
?>