<h2>Авторизация</h2>
<h3><?= $message ?? ''; ?></h3>
<?php
print_r($message);
?>

<h3><?= app()->auth->user()->name ?? ''; ?></h3>
<?php
if (!app()->auth::check()):
    ?>
    <form method="post" action="/hello">
        <label>Логин <input type="text" name="login"></label>
        <label>Пароль <input type="password" name="password"></label>
        <button type="submit">
            Войти
        </button>
    </form>
<?php endif;

