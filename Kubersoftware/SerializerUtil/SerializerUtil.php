<?php
namespace Kubersoftware\SerializerUtil;


class SerializerUtil
{
    private SerializerStrategy $serializerStrategy;

    public function __construct(SerializerStrategy $serializerTool)
    {
        $this->serializerStrategy = $serializerTool;
    }

    public function serialize(object $data, string $format = 'json'): string
    {
        return $this->serializerStrategy->serialize($data, $format);
    }

    public function deserialize(string $data, string $objectName, string $format = 'json'): object
    {
        return $this->serializerStrategy->deserialize($data, $objectName, $format);
    }
}