<header>
    <span class="logo">Дворобанк</span>
    <nav> 
    <? if(isset($_COOKIE['logged'])): ?>
        <a href="/login" class="btn">Мій кабінет</a>
        <a href="/send" class="btn">Надіслати кошти</a>
    <? else: ?>
        <a href="/login" class="btn">Увійти</a>
        <a href="/register" class="btn">Зареєструватись</a>
    <? endif; ?>
    <? if ($_COOKIE['logged'] == 'admin'): ?>
        <a href="/admin" class="btn">Панель адміністратора</a>
    <? endif; ?>
        <a href="/" class="btn">🏠</a>
    </nav>
</header>
<!-- Файл, який треба під'єднати щоб відобразилась основна шапка сайту -->