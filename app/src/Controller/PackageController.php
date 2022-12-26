<?php

namespace App\Controller;

use App\Form\PackageChangeItemCountType;
use App\Service\PackageService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PackageController extends AbstractController
{
    public function __construct(private PackageService $packageService)
    {
    }

    #[Route('/package/edit{packageId}', name: 'app_package')]
    public function edit(int $packageId, Request $request): Response
    {
        $package = $this->packageService->getPackageById($packageId);
        $packageActionList = $this->packageService->getPackageActionsById($packageId);

        $form = $this->createForm(PackageChangeItemCountType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            if ($form->get('add')->isClicked()) {
                $this->packageService->addToPackage(
                    $packageId,
                    $form->get('quantity')->getData(),
                    $form->get('comment')->getData()
                );
                $this->addFlash('success', 'Добавлено '. $form->get('quantity')->getData() .' шт.');
            }
            if ($form->get('remove')->isClicked()) {
                $this->packageService->removeFromPackage(
                    $packageId,
                    $form->get('quantity')->getData(),
                    $form->get('comment')->getData()
                );
                $this->addFlash('success', 'Удалено '. $form->get('quantity')->getData() .' шт.');
            }
            return $this->redirectToRoute($request->attributes->get('_route'), ['packageId' => $packageId]);
        }

        return $this->renderForm('package/edit.html.twig', [
            'package' => $package,
            'form' => $form,
            'packageActionList' => $packageActionList,
        ]);

    }
}
