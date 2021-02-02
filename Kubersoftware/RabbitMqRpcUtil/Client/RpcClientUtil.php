<?php

namespace Kubersoftware\RabbitMqRpcUtil\Client;

use Kubersoftware\SerializerUtil\SerializerUtil;
use Kubersoftware\SerializerUtil\Strategy\SymfonySerializerStrategyImpl;
use OldSound\RabbitMqBundle\RabbitMq\RpcClient;
use PhpAmqpLib\Exception\AMQPTimeoutException;
use Kubersoftware\Microservices\BaseObject;

class RpcClientUtil
{
    private RpcClient $rpcClient;

    public function __construct(RpcClient $rpcClient)
    {
        $this->rpcClient = $rpcClient;
    }

    /**
     * @param RpcClientDto $rpcClientDto
     * @return array
     */
    public function sendRpcRequest(RpcClientDto $rpcClientDto): array
    {
        $this->rpcClient->addRequest($rpcClientDto->getMessage(), $rpcClientDto->getRpcServerName(), $rpcClientDto->getRequestId(), $rpcClientDto->getRoutingKey(), $rpcClientDto->getExpiration());

        $replies = $this->rpcClient->getReplies();

        if (empty($replies)) {
            return [];
        }

        return $replies;
    }

    public function sendRpcRequestAndDeserialize(RpcClientDto $rpcClientDto, object $objectName): object
    {
        $this->rpcClient->addRequest($rpcClientDto->getMessage(), $rpcClientDto->getRpcServerName(), $rpcClientDto->getRequestId(), $rpcClientDto->getRoutingKey(), $rpcClientDto->getExpiration());

        $replies = $this->rpcClient->getReplies();
        dd($replies);

        if (empty($replies)) {
            return (BaseObject())->setObjectNull(true);
        }

        return (new SerializerUtil(new SymfonySerializerStrategyImpl()))->deserialize($replies[$rpcClientDto->getRequestId()], $objectName);
    }
}