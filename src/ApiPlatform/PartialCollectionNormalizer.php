<?php

declare(strict_types=1);

namespace App\ApiPlatform;

use ApiPlatform\State\Pagination\PaginatorInterface;
use ApiPlatform\State\Pagination\PartialPaginatorInterface;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\CacheableSupportsMethodInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class PartialCollectionNormalizer implements NormalizerInterface, NormalizerAwareInterface, CacheableSupportsMethodInterface
{
    use NormalizerAwareTrait;

    public const FORMAT = 'json';

    /**
     * @param array<string, mixed> $context
     */
    public function supportsNormalization($data, $format = null, array $context = []): bool
    {
        return self::FORMAT === $format && $data instanceof PartialPaginatorInterface && !$data instanceof PaginatorInterface;
    }

    /**
     * @param PaginatorInterface<object> $object
     *
     * @return array<string, mixed>
     *
     * @throws ExceptionInterface
     */
    public function normalize($object, $format = null, array $context = []): array
    {
        $data = [];
        foreach ($object as $index => $obj) {
            $data[$index] = $this->normalizer->normalize($obj, $format, $context);
        }

        return (array) new PartialPaginatedCollection($data, $object);
    }

    public function hasCacheableSupportsMethod(): bool
    {
        return true;
    }
}
