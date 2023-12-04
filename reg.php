<!DOCTYPE html>
<html lang="en">
<head>
    <? require 'head.php' ?>
    <title>Реєстрація</title>
</head>
<body>
    <? require 'header.php' ?>
    <main>
     <? if(!isset($_COOKIE['logged'])): ?>
     <h1>Реєстрація</h1>
     <form>
      <label for="name_surname">Введіть прізвище та ім'я (Від 3 до 255 символів)</label>
      <input type="text" name="name_surname" id="name_surname">
      <label for="password">Введіть ваш пароль (Від 8 символів)</label>
      <input type="password" name="password" id="password">
      <label for="password_re">Повторіть ваш пароль</label>
      <input type="password" name="password_re" id="password_re">
      <label for="question">Введіть відповідь на секретне питання (Всі великі букви)</label>
      <input type="password" name="question" id="question"> 
      <div class="err" id="err_msg"></div>
      <button type="button" id="reg_btn">Зареєструватися</button>
     </form>
     <? else: ?>
     <h1>Ви вже зареєстровані! Поверніться на головну сторінку</h1>
     <? endif ?>
    </main>
    <aside>
    </aside>
    <? require "footer.php" ?>
    <script>
        $('#reg_btn').click(function() {
          let name_surname = $('#name_surname').val();
          let password = $('#password').val();
          let password_re = $('#password_re').val();
          let question = $('#question').val();

          $.ajax({
            url: 'ajax/register.php',
            type:'POST',
            cache: false,
            data: {'name_surname': name_surname,
                   'password': password,
                   'password_re': password_re,
                   'question': question
                  },
            dataType: 'html',
            success: function(data) {
                console.log(data);
                if(data === "Done") {
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