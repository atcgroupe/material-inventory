<?php

namespace App\Controller\Material;

use App\Entity\Piece;
use App\Form\PieceEditType;
use App\Repository\MaterialRepository;
use App\Repository\PieceRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/material', name: 'material_piece')]
class MaterialPieceController extends AbstractController
{
    public function __construct(
        private ManagerRegistry $doctrine,
        private PieceRepository $pieceRepository,
    ) {}

    #[Route('/{materialId}/piece/create', name: '_create')]
    public function create(int $materialId, Request $request, MaterialRepository $materialRepository): Response
    {
        $material = $materialRepository->find($materialId);
        $piece = new Piece($material);
        $form = $this->createForm(PieceEditType::class, $piece);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->doctrine->getManager()->persist($piece);
            $this->doctrine->getManager()->flush();

            return $this->redirectToRoute('material_view', ['id' => $materialId]);
        }

        return $this->render('material/piece_edit.html.twig', [
            'material' => $material,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/piece/update/{id}', name: '_update')]
    public function update(int $id, Request $request): Response
    {
        $piece = $this->pieceRepository->findWithRelations($id);
        $form = $this->createForm(PieceEditType::class, $piece);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->doctrine->getManager()->flush();

            return $this->redirectToRoute('material_view', ['id' => $piece->getMaterial()->getId()]);
        }

        return $this->render('material/piece_edit.html.twig', [
            'material' => $piece->getMaterial(),
            'piece' => $piece,
            'form' => $form->createView(),
        ]);
    }
}
