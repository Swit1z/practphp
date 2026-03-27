<?php

namespace Src\Auth;

use Model\User;
use Src\Session;

class Auth
{
    //Свойство для хранения любого класса, реализующего интерфейс IdentityInterface
    private static IdentityInterface $user;

    //Инициализация класса пользователя
    public static function init(IdentityInterface $user): void
    {

        self::$user = $user;
    }

    //Вход пользователя по модели
    public static function login(IdentityInterface $user): void
    {
        self::$user = $user;
        Session::set('id', self::$user->getId());
    }

    //Аутентификация пользователя и вход по учетным данным
    public static function attempt(array $credentials): bool
    {
        // Находим пользователя по логину
        $user = User::where('login', $credentials['login'])->first();

        // Сравниваем MD5 от введенного пароля с тем, что в базе
        if ($user && md5($credentials['password']) === $user->password) {
            self::login($user);
            return true;
        }
        return false;
    }

    //Возврат текущего аутентифицированного пользователя
    public static function user()
    {

        $id = Session::get('id');
        if (!$id) {
            return null;
        }

        return self::$user->findIdentity((int)$id);
    }

    //Проверка является ли текущий пользователь аутентифицированным
    public static function check(): bool
    {
        if (self::user()) {
            return true;
        }
        return false;
    }

    //Выход текущего пользователя
    public static function logout(): bool
    {
        Session::clear('id');
        return true;
    }

}