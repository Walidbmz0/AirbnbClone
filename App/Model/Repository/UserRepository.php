<?php

namespace App\Model\Repository;

use App\Controllers\AuthController;
use App\Model\user;
use Core\Repository;

class userRepository extends Repository
{
    public function getTableName(): string
    {
        return 'user';
    }

    public function checkAuth(string $email, string $password): ?user
    {
        $q = sprintf(
            'SELECT * FROM `%s` WHERE `email`=:email AND `password`=:password',
            $this->getTableName()
        );

        $stmt = $this->pdo->prepare($q);
        if (!$stmt) return null;

        $stmt->execute(['email' => $email, 'password' => $password]);

        $user_data = $stmt->fetch();

        return empty($user_data) ? null : new user($user_data);
    }

    public function findAll(): ?array
    {
        return $this->readAll(user::class);
    }

    public function findById(int $id): ?user
    {
        return $this->readById(user::class, $id);
    }

    public function updateById(string $email, int $role, int $id): ?user
    {
        $q = sprintf(
            'UPDATE `%s` SET `email`=:email, `role`=:role WHERE id=:id',
            $this->getTableName()
        );

        $stmt = $this->pdo->prepare($q);
        if (!$stmt)
            return null;
        $stmt->execute(['email' => $email, 'role' => $role, 'id' => $id]);
        $user_data = $stmt->fetch();
        return empty($user_data) ? null : new user($user_data);
    }

    public function addNewuser(string $nom, string $prenom, string $email, string $password, int $is_host)
    {
        $q = sprintf(
            'INSERT INTO `%s`(`nom`, `prenom`, `email`,`password`,`is_host`) VALUES (:nom, :prenom, :email, :password, :is_host)',
            $this->getTableName()
        );

        $stmt = $this->pdo->prepare($q);
        if (!$stmt) return null;


        $stmt->execute(['nom' => $nom, 'prenom' => $prenom, 'email' => $email, 'password' => $password, 'is_host' => $is_host]);
    }

    public function deleteuser(int $id)
    {
        $q = sprintf(
            'DELETE FROM `%s` WHERE id=:id',
            $this->getTableName()
        );

        $stmt = $this->pdo->prepare($q);
        if (!$stmt)
            return null;
        $stmt->execute(['id' => $id]);
    }
}
