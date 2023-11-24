<script>
    $('#myform').submit(function () {

        var name = $('#name').val();
        var age = $('#age').val();
        var message = $('#message').val();


        $.ajax({
            type: "POST",
            url: "your_page_with_php_script.php",
            data: "name=" + name + "&age=" + age + "&message=" + message,
        }).done(function (msg) {
            alert("Data Saved: " + msg);
        });

    });
</script>