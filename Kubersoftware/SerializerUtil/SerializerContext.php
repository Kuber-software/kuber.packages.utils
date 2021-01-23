<?php
namespace Kubersoftware\SerializerUtil;


class SerializerContext
{
    private SerializerInterface $serializerTool;

    public function __construct(SerializerInterface $serializerTool)
    {
        $this->serializerTool = $serializerTool;
    }

    public function serialize(object $data, string $format = 'json'): string
    {
        return $this->serializerTool->serialize($data, $format);
    }

    public function deserialize(string $data, string $objectName, string $format = 'json'): object
    {
        return $this->serializerTool->deserialize($data, $objectName, $format);
    }
}