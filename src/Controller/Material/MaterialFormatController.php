<?php

namespace App\Controller\Material;

use App\Entity\Format;
use App\Form\FormatEditType;
use App\Repository\MaterialRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/material/{materialId}/format', name: 'material_format')]
class MaterialFormatController extends AbstractController
{
    public function __construct(
        private ManagerRegistry $doctrine,
        private MaterialRepository $materialRepository,
    ) {}

    #[Route('/create', name: '_create')]
    public function create(int $materialId, Request $request)
    {
        $material = $this->materialRepository->find($materialId);
        $format = new Format($material);
        $form = $this->createForm(FormatEditType::class, $format);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->doctrine->getManager()->persist($format);
            $this->doctrine->getManager()->flush();

            return $this->redirectToRoute('material_view', ['id' => $materialId]);
        }

        return $this->render('material/format_edit.html.twig', [
            'material' => $material,
            'form' => $form->createView(),
        ]);
    }
}
