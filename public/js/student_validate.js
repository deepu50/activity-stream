function validate_register() {
    var formIsValid = true;
    var customer = document.forms["studentform"]["firstname"];
    if (customer.value == null || customer.value == "") {
        customer.style.borderColor = "red";
        customer.classList.add("error");
        //  document.getElementById("customer").placeholder = "Required field";
        document.getElementById("firstname_error").innerHTML =
            "*Required field";
        $("#firstname").focus();
        formIsValid = false;
    }
    var lastname = document.forms["studentform"]["lastname"];
    if (lastname.value == null || lastname.value == "") {
        lastname.style.borderColor = "red";
        lastname.classList.add("error");
        //  document.getElementById("customer").placeholder = "Required field";
        document.getElementById("lastname_error").innerHTML = "*Required field";
        $("#lastname").focus();
        formIsValid = false;
    }
    var email = document.forms["studentform"]["email"];
    if (email.value == null || email.value == "") {
        email.style.borderColor = "red";
        email.classList.add("error");
        document.getElementById("email_error").innerHTML = "*Required field";
        $("#email").focus();
        formIsValid = false;
    }
    var mobile = document.forms["studentform"]["phone"];
    if (mobile.value == null || mobile.value == "") {
        mobile.style.borderColor = "red";
        mobile.classList.add("error");
        document.getElementById("phone_error").innerHTML = "*Required field";
        $("#mobile").focus();
        formIsValid = false;
    }
    var phone = document.forms["studentform"]["phone"];
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
    var age = document.forms["studentform"]["age"];
    if (age.value == null || age.value == "") {
        age.style.borderColor = "red";
        age.classList.add("error");
        document.getElementById("age_error").innerHTML = "*Required field";
        $("#age").focus();
        formIsValid = false;
    }
    var gender = document.forms["studentform"]["gender"];
    if (gender.value == null || gender.value == "") {
        gender.style.borderColor = "red";
        gender.classList.add("error");
        document.getElementById("gender_error").innerHTML = "*Required field";
        $("#gender").focus();
        formIsValid = false;
    }
    var reporting_teacher = document.forms["studentform"]["reporting_teacher"];
    if (reporting_teacher.value == null || reporting_teacher.value == "") {
        reporting_teacher.style.borderColor = "red";
        reporting_teacher.classList.add("error");
        document.getElementById("reporting_teacher_error").innerHTML =
            "*Required field";
        $("#reporting_teacher").focus();
        formIsValid = false;
    }
    return formIsValid;
}
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$("#studentform").submit(function (e) {
    e.preventDefault();

    if (validate_register()) {
        let firstname = $("#firstname").val();
        let lastname = $("#lastname").val();
        let email = $("#email").val();
        let phone = $("#phone").val();
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
             //   _token: "{{ csrf_token() }}",
                phone: phone,
            },
            success: function (response) {
                if (response) {
                    var gender, reporting_teacher;
                    if (response.gender == 1) {
                        gender = "Male";
                    } else if (response.gender == 2) {
                        gender = "Female";
                    }
                    if (response.reporting_teacher == 1) {
                        reporting_teacher = "Tea1";
                    } else if (response.reporting_teacher == 2) {
                        reporting_teacher = "Tea2";
                    }
                    $("#studentstable tbody").prepend(
                        "<tr><td>" +
                            response.firstname +
                            "</td><td>" +
                            response.lastname +
                            "</td><td>" +
                            response.email +
                            "</td><td>" +
                            response.phone +
                            "</td><td>" +
                            response.age +
                            "</td><td>" +
                            gender +
                            "</td><td>" +
                            reporting_teacher +
                            "</td></tr>"
                    );
                    $("#studentform")[0].reset();
                    $("#studentModal").modal("hide");

                    swal({
                        title: "Successfully Added!",
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
