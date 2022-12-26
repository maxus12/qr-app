<?php

namespace App\Controller;

use App\Dto\Package\Request\PackageDTO;
use App\Dto\QrCode\Request\QrCodeDTO;
use App\Form\PackageType;
use App\Form\PlaceType;
use App\Service\PackageService;
use App\Service\PlaceService;
use App\Dto\Place\Request\PlaceDTO;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ElementController extends AbstractController
{
    public function __construct(private PlaceService $placeService,
                                private PackageService $packageService)
    {
    }

    #[Route('/element/{qr}/new', name: 'app_new_element')]
    public function new(string $qr, Request $request): Response
    {
        $qrCode = new QrCodeDTO();
        $qrCode->setQrCode($qr);

        $placeDTO = new PlaceDTO();
        $placeDTO->setQrCodeTitle($qrCode->getQrCode());
        $placeForm = $this->createForm(PlaceType::class, $placeDTO);

        $packageDTO = new PackageDTO();
        $packageDTO->setQrCodeTitle($qrCode->getQrCode());
        $packageForm = $this->createForm(PackageType::class, $packageDTO);

        $placeForm->handleRequest($request);
        if ($placeForm->isSubmitted() && $placeForm->isValid()) {
            $placeDTO = $placeForm->getData();

            return $this->redirectToRoute('app_place', [
                'placeId' => $this->placeService->createPlace($placeDTO)->getId()
            ]);
        }

        $packageForm->handleRequest($request);
        if ($packageForm->isSubmitted() && $packageForm->isValid()) {
            $packageDTO = $packageForm->getData();

            return $this->redirectToRoute('app_package', [
                'packageId' => $this->packageService->createPackage($packageDTO)->getId()
            ]);
        }

        return $this->renderForm('element/new.html.twig', [
            'qrCode' => $qrCode->getQrCode(),
            'placeForm' => $placeForm,
            'packageForm' => $packageForm,
        ]);

    }
}
