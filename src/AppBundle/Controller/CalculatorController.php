<?php

declare(strict_types=1);

namespace AppBundle\Controller;

use AppBundle\Registry\CalculatorRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/automaton/")
 */
class CalculatorController extends Controller
{
    /**
     * @Route(
     *     "{model}/change/{amount}",
     *     requirements={
     *         "model"="mk1|mk2",
     *         "amount"="\d+"
     *     }
     * )
     */
    public function getChange(string $model, int $amount, CalculatorRegistry $registry): JsonResponse
    {
        $calculator = $registry->getCalculatorFor($model);

        if (null === $calculator) {
            throw new NotFoundHttpException();
        }

        $change = $calculator->getChange($amount);

        if (null === $change) {
            throw new HttpException(Response::HTTP_NO_CONTENT);
        }

        return $this->json(
            $change
        );
    }
}
