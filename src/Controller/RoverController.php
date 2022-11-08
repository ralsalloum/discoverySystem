<?php

namespace App\Controller;

use App\Exception\InvalidCommandException;
use App\Exception\InvalidDirectionException;
use App\Exception\InvalidSurfaceFinalCoordinateException;
use App\Service\ManageRoverService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/v1/rovercontroller/')]
class RoverController extends AbstractController
{
    private ManageRoverService $manageRoverService;

    /**
     * RoverController constructor.
     */
    public function __construct(ManageRoverService $manageRoverService)
    {
        $this->manageRoverService = $manageRoverService;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    #[Route('managerovers', name: "manageRoversByAdmin", methods: "PUT")]
    public function manageRoversByAdmin(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        try {
            $result = $this->manageRoverService->manageRoversByAdmin($data);

        } catch (InvalidCommandException | InvalidDirectionException | InvalidSurfaceFinalCoordinateException $e) {
            return $this->json(['exception' => $e->getMessage()]);
        }

        return $this->json(['data' => $result], 200);
    }
}
