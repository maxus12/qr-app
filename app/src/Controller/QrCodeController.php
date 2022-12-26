<?php

namespace App\Controller;

use App\Dto\QrCode\Request\QrCodeDTO;
use App\Form\QrCodeType;
use App\Service\QrCodeService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Model\PackageAndPlaceResponse;

class QrCodeController extends AbstractController
{
    public function __construct(private QrCodeService $qrCodeService)
    {
    }

    #[Route('/', name: 'app_home')]
    #[Route('/qr/code', name: 'app_qr_code')]
    public function recognize(Request $request): Response
    {
        $qrCode = new QrCodeDTO();

        $form = $this->createForm(QrCodeType::class, $qrCode);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $qrCode = $form->getData();

            $packageAndPlaceResponse = $this->qrCodeService->getPackageAndPlaceByQrCode($qrCode->getQrCode());

            if($packageAndPlaceResponse->getPlaceId() > 0) {
                return $this->redirectToRoute('app_place', ['placeId' => $packageAndPlaceResponse->getPlaceId()]);
            }

            if($packageAndPlaceResponse->getPackageId() > 0) {
                return $this->redirectToRoute('app_package', ['packageId' => $packageAndPlaceResponse->getPackageId()]);
            }

            return $this->redirectToRoute('app_new_element', ['qr' => $qrCode->getQrCode()]);
        }

        return $this->renderForm('qr_code/recognize.html.twig', [
            'form' => $form,
        ]);
    }


}
