<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\CompetenceCollaborateurType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Collaborateurs;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Projets;
use App\Form\ProjetType;
use App\Repository\CollaborateursRepository;
use App\Repository\ProjetsRepository;
use Doctrine\Persistence\ManagerRegistry;

class AdminController extends AbstractController
{

    public function __construct(private ManagerRegistry $doctrine) {}

    public function someAction() {
        // access Doctrine
        $this->doctrine;
    }

    #[Route('/add_project', name: 'app_add_project')]
    public function addProjects(Request $request, EntityManagerInterface $manager)
    {
        $project = new Projets();

        $form = $this->createForm(ProjetType::class, $project);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $competences = $form->get('competences')->getData();

            if ($competences) {
                $project->setCompetences($competences);
            }
            
            $manager->persist($project);
            $manager->flush();

            return $this->redirectToRoute('app_calendrier_apres');
        }

        return $this->renderForm('admin/ajout_projet.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/add_collaborator', name: 'app_add_collaborator')]
    public function addCollaborateurs(Request $request, EntityManagerInterface $manager)
    {
        $collaborator = new Collaborateurs();

        $form = $this->createForm(CompetenceCollaborateurType::class, $collaborator);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $compet1 = $form->get('competence_principale')->getData();
            $compet2 = $form->get('competence_secondaire')->getData();
            $compet3 = $form->get('competence_terciere')->getData();

            if ($compet1) {
                $collaborator->addCompetence($compet1);
            }

            if ($compet2) {
                $collaborator->addCompetence($compet2);
            }

            if ($compet3) {
                $collaborator->addCompetence($compet3);
            }

            $manager->persist($collaborator);
            $manager->flush();

            return $this->redirectToRoute('app_calendrier_apres');
        }

        return $this->renderForm('admin/ajout_collaborateur.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/display_project', name: 'app_display_project')]
    public function displayProjects(ProjetsRepository $projetsRepository): Response
    {
        $projects = $projetsRepository->findAll();

        return $this->render('admin/supp_projet.html.twig', [
            'projects' => $projects,
        ]);
    }

    #[Route('/delete_projet/{id}', name: 'app_delete_project')]
    public function doDeleteProjects(Projets $projects)
    {
        $em = $this->doctrine->getManager();
        $em->remove($projects);
        $em->flush();

        return $this->redirectToRoute('app_calendrier_apres');
    }

    #[Route('/display_collaborator', name: 'app_display_collaborator')]
    public function displayCollaborators(CollaborateursRepository $collaborateursRepository): Response
    {
        $collaborators = $collaborateursRepository->findAll();

        return $this->render('admin/supp_collaborateur.html.twig', [
            'collaborators' => $collaborators,
        ]);
    }

    #[Route('/delete_collaborateur/{id}', name: 'app_delete_collaborator')]
    public function doDeleteCollaborators(Collaborateurs $collaborators)
    {
        $em = $this->doctrine->getManager();
        $em->remove($collaborators);
        $em->flush();

        return $this->redirectToRoute('app_calendrier_apres');
    }
}
