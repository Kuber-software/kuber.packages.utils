<?php


namespace Kubersoftware\SerializerUtil\Strategy;

use DateTime;
use GBProd\UuidNormalizer\UuidDenormalizer;
use GBProd\UuidNormalizer\UuidNormalizer;
use Kubersoftware\SerializerUtil\SerializerStrategy;
use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class SymfonySerializerStrategyImpl implements SerializerStrategy
{
    private Serializer $serializer;

    public function __construct()
    {
        $reflectionExtractor = new ReflectionExtractor();
        $phpDocExtractor = new PhpDocExtractor();
        $encoder = [new JsonEncoder()];
        $extractor = new PropertyInfoExtractor([$reflectionExtractor], [$phpDocExtractor, $reflectionExtractor], [$phpDocExtractor], [$reflectionExtractor], [$reflectionExtractor]);
        $normalizer = array(new UuidNormalizer(), new UuidDenormalizer(), new DateTimeNormalizer(DateTime::ATOM), new ArrayDenormalizer(),
            new ObjectNormalizer(null, null, null, $extractor));
        $this->serializer = new Serializer($normalizer, $encoder);
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