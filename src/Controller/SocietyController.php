<?php

namespace App\Controller;

use App\Model\SocietyManager;

class SocietyController extends AbstractController
{
    public function list(): string
    {
        $this->verifySession();
        $this->verifySociety();

        $societyManager = new SocietyManager();
        $society = $societyManager->showSociety();

        return $this->twig->render("Admin/Society/list.html.twig", [
            'companies' => $society,
            'connexion' => 'ok',
        ]);
    }

    public function add(): string
    {
        $this->verifySession();

        $nameError = null;
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $isValid = true;
            if (empty($_POST['name']) || !isset($_POST['name'])) {
                $nameError = "Merci de saisir le nom d'une société";
                $isValid = false;
            }

            // if it's ok
            if ($isValid) {
                $societyManager = new SocietyManager();

                if ($societyManager->insertSociety($_POST)) {
                    header("Location:/society/list");
                }
            }
        }
        return $this->twig->render("Admin/Society/add.html.twig", [
            "nameError" => $nameError,
        ]);
    }

    public function delete(int $id): void
    {
        $this->verifySession();
        $this->verifySociety();

        $societyManager = new SocietyManager();
        $societyManager->deleteSociety($id);
        header("Location:/society/add");
    }

    public function edit(int $id): string
    {
        $this->verifySession();
        $this->verifySociety();

        $societyManger = new SocietyManager();
        $society = $societyManger->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $society['name'] = $_POST['name'];
            if ($societyManger->updateCategories($society)) {
                header("Location:/society/list");
            }
        }
        return $this->twig->render('Admin/Society/edit.html.twig', [
            'society' => $society,
            'connexion' => 'ok',
        ]);
    }
}
