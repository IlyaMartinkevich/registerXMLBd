$( document ).ready(function() {

    $("#registrationButton").click(function () {
        $("#registration").css("display","block");
        $("#authorization").css("display","none");

    });

    $("#authorizationButton").click(function () {
        $("#registration").css("display","none");
        $("#authorization").css("display","block");
    });


    $("#fromReg").submit(function () {
        $.ajax({
            url: "/php/addUser.php",
            type: "POST",
            data: $("#fromReg").serialize(),
            success: function (data) {
                $("#resmess").html(data);
            },
            error:function () {
                $("#resmess").html("Произошла ошибка");
            }

        });
        event.preventDefault();
    });

    $("#fromAut").submit(function () {
        $.ajax({
            url: "/php/ConfirmUser.php",
            type: "POST",
            data: $("#fromAut").serialize(),
            success: function (data) {
                $("#resmess").html(data);
            },
            error:function () {
                $("#resmess").html("Произошла ошибка");
            }

        });
        event.preventDefault();
    });


    $("#exitForm").submit(function () {
        $.ajax({
            url: "/php/exit.php",
            type: "POST",
            data: $("#exitForm").serialize(),
            success: function (data) {
                $("#resmess").html(data);
            },
            error:function () {
                $("#resmess").html("Произошла ошибка");
            }

        });
        event.preventDefault();
    });
});