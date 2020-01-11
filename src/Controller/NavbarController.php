<?php

namespace App\Controller;

class NavbarController extends AbstractController
{
    public function list()
    {
        $this->verifySession();
        $this->verifySociety();
    }

    public function add(): string
    {
        $this->verifySession();
        $this->verifySociety();
    }

    public function delete(int $id): void
    {
        $this->verifySession();
        $this->verifySociety();
    }

    public function edit(int $id): string
    {
        $this->verifySession();
        $this->verifySociety();
    }
}
