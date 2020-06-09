<?php
/**
 * @author Zyankin Dmitry zyankin.dima@gmail.com
 * Date: 6/8/20
 * Time: 4:27 AM
 */
declare(strict_types=1);

namespace App\EventSubscriber;

use JMS\Serializer\SerializerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Class ResponseListener
 * @package App\EventSubscriber
 */
class ViewSubscriber implements EventSubscriberInterface
{
    public SerializerInterface $serializer;

    /**
     * ViewSubscriber constructor.
     * @param SerializerInterface $serializer
     */
    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::VIEW => 'onKernelView',
        ];
    }

    /**
     * @param ViewEvent $event
     */
    public function onKernelView(ViewEvent $event): void
    {
        $result = $event->getControllerResult();
        $statusCode = Response::HTTP_OK;
        if (null  === $result) {
            $statusCode = Response::HTTP_NO_CONTENT;
        }

        $responseContent = $this->serializer->serialize($result, 'json');
        $response = JsonResponse::fromJsonString($responseContent, $statusCode);

        $event->setResponse($response);
    }
}
