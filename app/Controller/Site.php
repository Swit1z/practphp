<?php

namespace Controller;

use Model\Post;
use Src\View;
use Src\Request;
use Model\User;
use Src\Auth\Auth;

class Site
{
    public function index(Request $request): string
    {
        $posts = Post::where('id', $request->id)->get();
        return (new View())->render('site.post', ['posts' => $posts]);
    }

    public function hello(): string
    {
        if (!Auth::check()) {
            app()->route->redirect('/login');
        }

        // Передаем данные текущего пользователя в шаблон
        return (new View())->render('site.hello', [
            'message' => 'Добро пожаловать!',
            'user' => Auth::user()
        ]);
    }

    public function signup(Request $request): string
    {
        if ($request->method === 'POST') {
            $data = $request->all();
            // Хешируем пароль перед созданием записи
            if (isset($data['password'])) {
                $data['password'] = md5($data['password']);
            }

            if (User::create($data)) {
                return new View('site.signup', ['message' => 'Вы успешно зарегистрированы']);
            }
        }
        return new View('site.signup');
    }
//    public function login(Request $request): string
//    {
//        if ($request->method === 'GET') return (new View())->render('site.login', ['message' => ['login' => $request->get('login'), 'password' => $request->get('password')]]);
//        var_dump($request);
//        if (Auth::attempt([
//            'login' => $request->get('login'),
//            'password' => $request->get('password')
//        ])) {
//            app()->route->redirect('/');
//        }
//        return (new View())->render('site.login', ['message' => 'Неправильные данные']);
//
//    }

    public function login(Request $request): string
    {
        //Если просто обращение к странице, то отобразить форму
        if ($request->method === 'GET') {
            return new View('site.login');
        }
        //Если удалось аутентифицировать пользователя, то редирект
        if (Auth::attempt($request->all())) {
            app()->route->redirect('/hello');
        }
        //Если аутентификация не удалась, то сообщение об ошибке
        return new View('site.login', ['message' => 'Неправильные логин или пароль']);
    }

    public function logout(): void
    {
        Auth::logout();
        app()->route->redirect('/hello');
    }

}