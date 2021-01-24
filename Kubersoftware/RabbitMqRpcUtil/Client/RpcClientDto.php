<?php


namespace Kubersoftware\RabbitMqRpcUtil\Client;


class RpcClientDto
{
    /**
     * Сообщение в формате json
     *
     * @var string
     */
    private string $message;

    /**
     * Имя Rpc сервера, обычно указывается в конфигурационном файле
     *
     * @var string
     */
    private string $rpcServerName;

    /**
     * ID запроса. По-умолчанию будет сгенерирован автоматически
     *
     * @var string
     */
    private string $requestId;

    /**
     * @var string
     */
    private string $routingKey = 'default';

    /**
     * Максимальное время ожидания ответа
     *
     * @var int
     */
    private int $expiration = 10;


    public function __construct()
    {
        $this->requestId = bin2hex(random_bytes(20));
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     * @return RpcClientDto
     */
    public function setMessage(string $message): RpcClientDto
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return string
     */
    public function getRpcServerName(): string
    {
        return $this->rpcServerName;
    }

    /**
     * @param string $rpcServerName
     * @return RpcClientDto
     */
    public function setRpcServerName(string $rpcServerName): RpcClientDto
    {
        $this->rpcServerName = $rpcServerName;
        return $this;
    }

    /**
     * @return string
     */
    public function getRequestId(): string
    {
        return $this->requestId;
    }

    /**
     * @param string $requestId
     * @return RpcClientDto
     */
    public function setRequestId(string $requestId): RpcClientDto
    {
        $this->requestId = $requestId;
        return $this;
    }

    /**
     * @return string
     */
    public function getRoutingKey(): string
    {
        return $this->routingKey;
    }

    /**
     * @param string $routingKey
     * @return RpcClientDto
     */
    public function setRoutingKey(string $routingKey): RpcClientDto
    {
        $this->routingKey = $routingKey;
        return $this;
    }

    /**
     * @return int
     */
    public function getExpiration(): int
    {
        return $this->expiration;
    }

    /**
     * @param int $expiration
     * @return RpcClientDto
     */
    public function setExpiration(int $expiration): RpcClientDto
    {
        $this->expiration = $expiration;
        return $this;
    }
}