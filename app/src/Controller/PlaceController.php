<?php

namespace App\Controller;

use App\Dto\QrCode\Request\QrCodeDTO;
use App\Form\PlaceAddRemoveType;
use App\Form\PlacesSearchType;
use App\Form\QrCodeType;
use App\Repository\PlaceRepository;
use App\Service\PlaceService;
use App\Service\QrCodeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PlaceController extends AbstractController
{
    public function __construct(private PlaceService $placeService,
                                private QrCodeService $qrCodeService)
    {
    }

    #[Route('/places', name: 'app_place_index')]
    public function index(Request $request, PlaceRepository $placeRepository): Response
    {
        $placeTitle = null;
        $packageTitle = null;
        $form = $this->createForm(PlacesSearchType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $placeTitle = $form->get('placeTitle')->getData();
            $packageTitle = $form->get('packageTitle')->getData();
        }

        $page = $request->query->get('page') ?? 1;
        $countPages = $placeRepository->countPages($placeTitle, $packageTitle);
        $page = $page <= $countPages ? $page : $countPages;

        $places = $placeRepository->findByPlaceAndPackage($placeTitle, $packageTitle, $page);

        return $this->renderForm('place/index.html.twig', [
            'places' => $places,
            'searchForm' => $form,
            'countPages' => $countPages,
            'page' => $page,

        ]);
    }

    #[Route('/places/{placeId}', name: 'app_place')]
    public function show(int $placeId, Request $request): Response
    {
        $place = $this->placeService->getPlaceById($placeId);
        $placeActionList = $this->placeService->getPlaceActionsById($placeId);

        $form = $this->createForm(PlaceAddRemoveType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            if ($form->get('add')->isClicked()) {
                return $this->redirectToRoute('app_place_add',
                    ['placeId' => $placeId, 'comment' => $form->get('comment')->getData()]);
            }

            if ($form->get('remove')->isClicked()) {
                return $this->redirectToRoute('app_place_remove',
                    ['placeId' => $placeId, 'comment' => $form->get('comment')->getData()]);
            }
        }

        return $this->renderForm('place/show.html.twig', [
            'place' => $place,
            'form' => $form,
            'placeActionList' => $placeActionList,
        ]);
    }


    #[Route('/places/new/{placeId}/{comment}', name: 'app_place_add')]
    public function new(int $placeId, string $comment, Request $request): Response
    {
        $qrCode = new QrCodeDTO();

        $form = $this->createForm(QrCodeType::class, $qrCode);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $qrCode = $form->getData();

            $packageAndPlaceResponse = $this->qrCodeService->getPackageAndPlaceByQrCode($qrCode->getQrCode());

            if($packageAndPlaceResponse->getPackageId() > 0) {
                $this->placeService->addPackageToPlace($placeId, $packageAndPlaceResponse->getPackageId(), $comment);
                $this->addFlash('success', 'Упаковка добавлена');
                return $this->redirectToRoute('app_place', ['placeId' => $placeId]);
            }

            $this->addFlash('danger', 'Упаковка не найдена');
            return $this->redirectToRoute('app_place', ['placeId' => $placeId]);
        }

        return $this->renderForm('qr_code/recognize.html.twig', [
            'form' => $form,
        ]);
    }
    #[Route('/places/delete/{placeId}/{comment}', name: 'app_place_remove')]
    public function delete(int $placeId, string $comment, Request $request): Response
    {
        $qrCode = new QrCodeDTO();

        $form = $this->createForm(QrCodeType::class, $qrCode);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $qrCode = $form->getData();

            $packageAndPlaceResponse = $this->qrCodeService->getPackageAndPlaceByQrCode($qrCode->getQrCode());

            if($packageAndPlaceResponse->getPackageId() > 0) {
                $this->placeService->removePackageFromPlace($placeId, $packageAndPlaceResponse->getPackageId(), $comment);
                $this->addFlash('success', 'Упаковка удалена');
                return $this->redirectToRoute('app_place', ['placeId' => $placeId]);
            }

            $this->addFlash('danger', 'Упаковка не найдена');
            return $this->redirectToRoute('app_place', ['placeId' => $placeId]);
        }

        return $this->renderForm('qr_code/recognize.html.twig', [
            'form' => $form,
        ]);
    }

}
