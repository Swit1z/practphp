<h2>Авторизация</h2>
<h3><?= $message ?? ''; ?></h3>

<h3><?= app()->auth->user()->name ?? ''; ?></h3>
<?php
if (!app()->auth::check()):
    ?>
    <p>Вы вошли как: <strong><?= $user->name ?></strong></p>
<?php endif; ?>

<hr>


<a href="/logout" >
    Выйти из аккаунта
</a>