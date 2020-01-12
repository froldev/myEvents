<?php
/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

use App\Model\NavbarManager;
use App\Model\PartnersManager;
use App\Model\ProgrammingManager;
use App\Model\CategoriesManager;
use App\Model\SocietyManager;

class HomeController extends AbstractController
{

    /**
     * Display home page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index()
    {
        $societyManager = new SocietyManager();
        $society = $societyManager->showSociety();

        if (empty($society)) {
            return $this->twig->render("Home/firstConnexion.html.twig");
        }

        $society = $societyManager->selectAll();
        $society = $society[0];

        $navbar = new NavbarManager();
        $navs = $navbar->selectNavbar();

        $categories = new CategoriesManager();
        $listCategory = $categories->selectAll();

        $programmingManager = new ProgrammingManager();
        $events = $programmingManager->selectAll();

        $carousel = $programmingManager->carouselView();
        $nbCarousel = count($carousel);

        //search
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $programmingManager = new ProgrammingManager();
            $events = $programmingManager->insertSearch($_POST);

            $categories = new CategoriesManager();
            $listCategory = $categories->selectAll();

            return $this->twig->render('Home/index.html.twig', [
                'society' => $society,
                'navs' => $navs,
                'events' => $events,
                'categories' => $listCategory,
                'carousels' => $carousel,
                'nbCarousels' => $nbCarousel,
                'partners' => $this->getPartners()
            ]);
        }

        return $this->twig->render('Home/index.html.twig', [
            'society' => $society,
            'navs' => $navs,
            'events' => $events,
            'categories' => $listCategory,
            'carousels' => $carousel,
            'nbCarousels' => $nbCarousel,
            'partners' => $this->getPartners()
        ]);
    }
}
