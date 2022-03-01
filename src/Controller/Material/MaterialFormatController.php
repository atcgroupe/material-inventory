<?php

namespace App\Controller\Material;

use App\Entity\Format;
use App\Form\FormatEditType;
use App\Repository\FormatRepository;
use App\Repository\MaterialRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/material', name: 'material_format')]
class MaterialFormatController extends AbstractController
{
    public function __construct(
        private ManagerRegistry $doctrine,
        private MaterialRepository $materialRepository,
        private FormatRepository $formatRepository,
    ) {}

    #[Route('/{materialId}/format/create', name: '_create')]
    public function create(int $materialId, Request $request): Response
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

    #[Route('/format/update/{id}', name: '_update')]
    public function update(int $id, Request $request): Response
    {
        $format = $this->formatRepository->findOneWithRelations($id);
        $form = $this->createForm(FormatEditType::class, $format);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->doctrine->getManager()->flush();

            return $this->redirectToRoute('material_view', ['id' => $format->getMaterial()->getId()]);
        }

        return $this->render('material/format_edit.html.twig', [
            'material' => $format->getMaterial(),
            'format' => $format,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/format/delete/{id}', name: '_delete')]
    public function delete(int $id, Request $request): Response
    {
        $format = $this->formatRepository->findOneWithRelations($id);
        $token = $request->request->get('_csrf_token');
        $isTokenValid = $this->isCsrfTokenValid('delete_format', $token);

        if ($request->isMethod('POST') && $isTokenValid) {
            $this->doctrine->getManager()->remove($format);
            $this->doctrine->getManager()->flush();

            return $this->redirectToRoute('material_view', ['id' => $format->getMaterial()->getId()]);
        }

        return $this->render('material/format_delete.html.twig', [
            'format' => $format,
        ]);
    }
}
