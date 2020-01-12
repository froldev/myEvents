<?php

namespace App\Model;

class NavbarManager extends AbstractManager
{
    const TABLE = "navbar";

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function selectNavbar(): array
    {
        $request = $this->pdo->query("SELECT * FROM " .self::TABLE. " ORDER BY text");
        return $request->fetchAll();
    }

    public function insertNavbar(array $navbar): bool
    {
        $request = $this->pdo->prepare("INSERT INTO " .self::TABLE. " (text, link) VALUES (:text, :link)");
        $request->bindValue(":text", ucfirst(strtolower($navbar["text"])), \PDO::PARAM_STR);
        $request->bindValue(":link", $navbar["link"], \PDO::PARAM_STR);
        return $request->execute();
    }

    public function deleteNavbar(int $id): void
    {
        $request = $this->pdo->prepare("DELETE FROM " .self::TABLE. " WHERE id=:id");
        $request->bindValue(":id", $id, \PDO::PARAM_INT);
        $request->execute();
    }

    public function updateNavbar(array $navbar):bool
    {
        $request = $this->pdo->prepare("UPDATE " .self::TABLE. " SET text=:text, link=:link WHERE id=:id");
        $request->bindValue(":id", $navbar['id'], \PDO::PARAM_INT);
        $request->bindValue(":text", ucfirst(strtolower($navbar["text"])), \PDO::PARAM_STR);
        $request->bindValue(":link", $navbar["link"], \PDO::PARAM_STR);
        return $request->execute();
    }
}
