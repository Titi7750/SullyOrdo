<?php

namespace App\Controller;

use App\Repository\CollaborateursRepository;
use App\Repository\ProjetsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function \PHP81_BC\strftime;

class DefaultController extends AbstractController
{

    #[Route('/calendrier_avant', name: 'app_calendrier_avant')]
    public function calendrierAvant(CollaborateursRepository $collaborateursRepository): Response
    {
        $collaborateurs = $collaborateursRepository->findAll();

        return $this->render('vue/calendrier_avant.html.twig', [
            'collaborateurs' => $collaborateurs,
        ]);
    }

    #[Route('/calendrier_apres', name: 'app_calendrier_apres')]
    public function calendrierApres(CollaborateursRepository $collaborateursRepository, ProjetsRepository $projetsRepository)
    {
        $collaborateurs = $collaborateursRepository->findAll();
        $projets = $projetsRepository->findAll();

        return $this->render('vue/calendrier_apres.html.twig', [
            'collaborateurs' => $collaborateurs,
            'projets' => $projets,
        ]);
    }

    #[Route('/calendarBoucle', name: 'app_calendarBoucle')]
    public function boucleDateCalendar(): Response
    {
        setlocale(LC_TIME, 'fr-FR', 'french', 'fra');

        $dateDebut = new \DateTime('2020-01-01');

        for ($dateDebut = 0; $dateDebut <= 365; $dateDebut++) {
            if (date('z') === 364) {
                date('z') + 1;
            } else {
                $date = mktime(0, 0, 0, date('m'), date('d') + $dateDebut, date('Y'));
                $date = strftime('%A %d %B %Y', $date);
                echo $date . '<br>';
            }
        }

        return $this->render('vue/calendarBoucle.html.twig');
    }

    #[Route('/jourferie', name: 'app_jourferie')]
    public function jourFerieDansAnnee(): Response
    {
        setlocale(LC_TIME, 'fr-FR', 'french', 'fra');

        $year = 2022;

        $a = $year % 4;
        $b = $year % 7;
        $c = $year % 19;
        $m = 24;
        $n = 5;
        $d = (19 * $c + $m) % 30;
        $e = (2 * $a + 4 * $b + 6 * $d + $n) % 7;

        $easterdate = 22 + $d + $e;

        if ($easterdate > 31) {
            $day = $d + $e - 9;
            $month = 4;
        } else {
            $day = 22 + $d + $e;
            $month = 3;
        }

        if ($d == 29 && $e == 6) {
            $day = 10;
            $month = 04;
        } elseif ($d == 28 && $e == 6) {
            $day = 18;
            $month = 04;
        }

        echo $day.'/'.$month.'/'.$year;

        return $this->render('vue/jourferie.html.twig');
    }

    #[Route('/jourferie2', name: 'app_jourferie2')]
    public function getHolidays($year = null)
    {
        if ($year === null)
        {
            $year = intval(strftime('%Y'));
        }

        $easterDate = easter_date($year);
        $easterDay = date('j', $easterDate);
        $easterMonth = date('n', $easterDate);
        $easterYear = date('Y', $easterDate);

        $holidays = array(
            mktime(0, 0, 0, 1, 1, $year),
            mktime(0, 0, 0, 5, 1, $year),
            mktime(0, 0, 0, 5, 8, $year),
            mktime(0, 0, 0, 7, 14, $year),
            mktime(0, 0, 0, 8, 15, $year),
            mktime(0, 0, 0, 11, 1, $year),
            mktime(0, 0, 0, 11, 11, $year),
            mktime(0, 0, 0, 12, 25, $year),
            
            mktime(0, 0, 0, $easterMonth, $easterDay + 1, $easterYear),
            mktime(0, 0, 0, $easterMonth, $easterDay + 39, $easterYear),
            mktime(0, 0, 0, $easterMonth, $easterDay + 50, $easterYear),
        );

        sort($holidays);

        return $holidays;
    }
}
