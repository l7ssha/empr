<?php

namespace App\Utils\ApiPlatform;

use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

abstract class EmprDataTransformer implements NormalizerInterface, NormalizerAwareInterface
{
    use NormalizerAwareTrait;

    abstract protected function transform(mixed $object): mixed;

    abstract protected function supports(mixed $object, ?string $to): bool;

    public function normalize(mixed $object, string $format = null, array $context = []): float|int|bool|\ArrayObject|array|string|null
    {
        return $this->normalizer->normalize($this->transform($object), $format, $context);
    }

    public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
    {
        return $this->supports($data, $context['output']['class'] ?? null);
    }
}
