<?php
/**
 * @author Zyankin Dmitry zyankin.dima@gmail.com
 * Date: 6/8/20
 * Time: 2:28 AM
 */
declare(strict_types=1);

namespace App\ArgumentValueResolver;

use App\Exception\ValidationErrorException;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\HttpKernel\Exception\UnsupportedMediaTypeHttpException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class DtoResolver
 * @package App\ArgumentValueResolver
 */
class ArgumentValueResolver implements ArgumentValueResolverInterface
{
    protected ValidatorInterface $validator;
    protected SerializerInterface $serializer;

    /**
     * DtoResolver constructor.
     * @param ValidatorInterface $validator
     * @param SerializerInterface $serializer
     */
    public function __construct(ValidatorInterface $validator, SerializerInterface $serializer)
    {
        $this->validator = $validator;
        $this->serializer = $serializer;
    }

    /**
     * @inheritDoc
     * @param Request $request
     * @param ArgumentMetadata $argument
     * @return bool
     */
    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        return class_exists($argument->getType());
    }

    /**
     * @param Request $request
     * @param ArgumentMetadata $argument
     * @return \Generator|iterable
     */
    public function resolve(Request $request, ArgumentMetadata $argument)
    {
        $contentTypes = $request->getAcceptableContentTypes();
        if ($this->isUnsupportedTypeGiven($contentTypes)) {
            throw new UnsupportedMediaTypeHttpException();
        }

        $argumentObj = $this->serializer->deserialize($request->getContent(), $argument->getType(), 'json');
        $violationsList = $this->validator->validate($argumentObj);

        if (\count($violationsList) > 0) {
            throw new ValidationErrorException($violationsList);
        }

        yield $argumentObj;
    }

    /**
     * @param array $contentTypes
     * @return bool
     */
    private function isUnsupportedTypeGiven(array $contentTypes): bool
    {
        return ! empty($contentTypes) && ! in_array('application/json', $contentTypes, false);
    }
}
