<!DOCTYPE html>
<html lang="uk">
<head>
    <? require 'head.php' ?>
    <title>Реєстрація</title>
</head>
<body>
    <? require 'header.php' ?>
    <main>
     <? if(!isset($_COOKIE['logged'])): ?>
     <form>
      <h1>Реєстрація</h1>
      <p>Після реєстрації будь ласка зайдіть в ваш кабінет, натисніть на відновлення, та слідуйте подальшим інструкціям</p>
      <label for="name_surname">Введіть прізвище та ім'я (Від 3 до 255 символів)</label>
      <input type="text" name="name_surname" id="name_surname">
      <label for="password">Введіть ваш пароль (Від 8 символів)</label>
      <input type="password" name="password" id="password">
      <label for="password_re">Повторіть ваш пароль</label>
      <input type="password" name="password_re" id="password_re">
      <div class="err" id="err_msg"></div>
      <button type="button" id="reg_btn">Зареєструватися</button>
     </form>
     <? else: ?>
     <h1>Ви вже зареєстровані! Поверніться на головну сторінку</h1>
     <? endif ?>
    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $('#reg_btn').click(function() {
          let name_surname = $('#name_surname').val();
          let password = $('#password').val();
          let password_re = $('#password_re').val();

          $.ajax({
            url: 'ajax/register.php',
            type:'POST',
            cache: false,
            data: {'name_surname': name_surname,
                   'password': password,
                   'password_re': password_re
                  },
            dataType: 'html',
            success: function(data) {
                console.log(data);
                if(data === "Done!") {
                  $("#reg_btn").text("Зареєстровано!")
                  $('#err_msg').hide();
                }
                else {
                     $('#err_msg').show();
                     $('#err_msg').text(data);
                }
            }
          });
        });
    </script>
</body>
</html>
<!-- Файл сторінки з реєстрацією, вводяться дані і з допомогою ajax передаються в ajax/register.php, у випадку чого виводиться помилка -->