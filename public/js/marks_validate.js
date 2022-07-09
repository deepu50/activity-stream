function validate_register() {
    var formIsValid = true;
    var student_id = document.forms["studentmarkform"]["student_id"];
    if (student_id.value == null || student_id.value == "") {
        student_id.style.borderColor = "red";
        student_id.classList.add("error");
        //  document.getElementById("customer").placeholder = "Required field";
        document.getElementById("student_id_error").innerHTML =
            "*Required field";
        $("#student_id").focus();
        formIsValid = false;
    }
    var term = document.forms["studentmarkform"]["term"];
    if (term.value == null || term.value == "") {
        term.style.borderColor = "red";
        term.classList.add("error");
        //  document.getElementById("customer").placeholder = "Required field";
        document.getElementById("term_error").innerHTML = "*Required field";
        $("#term").focus();
        formIsValid = false;
    }
    var maths = document.forms["studentmarkform"]["maths"];
    if (maths.value == null || maths.value == "") {
        maths.style.borderColor = "red";
        maths.classList.add("error");
        document.getElementById("maths_error").innerHTML = "*Required field";
        $("#maths").focus();
        formIsValid = false;
    }
    var science = document.forms["studentmarkform"]["science"];
    if (science.value == null || science.value == "") {
        science.style.borderColor = "red";
        science.classList.add("error");
        document.getElementById("science_error").innerHTML = "*Required field";
        $("#science").focus();
        formIsValid = false;
    }
    var history = document.forms["studentmarkform"]["history"];
    if (history.value == null || history.value == "") {
        history.style.borderColor = "red";
        history.classList.add("error");
        document.getElementById("history_error").innerHTML = "*Required field";
        $("#history").focus();
        formIsValid = false;
    }

    return formIsValid;
}
$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});
$("#studentmarkform").submit(function (e) {
    e.preventDefault();

    if (validate_register()) {
        let student_id = $("#student_id").val();
        let term = $("#term").val();
        let history = $("#history").val();
        let science = $("#science").val();
        let maths = $("#maths").val();

        console.log("test");

        $.ajax({
            url: "/marks_add",
            method: "POST",
            data: {
                student_id: student_id,
                term: term,
                history: history,
                maths: maths,
                science: science,
            },
            success: function (response) {
                if (response) {
                    $("#studentstable tbody").prepend(
                        "<tr><td>" +
                            response.firstname +
                            "</td><td>" +
                            response.lastname +
                            "</td><td>" +
                            response.email +
                            "</td><td>" +
                            response.phone +
                            "</td></tr>"
                    );
                    $("#studentmarkform")[0].reset();
                    $("#studentModal").modal("hide");

                    swal({
                        title: "Successfully Added!",
                        text: "Welcome",
                        icon: "success",
                        button: "Ok",
                    }).then((value) => {

                        var base_url = window.location.origin;
                        window.location = base_url + "/student_marks";
                    });
                }
            },
        });
    } else {
    }
});
$("#maths").keyup(function () {
    if ($(this).val() > 50) {
        document.getElementById("maths_error").innerHTML =
            "*Marks should be out of 50";
        $(this).val("50");
    } else if ($(this).val() == "") {
        document.getElementById("maths_error").innerHTML = "";
    }
});
$("#history").keyup(function () {
    if ($(this).val() > 50) {
        document.getElementById("history_error").innerHTML =
            "*Marks should be out of 50";
        $(this).val("50");
    } else if ($(this).val() == "") {
        document.getElementById("history_error").innerHTML = "";
    }
});
$("#science").keyup(function () {
    if ($(this).val() > 50) {
        document.getElementById("science_error").innerHTML =
            "*Marks should be out of 50";
        $(this).val("50");
    } else if ($(this).val() == "") {
        document.getElementById("science_error").innerHTML = "";
    }
});
