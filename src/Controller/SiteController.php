<?php

namespace App\Controller;

use App\Model\SocietyManager;

class SiteController extends AbstractController
{
    public function presentation(): string
    {
        $this->verifySession();
        $this->verifySociety();

        $societyManager = new SocietyManager();
        $society = $societyManager->showSociety();

        return $this->twig->render("Admin/Site/list.html.twig", [
            'companies' => $society,
        ]);
    }
}
