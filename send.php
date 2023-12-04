<!DOCTYPE html>
<html lang="en">
<head>
    <? require 'head.php' ?>
    <title>Надсилання арабів</title>
</head>
<body>
    <? require 'header.php' ?>
    <? require "aside.php" ?>
    <main>
     <h1>Надсилання арабів</h1>
     <form>
      <label for="c_number">Введіть номер карти особи, яка отримає кошти</label>
      <input type="text" name="c_number" id="c_number">
      <label for="cs_amount">Введіть кількість грошей, які ви бажаєте надіслати</label>
      <input type="text" name="cs_amount" id="cs_amount">
      <label for="comment">Введіть коментар (За бажанням)</label>
      <input type="text" name="comment" id="comment">
      <div class="err" id="err_msg"></div>
      <button type="button" id="send_btn">Надіслати</button>
     </form>
    </main>
    <aside>
    </aside>
    <? require "footer.php" ?>
    <script>
        $('#send_btn').click(function() {
          let c_number = $('#c_number').val();
          let cs_amount = $('#cs_amount').val();
          let comment = $('#comment').val();

          $.ajax({
            url: 'ajax/send.php',
            type:'POST',
            cache: false,
            data: {'c_number': c_number,
                   'cs_amount': cs_amount,
                   'comment': comment
                  },
            dataType: 'html',
            success: function(data) {
                console.log(data);
                if(data === "Done") {
                  $("#send_btn").text("Надіслано!")
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
    </script>
</body>
</html>
<!-- Файл сторінки з передаванням грошей, вводяться дані і з допомогою ajax передаються в ajax/send.php, у випадку чого виводиться помилка -->