<header>
    <span class="logo">Дворобанк</span>
    <nav> 
    <? if(isset($_COOKIE['logged'])): ?>
        <a href="/auth.php" class="btn">Мій кабінет</a>
        <a href="/send.php" class="btn">Переказати арабів</a>
    <? else: ?>
        <a href="/auth.php" class="btn">Увійти</a>
        <a href="/reg.php" class="btn">Зареєструватись</a>
    <? endif; ?>
        <a href="/" class="btn">🏠</a>
    </nav>
</header>