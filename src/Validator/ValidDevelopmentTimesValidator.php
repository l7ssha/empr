<?php

declare(strict_types=1);

namespace App\Validator;

use App\Dto\Development\DevelopmentKit\DevelopmentKitCreateDto;
use App\Dto\Development\DevelopmentKit\DevelopmentTimesDto;
use App\Enum\DevelopmentType;
use RuntimeException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ValidDevelopmentTimesValidator extends ConstraintValidator
{
    /**
     * @param DevelopmentKitCreateDto $value
     */
    public function validate(mixed $value, Constraint $constraint): void
    {
        if (!$constraint instanceof ValidDevelopmentTimes) {
            return;
        }

        if (!$value instanceof DevelopmentKitCreateDto) {
            throw new RuntimeException(); // TODO: Message
        }

        $valid = match ($value->type) {
            DevelopmentType::BW_NEGATIVE => $this->validateBwNegative($value->developmentTimes),
            DevelopmentType::BW_POSITIVE => $this->validateBwPositive($value->developmentTimes),
            DevelopmentType::COLOR_NEGATIVE_3STEP => $this->validateColorNegative3step($value->developmentTimes),
            DevelopmentType::COLOR_NEGATIVE_2STEP => $this->validateColorNegative2step($value->developmentTimes),
            DevelopmentType::COLOR_POSITIVE_3STEP => $this->validateColorPositive3step($value->developmentTimes),
            DevelopmentType::COLOR_POSITIVE_6STEP => $this->validateColorPositive6step($value->developmentTimes),
        };

        if (!$valid) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ type }}', $value->type->value)
                ->addViolation()
            ;
        }
    }

    // TODO: probably there is a better way of doing this
    private function validateBwNegative(DevelopmentTimesDto $developmentTimes): bool
    {
        return
            $developmentTimes->firstDeveloperTime !== null
            && $developmentTimes->firstDeveloperMultiplier !== null
            && $developmentTimes->fixerTime !== null
            && $developmentTimes->fixerMultiplier !== null;
    }

    private function validateBwPositive(DevelopmentTimesDto $developmentTimes): bool
    {
        return
            $this->validateBwNegative($developmentTimes)
            && $developmentTimes->bleachTime !== null
            && $developmentTimes->bleachMultiplier !== null
            && $developmentTimes->clearingTime !== null
            && $developmentTimes->clearingMultiplier !== null
            && $developmentTimes->reversalTime !== null
            && $developmentTimes->reversalMultiplier !== null
            && $developmentTimes->secondDeveloperTime !== null
            && $developmentTimes->secondDeveloperMultiplier !== null;
    }

    private function validateColorNegative3step(DevelopmentTimesDto $developmentTimes): bool
    {
        return $developmentTimes->colorDeveloperTime !== null
            && $developmentTimes->colorDeveloperMultiplier != null
            && $developmentTimes->bleachTime !== null
            && $developmentTimes->bleachMultiplier !== null
            && $developmentTimes->fixerTime !== null
            && $developmentTimes->fixerMultiplier !== null;
    }

    private function validateColorNegative2step(DevelopmentTimesDto $developmentTimes): bool
    {
        return $developmentTimes->colorDeveloperTime !== null
            && $developmentTimes->colorDeveloperMultiplier != null
            && $developmentTimes->blixTime !== null
            && $developmentTimes->blixMultiplier !== null;
    }

    private function validateColorPositive6step(DevelopmentTimesDto $developmentTimes): bool
    {
        return $this->validateColorNegative3step($developmentTimes)
            && $developmentTimes->firstDeveloperTime !== null
            && $developmentTimes->firstDeveloperMultiplier !== null
            && $developmentTimes->reversalTime !== null
            && $developmentTimes->reversalMultiplier !== null
            && $developmentTimes->preBleachTime !== null
            && $developmentTimes->preBleachMultiplier !== null;
    }

    private function validateColorPositive3step(DevelopmentTimesDto $developmentTimes): bool
    {
        return $this->validateColorNegative2step($developmentTimes)
            && $developmentTimes->firstDeveloperTime !== null
            && $developmentTimes->firstDeveloperMultiplier !== null;
    }
}
