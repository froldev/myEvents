<?php

namespace App\Controller;

use App\Model\NavbarManager;

class NavbarController extends AbstractController
{
    public function list()
    {
        $this->verifySession();
        $this->verifySociety();

        $navbarManager = new NavbarManager();
        $navbars = $navbarManager->selectNavbar();

        return $this->twig->render("Admin/Navbar/list.html.twig", [
            "navbars" => $navbars,
        ]);
    }

    public function edit(int $id): string
    {
        $this->verifySession();
        $this->verifySociety();

        $navbarManager = new NavbarManager();
        $navbar = $navbarManager->selectOneById($id);

        $textError = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $isValid = true;
            if (strlen($_POST['text']) > 25) {
                $textError = "Votre texte ne doit pas dépasser 25 caractères";
                $isValid = false;
            }
            if ($isValid) {
                $navbar['text'] = $_POST['text'];
                if ($navbarManager->updateNavbar($navbar)) {
                    header("Location:/navbar/list");
                }
            }
        }
        return $this->twig->render('Admin/Navbar/edit.html.twig', [
            'navbar' => $navbar,
            'textError' => $textError,
        ]);
    }
}
