<?php

namespace App\Model;

class SocietyManager extends AbstractManager
{
    const TABLE = "society";

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function showSociety(): array
    {
        $request = $this->pdo->query("SELECT * FROM " .self::TABLE);
        return $request->fetchAll();
    }

    public function insertSociety(array $society): bool
    {
        $request = $this->pdo->prepare("INSERT INTO " .self::TABLE. " 
        (name, address, cp, town, logo, phone, email, github, facebook, twitter, instagram) VALUES 
        (:name, :address, :cp, :town, :logo, :phone, :email, :github, :facebook, :twitter, :instagram)");
        $request->bindValue(":name", ucfirst(strtolower($society["name"])), \PDO::PARAM_STR);
        $request->bindValue(":address", $society["address"], \PDO::PARAM_STR);
        $request->bindValue(":cp", $society["cp"], \PDO::PARAM_STR);
        $request->bindValue(":town", $society["town"], \PDO::PARAM_STR);
        $request->bindValue(":logo", $society["logo"], \PDO::PARAM_STR);
        $request->bindValue(":phone", $society["phone"], \PDO::PARAM_STR);
        $request->bindValue(":email", $society["email"], \PDO::PARAM_STR);
        $request->bindValue(":github", $society["github"], \PDO::PARAM_STR);
        $request->bindValue(":facebook", $society["facebook"], \PDO::PARAM_STR);
        $request->bindValue(":twitter", $society["twitter"], \PDO::PARAM_STR);
        $request->bindValue(":instagram", $society["instagram"], \PDO::PARAM_STR);
        return $request->execute();
    }

    public function deleteSociety(int $id): void
    {
        $request = $this->pdo->prepare("DELETE FROM " .self::TABLE. " WHERE id=:id");
        $request->bindValue(":id", $id, \PDO::PARAM_INT);
        $request->execute();
    }

    public function updateSociety(array $society):bool
    {
        $request = $this->pdo->prepare("UPDATE " .self::TABLE. " SET 
        name=:name, address=:address, cp=:cp, town=:town, logo=:logo, phone=:phone, email=:email, 
        github=:github, facebook=:facebook, twitter=:twitter, instagram=:instagram 
        WHERE id=:id");
        $request->bindValue(":id", $society['id'], \PDO::PARAM_INT);
        $request->bindValue(":name", ucfirst(strtolower($society["name"])), \PDO::PARAM_STR);
        $request->bindValue(":address", $society["address"], \PDO::PARAM_STR);
        $request->bindValue(":cp", $society["cp"], \PDO::PARAM_STR);
        $request->bindValue(":town", $society["town"], \PDO::PARAM_STR);
        $request->bindValue(":logo", $society["logo"], \PDO::PARAM_STR);
        $request->bindValue(":phone", $society["phone"], \PDO::PARAM_STR);
        $request->bindValue(":email", $society["email"], \PDO::PARAM_STR);
        $request->bindValue(":github", $society["github"], \PDO::PARAM_STR);
        $request->bindValue(":facebook", $society["facebook"], \PDO::PARAM_STR);
        $request->bindValue(":twitter", $society["twitter"], \PDO::PARAM_STR);
        $request->bindValue(":instagram", $society["instagram"], \PDO::PARAM_STR);
        return $request->execute();
    }

}
