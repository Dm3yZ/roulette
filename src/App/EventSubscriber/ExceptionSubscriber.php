<?php
/**
 * @author Zyankin Dmitry zyankin.dima@gmail.com
 * Date: 6/7/20
 * Time: 8:45 PM
 */
declare(strict_types=1);

namespace App\EventSubscriber;


use App\Dto\ErrorResponse;
use App\Exception\ValidationErrorException;
use App\Factory\ValidationMessageFactory;
use JMS\Serializer\SerializerInterface;
use Roulette\Module\Common\Exception\RouletteException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Class ExceptionListener
 * @package App\App\EventSubscriber
 */
class ExceptionSubscriber implements EventSubscriberInterface
{
    private string $env;
    private SerializerInterface $serializer;
    private ValidationMessageFactory $validationMessageFactory;

    /**
     * ExceptionSubscriber constructor.
     * @param string $env
     * @param SerializerInterface $serializer
     * @param ValidationMessageFactory $validationMessageFactory
     */
    public function __construct(string $env, SerializerInterface $serializer, ValidationMessageFactory $validationMessageFactory)
    {
        $this->env = $env;
        $this->serializer = $serializer;
        $this->validationMessageFactory = $validationMessageFactory;
    }

    /**
     * @inheritDoc
     *
     * @return array
     */
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::EXCEPTION => 'onKernelException',
        ];
    }

    /**
     * @param ExceptionEvent $event
     */
    public function onKernelException(ExceptionEvent $event): void
    {
        $event->allowCustomResponseCode();
        $throwable = $event->getThrowable();

        $message = $throwable->getMessage();
        $description = null;
        $trace = null;
        $errorCode = null;

        switch (true) {
            case $throwable instanceof ValidationErrorException:
                $statusCode = $throwable->getStatusCode();
                $description = $this->validationMessageFactory->create($throwable->getViolationList());
                break;
            case $throwable instanceof HttpExceptionInterface:
                $statusCode = $throwable->getStatusCode();
                break;
            case $throwable instanceof RouletteException:
                $statusCode = $throwable->getStatusCode();
                $errorCode = $throwable->getErrorCode();
                break;
            default:
                $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
                $message = $this->env !== 'prod' ? $message : null;
                $trace = $this->env !== 'prod' ? $throwable->getTraceAsString() : null;
        }

        $errorResponse = new ErrorResponse($message, $description, $trace, $errorCode);
        $responseContent = $this->serializer->serialize($errorResponse, 'json');
        $response = JsonResponse::fromJsonString($responseContent, $statusCode);

        $event->setResponse($response);
    }
}
