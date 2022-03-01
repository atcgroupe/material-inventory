<?php

namespace App\Controller\Material;

use App\Entity\Material;
use App\Form\MaterialEditType;
use App\Repository\MaterialRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/librairie', name: 'material')]
class MaterialController extends AbstractController
{
    public function __construct(
        private ManagerRegistry $doctrine,
        private MaterialRepository $materialRepository,
    ) {}

    #[Route('/', name: '_index')]
    public function index(): Response
    {
        return $this->render('material/index.html.twig', [
            'materials' => $this->materialRepository->findBy(['isActive' => true]),
        ]);
    }

    #[Route('/list', name: '_list')]
    public function list(Request $request): JsonResponse
    {
        $materials = $this->materialRepository->findByName($request->query->get('search'));

        $data = [];
        foreach ($materials as $material) {
            $data[$material->getId()] = [
                'name' => $material->getName(),
                'route' => $this->generateUrl('material_view', ['id' => $material->getId()]),
            ];
        }

        return new JsonResponse($data);
    }

    #[Route('/create', name: '_create')]
    public function create(Request $request): Response
    {
        $material = new Material();
        $form = $this->createForm(MaterialEditType::class, $material);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->doctrine->getManager()->persist($material);
            $this->doctrine->getManager()->flush();

            return $this->redirectToRoute('material_index');
        }

        return $this->render('material/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/update/{id}', name: '_update')]
    public function update(int $id, Request $request): Response
    {
        $material = $this->materialRepository->find($id);
        $form = $this->createForm(MaterialEditType::class, $material);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->doctrine->getManager()->flush();

            return $this->redirectToRoute('material_view', ['id' => $material->getId()]);
        }

        return $this->render('material/edit.html.twig', [
            'form' => $form->createView(),
            'material' => $material,
        ]);
    }

    #[Route('/view/{id}', name: '_view')]
    public function view(int $id): Response
    {
        return $this->render('material/view.html.twig', [
            'material' => $this->materialRepository->findWithRelations($id),
        ]);
    }

    #[Route('/delete/{id}', name: '_delete')]
    public function delete(int $id, Request $request): Response
    {
        $material = $this->materialRepository->find($id);
        $token = $request->request->get('_csrf_token');
        $isTokenValid = $this->isCsrfTokenValid('delete_material', $token);

        if ($request->isMethod('POST') && $isTokenValid) {

            $this->doctrine->getManager()->remove($material);
            $this->doctrine->getManager()->flush();

            return $this->redirectToRoute('material_index');
        }

        return $this->render('material/delete.html.twig', [
            'material' => $material,
            'isTokenValid' => $isTokenValid,
        ]);
    }
}
