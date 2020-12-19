<?php
/**
 * @author Zyankin Dmitry zyankin.dima@gmail.com
 * Date: 6/8/20
 * Time: 4:06 AM
 */
declare(strict_types=1);

namespace App\Factory;

use Symfony\Component\Validator\ConstraintViolationListInterface;

/**
 * Class ValidationMessageBuilder
 * @package App\Factory
 */
class ValidationMessageFactory
{
    /**
     * @param ConstraintViolationListInterface $violationList
     * @return array
     */
    public function create(ConstraintViolationListInterface $violationList): array
    {
        $violationHash = [];
        foreach ($violationList as $validationError) {
            $violationHash[$validationError->getPropertyPath()]['errors'][] = $validationError->getMessage();
        }

        return $violationHash;
    }
}
