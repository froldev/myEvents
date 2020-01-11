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
        ]);
    }

    public function add(): string
    {
        $this->verifySession();

        $nameError = $addressError = $cpError = $townError = $logoError = $phoneError = $emailError = null;
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $isValid = true;
            if (empty($_POST['name']) || !isset($_POST['name'])) {
                $nameError = "Merci de saisir le nom d'une société";
                $isValid = false;
            }
            if (empty($_POST['address']) || !isset($_POST['address'])) {
                $addressError = "Merci de saisir une adresse";
                $isValid = false;
            }
            if (empty($_POST['cp']) || !isset($_POST['cp'])) {
                $cpError = "Merci de saisir un code postal";
                $isValid = false;
            }
            if (empty($_POST['town']) || !isset($_POST['town'])) {
                $townError = "Merci de saisir une ville";
                $isValid = false;
            }
            if (empty($_POST['logo']) || !isset($_POST['logo'])) {
                $logoError = "Merci de télécharger un logo";
                $isValid = false;
            }
            if (empty($_POST['phone']) || !isset($_POST['phone'])) {
                $phoneError = "Merci de télécharger un logo";
                $isValid = false;
            }
            if (empty($_POST['email']) || !isset($_POST['email'])) {
                $emailError = "Merci de télécharger un logo";
                $isValid = false;
            }

            // if it's ok
            if ($isValid) {
                $societyManager = new SocietyManager();

                if ($societyManager->insertSociety($_POST)) {
                    header('Location:/society/list');
                }
            }
        }
        return $this->twig->render('Admin/Society/add.html.twig', [
            'nameError'     => $nameError,
            'addressError'  => $addressError,
            'cpError'       => $cpError,
            'townError'     => $townError,
            'logoError'     => $logoError,
            'phoneError'    => $phoneError,
            'emailError'    => $emailError,
        ]);
    }

    public function delete(int $id): void
    {
        $this->verifySession();
        $this->verifySociety();

        $societyManager = new SocietyManager();
        $societyManager->deleteSociety($id);
        header('Location:/society/add');
    }

    public function edit(int $id): string
    {
        $this->verifySession();
        $this->verifySociety();

        $societyManager = new SocietyManager();
        $society = $societyManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $society['name'] = $_POST['name'];
            $society['address'] = $_POST['address'];
            $society['cp'] = $_POST['cp'];
            $society['town'] = $_POST['town'];
            $society['logo'] = $_POST['logo'];
            $society['phone'] = $_POST['phone'];
            $society['email'] = $_POST['email'];
            $society['github'] = $_POST['github'];
            $society['facebook'] = $_POST['facebook'];
            $society['twitter'] = $_POST['twitter'];
            $society['instagram'] = $_POST['instagram'];
            if ($societyManager->updateSociety($society)) {
                header('Location:/society/list');
            }
        }
        return $this->twig->render('Admin/Society/edit.html.twig', [
            'society' => $society,
        ]);
    }
}
