<?php
/**
 * @author Zyankin Dmitry zyankin.dima@gmail.com
 * Date: 6/8/20
 * Time: 3:48 AM
 */
declare(strict_types=1);

namespace App\Exception;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Validator\ConstraintViolationListInterface;

/**
 * Class ValidationErrorException
 * @package App\Exception
 */
class ValidationErrorException extends BadRequestHttpException
{
    /**
     * @var ConstraintViolationListInterface
     */
    private ConstraintViolationListInterface $violationList;

    /**
     * ValidationErrorException constructor.
     * @param ConstraintViolationListInterface $violationList
     * @param string|null $message
     * @param \Throwable|null $previous
     * @param int $code
     * @param array $headers
     */
    public function __construct(
        ConstraintViolationListInterface $violationList,
        string $message = 'Wrong request given',
        \Throwable $previous = null,
        int $code = 0,
        array $headers = []
    ) {
        $this->violationList = $violationList;
        parent::__construct( $message, $previous, $code, $headers);
    }

    /**
     * @return ConstraintViolationListInterface
     */
    public function getViolationList(): ConstraintViolationListInterface
    {
        return $this->violationList;
    }
}
