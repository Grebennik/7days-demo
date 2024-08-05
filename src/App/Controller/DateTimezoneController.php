<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Form\DateTimezoneType;
use App\Service\DateTimezoneService;
use Symfony\Component\Routing\Annotation\Route;

class DateTimezoneController extends AbstractController
{
    private $dateTimezoneService;

    public function __construct(DateTimezoneService $dateTimezoneService)
    {
        $this->dateTimezoneService = $dateTimezoneService;
    }

    /**
     * @Route("/datetimezone", name="datetimezone_form")
     * @throws \Exception
     */
    public function index(Request $request): Response
    {
        $form = $this->createForm(DateTimezoneType::class);
        $form->handleRequest($request);

        $result = null;

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $details = $this->dateTimezoneService->calculateDateTimezoneDetails($data['date'], $data['timezone']);

            $result = "The time zone {$details['timezone']} has {$details['offset']} minutes offset to UTC on the given day at noon.<br />";
            $result .= "February in this year is {$details['daysInFebruary']} days long.<br />";
            $result .= "The specified month {$details['monthName']} is {$details['daysInMonth']} days long.";
        }

        return $this->render('datetimezone/index.html.twig', [
            'form' => $form->createView(),
            'result' => $result
        ]);
    }
}