<!DOCTYPE html>
<html lang="en">
<head>
    <? require 'head.php' ?>
    <title>Авторизація</title>
</head>
<body>
    <? require 'header.php' ?>
    <main>
      <? if(!isset($_COOKIE['logged'])): ?>
     <h1>Авторизація</h1>
     <form>
      <label for="name_surname">Введіть прізвище та ім'я</label>
      <input type="text" name="name_surname" id="name_surname">
      <label for="password">Введіть ваш пароль</label>
      <input type="password" name="password" id="password">
      <div class="err" id="err_msg"></div>
      <button type="button" id="auth_btn">Авторизуватися</button>
     </form>
     <? else: ?>
     <h1>Ви вже в акаунті, <?=$_COOKIE['logged'] ?></h1>
     <form>
      <button type="button" id="exit">Вийти з акаунта</button>
     </form>
     <? endif ?>
    </main>
    <aside>
    </aside>
    <? require "footer.php" ?>
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
                if(data === "Done") {
                  $("#auth_btn").text("Зареєстровано!")
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