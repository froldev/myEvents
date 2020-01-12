<?php

namespace App\Controller;

use App\Model\DetailManager;
use App\Model\NavbarManager;
use App\Model\SocietyManager;

class OlympicController extends AbstractController
{
    public function informations()
    {
        $navbar = new NavbarManager();
        $navs = $navbar->selectNavbar();

        $societyManager = new SocietyManager();
        $society = $societyManager->selectAll();
        $society = $society[0];

        return $this->twig->render('Home/informations.html.twig', [
            'partners' => $this->getPartners(),
            'society' => $society,
            'navs' => $navs,
        ]);
    }

    public function contact()
    {
        $navbar = new NavbarManager();
        $navs = $navbar->selectNavbar();

        $societyManager = new SocietyManager();
        $society = $societyManager->selectAll();
        $society = $society[0];

        return $this->twig->render('Home/contact.html.twig', [
            'partners' => $this->getPartners(),
            'society' => $society,
            'navs' => $navs,
        ]);
    }

    public function history()
    {
        $navbar = new NavbarManager();
        $navs = $navbar->selectNavbar();

        $societyManager = new SocietyManager();
        $society = $societyManager->selectAll();
        $society = $society[0];

        return $this->twig->render('Home/history.html.twig', [
            'partners' => $this->getPartners(),
            'society' => $society,
            'navs' => $navs,
        ]);
    }

    public function event(int $id)
    {
        $navbar = new NavbarManager();
        $navs = $navbar->selectNavbar();

        $societyManager = new SocietyManager();
        $society = $societyManager->selectAll();
        $society = $society[0];

        $detailManager = new DetailManager();
        $detail = $detailManager->selectOneByIdJoin($id);

        return $this->twig->render('Home/event.html.twig', [
            'details' => $detail,
            'society' => $society,
            'navs' => $navs,
        ]);
    }
}
