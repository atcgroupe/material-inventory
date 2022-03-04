<?php

namespace App\Controller\Reservation;

use App\Entity\Reservation;
use App\Form\ReservationEditType;
use App\Repository\ReservationRepository;
use App\Security\UserRole;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/reservation', name: 'reservation')]
class ReservationController extends AbstractController
{
    public function __construct(
        private ManagerRegistry $doctrine,
        private ReservationRepository $reservationRepository,
    ){}

    #[Route('/', name: '_index')]
    public function index(): Response
    {
        return $this->render('reservation/index.html.twig');
    }

    #[Route('/create', name: '_create')]
    public function create(Request $request): Response
    {
        $reservation = new Reservation($this->getUser());
        $form = $this->createForm(ReservationEditType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->doctrine->getManager()->persist($reservation);
            $this->doctrine->getManager()->flush();

            return $this->redirectToRoute('reservation_index');
        }

        return $this->render('reservation/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/list', name: '_list')]
    public function list(Request $request): Response
    {
        $reservations = $this->reservationRepository->searchByName(
            in_array(UserRole::STORE_KEEPER->value, $this->getUser()->getRoles()),
            $request->query->get('search')
        );

        $data = [];
        foreach ($reservations as $reservation) {
            $data[] = [
                'creationTime' => $reservation->getCreationTimeLabel(),
                'deliveryDate' => $reservation->getDeliveryDateLabel(),
                'jobId' => $reservation->getJobId(),
                'jobCustomer' => $reservation->getJobCustomer(),
                'userIdentifier' => $reservation->getUserIdentifier(),
                'status' => $reservation->getStatusLabel(),
                'route' => $this->generateUrl('reservation_index'),
            ];
        }

        return new JsonResponse($data);
    }
}
