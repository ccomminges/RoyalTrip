<?php

namespace App\Controller\Admin;

use App\Entity\Client;
use App\Entity\Commande;
use App\Entity\Conseiller;
use App\Entity\Destination;
use App\Entity\DetailCommande;
use App\Entity\Dossier;
use App\Entity\Formule;
use App\Entity\Hebergement;
use App\Entity\Participants;
use App\Entity\Voiture;
use App\Entity\Voyage;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
// redirect to some CRUD controller
        $routeBuilder = $this->get(AdminUrlGenerator::class);

        return $this->redirect($routeBuilder->setController(VoyageCrudController::class)->generateUrl());    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('RoyalTrip');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
         yield MenuItem::linkToCrud('Clients', 'fas fa-user', Client::class);
         yield MenuItem::linkToCrud('Participants', 'fas fa-user-friends', Participants::class);
         yield MenuItem::linkToCrud('Commandes', 'fas fa-shopping-cart', Commande::class);
         yield MenuItem::linkToCrud('Détails Commandes', 'fas fa-shopping-basket', DetailCommande::class);
         yield MenuItem::linkToCrud('Dossiers', 'fas fa-folder-open', Dossier::class);
         yield MenuItem::linkToCrud('Conseillers', 'fas fa-user-shield', Conseiller::class);
         yield MenuItem::linkToCrud('Voyages', 'fas fa-suitcase-rolling', Voyage::class);
         yield MenuItem::linkToCrud('Hebergements', 'fas fa-hotel', Hebergement::class);
         yield MenuItem::linkToCrud('Destinations', 'fas fa-map-marker-alt', Destination::class);
         yield MenuItem::linkToCrud('Formules', 'fas fa-bars', Formule::class);
         yield MenuItem::linkToCrud('Voitures', 'fas fa-car', Voiture::class);
    }
}
