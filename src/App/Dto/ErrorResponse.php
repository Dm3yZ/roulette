<?php
/**
 * @author Zyankin Dmitry zyankin.dima@gmail.com
 * Date: 6/8/20
 * Time: 3:27 AM
 */
declare(strict_types=1);

namespace App\Dto;

/**
 * Class ErrorResponse
 * @package App\Dto
 */
class ErrorResponse
{
    private ?string $message;
    private ?array $description;
    private ?string $trace;
    private ?int $errorCode;

    /**
     * ErrorResponse constructor.
     * @param string|null $message
     * @param array|null $description
     * @param string|null $trace
     * @param int|null $errorCode
     */
    public function __construct(?string $message, ?array $description, ?string $trace, ?int $errorCode)
    {
        $this->message = $message;
        $this->description = $description;
        $this->trace = $trace;
        $this->errorCode = $errorCode;
    }
}
