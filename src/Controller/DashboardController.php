<?php

namespace App\Controller;

use App\Model\CategoriesManager;
use App\Model\CommentsManager;
use App\Model\EventsManager;
use App\Model\PartnersManager;
use App\Model\SocietyManager;

class DashboardController extends AbstractController
{
    public function list()
    {

        $this->verifySession();
        $this->verifySociety();

        $eventsManager = new EventsManager();
        $events = count($eventsManager->selectAll());

        $categories = new CategoriesManager();
        $category = count($categories->selectAll());

        $partnersManager = new PartnersManager();
        $partners = count($partnersManager->selectPartner());

        $commentsManager = new CommentsManager();
        $comments = count($commentsManager->selectAnswerIsNull());

        $societyManager = new SocietyManager();
        $society = $societyManager->showSociety();

        return $this->twig->render('Admin/Dashboard/list.html.twig', [
            'events' => $events,
            'categories' => $category,
            'partners' => $partners,
            'comments' => $comments,
            'society' => $society,
        ]);
    }
}
