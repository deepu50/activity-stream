<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> 
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<title>Ajax crud</title>
</head>
<body>
@if (session()->has('delete'))
                <script>
                    swal({
                        title: "Successfully Deleted!",
                        text: "Data deleted succesfully",
                        icon: "success",
                        button: "Ok",
                    }).then((value) => {

                        window.location = "{{ route('dashboard') }}";

                    });
                </script>
                @endif
    <section style="padding-top:60px">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                             <h6 class="m-0 font-weight-bold text-primary float-left">Students</h6> 
                             <a href="#" class="btn btn-success" data-toggle="modal" data-target="#studentModal" style="margin-left:52rem;">Add new student</a>
                              <a href="/" class="btn btn-success"  style="margin-left: 57rem; margin-top: 7px; padding: 6px 25px;" >Activity log</a>
                            
                        </div>
                        <div class="card-body">
                            <table id="studentstable" class="table">
                                <thead>
                                    <tr>
                                        <th>Firstname</th>
                                        <th>Lastname</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $student)
                                    <tr>
                                        <td>{{$student->firstname}}</td>
                                        <td>{{$student->lastname}}</td>
                                        <td>{{$student->email}}</td>
                                        <td>{{$student->email}}</td>
                                        <td>
                                           <a href="/edit/{{$student->id}}"><button type="submit" class="btn btn-secondary">Edit</button></a>
                                           <form id="delete" name="delete" method="post" action="/delete/{{$student->id}}">
                                           @csrf
                                           <button type="submit" style="margin-top:8px; padding:5px;" class="btn btn-danger">Delete</button>
                                           </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Button trigger modal -->

  
  <!-- Modal -->
  <div class="modal fade" id="studentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add student</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="studentform" name="studentform" onsubmit="return validate_register()">
              @csrf
              <div class="form-group">
                  <label for=firstname>Firstname</label>
                  <input type="text" class="form-control" id="firstname" name="firstname" placeholder="firstname">
                  <span id="firstname_error" class="error"></span>
              </div>
              <div class="form-group">
                <label for=lastname>Lastname</label>
                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="lastname">
                <span id="lastname_error" class="error"></span>
            </div>
            <div class="form-group">
                <label for=email>Email</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="email">
                <span id="email_error" class="error"></span>
            </div>
            <div class="form-group">
                <label for=contact>Contact </label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="phone">
                <span id="phone_error" class="error"></span>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
        
      </div>
    </div>
  </div>
  <script type="text/javascript">
  function validate_register() {
      var formIsValid = true;
      var customer = document.forms["studentform"]["firstname"];
                if (customer.value == null || customer.value == "") {
                    customer.style.borderColor = "red";
                    customer.classList.add("error");
                    //  document.getElementById("customer").placeholder = "Required field";
                    document.getElementById("firstname_error").innerHTML = "*Required field"
                    $("#firstname").focus();
                    formIsValid = false;

                }
                var lastname = document.forms["studentform"]["lastname"];
                if (lastname.value == null || lastname.value == "") {
                    lastname.style.borderColor = "red";
                    lastname.classList.add("error");
                    //  document.getElementById("customer").placeholder = "Required field";
                    document.getElementById("lastname_error").innerHTML = "*Required field"
                    $("#lastname").focus();
                    formIsValid = false;

                }
                  var email = document.forms["studentform"]["email"];
                if (email.value == null || email.value == "") {
                    email.style.borderColor = "red";
                    email.classList.add("error");
                    document.getElementById("email_error").innerHTML = "*Required field"
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
               
                if (phone.value.length != 0 && phone.value != null || phone.value != "") {

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
      $("#studentform").submit(function(e){
          e.preventDefault();
           

          
                if(validate_register()){
                       let firstname=$('#firstname').val();
          let lastname=$('#lastname').val();
          let email=$('#email').val();
          let phone=$('#phone').val();
          console.log("test");
   
      $.ajax({
          url:"/student_add",
          method:"POST",
          data:{
              firstname:firstname,
              lastname:lastname,
              email:email,
              _token:"{{ csrf_token() }}",
              phone:phone

          },
          success:function(response){
              if(response){
                  $('#studentstable tbody').prepend('<tr><td>'+response.firstname +'</td><td>'+response.lastname +'</td><td>'+response.email +'</td><td>'+response.phone +'</td></tr>');
                  $('#studentform')[0].reset();
                  $('#studentModal').modal('hide');
                  
                    swal({
                        title: "Successfully Added!",
                        text: "Welcome",
                        icon: "success",
                        button: "Ok",
                    }).then((value) => {

                        window.location = "{{ route('dashboard') }}";

                    });
            
              }
          }
      });


                }else{

                }
       
    });
         
      
      </script>

    
</body>
</html>