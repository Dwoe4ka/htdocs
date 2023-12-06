<!DOCTYPE html>
<html lang="uk">
<head>
    <? require 'head.php' ?>
    <title>Авторизація</title>
</head>
<body>
    <? require 'header.php' ?>
    <main>
      <? if(!isset($_COOKIE['logged'])): ?>
     <form>
      <h1>Авторизація</h1>
      <label for="name_surname">Введіть прізвище та ім'я</label>
      <input type="text" name="name_surname" id="name_surname">
      <label for="password">Введіть ваш пароль</label>
      <input type="password" name="password" id="password">
      <div class="err" id="err_msg"></div>
      <button type="button" id="auth_btn">Авторизуватися</button>
      <a href="/recovery" id="recovery">Забули пароль?</a> 
     </form>
     <? else: ?>
     <form>
      <h1> Мій кабінет </h1>
      <button type="button" id="exit">Вийти з акаунта</button>
      <h1> Зміна пароля: </h1>
      <label for="old_pass">Введіть старий пароль</label>
      <input type="password" name="old_pass" id="old_pass">
      <label for="new_pass">Введіть новий пароль (Від 8 символів)</label>
      <input type="password" name="new_pass" id="new_pass">
      <label for="new_pass_re">Повторіть новий пароль</label>
      <input type="password" name="new_pass_re" id="new_pass_re">
      <div class="err" id="err_msg"></div>
      <button type="button" id="passc_btn">Змінити пароль</button>
      <a href="/recovery" id="recovery">Відновлення</a>
     </form>
     <? endif ?>
    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $('#auth_btn').click(function() {
          let name_surname = $('#name_surname').val();
          let password = $('#password').val();

          $.ajax({
            url: 'ajax/login.php',
            type:'POST',
            cache: false,
            data: {'name_surname': name_surname,
                   'password': password
                  },
            dataType: 'html',
            success: function(data) {
                console.log(data);
                if(data === "Done!") {
                  $("#auth_btn").text("Авторизовано!")
                  $('#err_msg').hide();
                  document.location.reload(true);
                }
                else {
                     $('#err_msg').show();
                     $('#err_msg').text(data);
                }
            }
          });
        });

        $('#passc_btn').click(function() {
          let old_pass = $('#old_pass').val();
          let new_pass = $('#new_pass').val();
          let new_pass_re = $('#new_pass_re').val();

          $.ajax({
            url: 'ajax/pass_change.php',
            type:'POST',
            cache: false,
            data: {'old_pass': old_pass,
                   'new_pass': new_pass,
                   'new_pass_re': new_pass_re
                  },
            dataType: 'html',
            success: function(data) {
                console.log(data);
                if(data === "Done!") {
                  $("#passc_btn").text("Пароль змінено!")
                  $('#err_msg').hide();
                }
                else {
                     $('#err_msg').show();
                     $('#err_msg').text(data);
                }
            }
          });
        });

        $('#exit').click(function() {
          $.ajax({
            url: 'ajax/exit.php',
            type:'POST',
            cache: false,
            data: {},
            dataType: 'html',
            success: function(data) {
              document.location.reload(true);
            }
          });
        });
    </script>
</body>
</html>
<!-- Файл сторінки з авторизацією, вводяться дані і з допомогою ajax передаються в ajax/login.php, у випадку чого виводиться помилка -->