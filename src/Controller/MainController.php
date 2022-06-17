<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Models\WeatherModel;

#[Route(name: "main_")]

class MainController extends AbstractController
{

    #[Route("/", name:"home")]
    #[Response]
    public function home(): Response
    {
        $modelWeather = new WeatherModel();
        return $this->render('main/index.html.twig', ["weathers" => $modelWeather->getWeatherData()]);
    }

    #[Route("/mountain", name:"mountain")]
    #[Response]
    public function mountain(): Response
    {
       return $this->render('main/mountain.html.twig');
    }

    #[Route("/beach", name:"beach")]
    #[Response]
    public function beach(): Response
    {
       return $this->render('main/beaches.html.twig');
    }

    #[Route("/city/{id}", name:"city_switcher")]
    public function citySwitcher(SessionInterface $session, int $id)
    {
        $city = WeatherModel::getWeatherByCityIndex($id);

        $session->set('city', $city);
      
        return $this->redirectToRoute("main_home");
    }
}
