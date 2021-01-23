<?php


namespace Kubersoftware\SerializerUtil\Strategy;


use JMS\Serializer\Handler\HandlerRegistry;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use Kubersoftware\SerializerUtil\SerializerInterface;
use Mhujer\JmsSerializer\Uuid\UuidSerializerHandler;

class JmsSerializerStrategy implements SerializerInterface
{
    private Serializer $serializer;

    public function __construct()
    {
        $this->serializer = SerializerBuilder::create()->configureHandlers(function (HandlerRegistry $registry) {
            $registry->registerSubscribingHandler(new UuidSerializerHandler());
        })->build();
    }

    public function serialize(object $data, string $format = 'json'): string
    {
        return $this->serializer->serialize($data, $format);
    }

    public function deserialize(string $data, string $objectName, string $format = 'json'): object
    {
        return $this->serializer->deserialize($data, $objectName, $format);
    }

}