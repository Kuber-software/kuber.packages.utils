<?php

namespace Kubersoftware\RabbitMqRpcUtil\Client;

use OldSound\RabbitMqBundle\RabbitMq\RpcClient;
use PhpAmqpLib\Exception\AMQPTimeoutException;

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
}