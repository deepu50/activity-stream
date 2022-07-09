function validate_register() {
    var formIsValid = true;
    var customer = document.forms["editform"]["firstname"];
    if (customer.value == null || customer.value == "") {
        customer.style.borderColor = "red";
        customer.classList.add("error");
        //  document.getElementById("customer").placeholder = "Required field";
        document.getElementById("firstname_error").innerHTML =
            "*Required field";
        $("#firstname").focus();
        formIsValid = false;
    }
    var lastname = document.forms["editform"]["lastname"];
    if (lastname.value == null || lastname.value == "") {
        lastname.style.borderColor = "red";
        lastname.classList.add("error");
        //  document.getElementById("customer").placeholder = "Required field";
        document.getElementById("lastname_error").innerHTML = "*Required field";
        $("#lastname").focus();
        formIsValid = false;
    }
    var email = document.forms["editform"]["email"];
    if (email.value == null || email.value == "") {
        email.style.borderColor = "red";
        email.classList.add("error");
        document.getElementById("email_error").innerHTML = "*Required field";
        $("#email").focus();
        formIsValid = false;
    }
    var mobile = document.forms["editform"]["phone"];
    if (mobile.value == null || mobile.value == "") {
        mobile.style.borderColor = "red";
        mobile.classList.add("error");
        document.getElementById("phone_error").innerHTML = "*Required field";
        $("#mobile").focus();
        formIsValid = false;
    }
    var phone = document.forms["editform"]["phone"];
    var phone_length = phone.value.length;

    if ((phone.value.length != 0 && phone.value != null) || phone.value != "") {
        var decimal = /^(\s|0|[1-9][0-9]*)$/;

        if (!decimal.test(phone.value)) {
            phone.style.borderColor = "red";

            $("#mobile_no").focus();
            $("#phone_error").html("Invalid phone number.");
            formIsValid = false;
        } else if (phone_length < 7) {
            phone.style.borderColor = "red";

            $("#phone").focus();
            $("#phone_error").html("Invalid phone number.");
            formIsValid = false;
        } else {
            $("#phone_error").html("");
            phone.style.borderColor = "";
            phone.classList.remove("error");
        }
    }
    return formIsValid;
}
$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});
$("#editform").submit(function (e) {
    e.preventDefault();

    if (validate_register()) {
        let firstname = $("#firstname").val();
        let lastname = $("#lastname").val();
        let email = $("#email").val();
        let phone = $("#phone").val();
        let id_val = $("#id_val").val();
        let age = $("#age").val();
        let gender = $("#gender").val();
        let reporting_teacher = $("#reporting_teacher").val();
        console.log("test");

        $.ajax({
            url: "/student_add",
            method: "POST",
            data: {
                firstname: firstname,
                lastname: lastname,
                email: email,
                age: age,
                gender: gender,
                reporting_teacher: reporting_teacher,
                id_val: id_val,

                phone: phone,
            },
            success: function (response) {
                if (response) {
                    swal({
                        title: "Successfully Edited!",
                        text: "Welcome",
                        icon: "success",
                        button: "Ok",
                    }).then((value) => {
                        var base_url = window.location.origin;
                        window.location = base_url + "/dashboard";
                    });
                }
            },
        });
    } else {
    }
});
