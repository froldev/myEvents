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

        $navbarManagaer = new NavbarManager();
        $navbar = $navbarManagaer->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $navbar['text'] = $_POST['text'];
            $navbar['list'] = $_POST['list'];
            if ($navbarManagaer->updateNavbar($navbar)) {
                header("Location:/navbar/list");
            }
        }
        return $this->twig->render('Admin/Navbar/edit.html.twig', [
            'navbar' => $navbar,
        ]);
    }
}
