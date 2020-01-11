<?php

namespace App\Controller;

use App\Model\DetailManager;

class OlympicController extends AbstractController
{
    public function informations()
    {
        return $this->twig->render('Home/informations.html.twig', [
            'partners' => $this->getPartners(),
        ]);
    }

    public function contact()
    {
        return $this->twig->render('Home/contact.html.twig', [
            'partners' => $this->getPartners(),
        ]);
    }

    public function history()
    {
        return $this->twig->render('Home/history.html.twig', [
            'partners' => $this->getPartners(),
        ]);
    }

    public function event(int $id)
    {
        $detailManager = new DetailManager();
        $detail = $detailManager->selectOneByIdJoin($id);
        return $this->twig->render('Home/event.html.twig', [
            'details' => $detail
        ]);
    }
}
