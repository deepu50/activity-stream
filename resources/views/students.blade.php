<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<title>Student Management System</title>
</head>
<body>
    <style>
        .error{
            color:red;

        }

    </style>
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
                        <div class="card-header py-3">
                             <h6 class="m-0 font-weight-bold text-primary float-left">Students</h6>
                             <a href="#" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#studentModal" style="margin-left:52rem;">Add new student</a>
                             <a href="{{ route("student_marks") }}" class="btn btn-primary btn-sm float-right" style="margin-left: 1rem; margin-top: 9px; margin-right: 20px;">Student Mark</a>

                        </div>
                        <div class="card-body">
                            <table id="studentstable" class="table">
                                <thead>
                                    <tr>
                                        <th>Firstname</th>
                                        <th>Lastname</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Age</th>
                                        <th>Gender</th>
                                        <th>Reporting Teacher</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $student)
                                    <tr>
                                        <td>{{$student->firstname}}</td>
                                        <td>{{$student->lastname}}</td>
                                        <td>{{$student->email}}</td>
                                        <td>{{$student->phone}}</td>
                                        <td>{{$student->age}}</td>
                                        <td>
                                            @if($student->gender==1)
                                                <span>Male</span>
                                            @elseif($student->gender==1)
                                                <span>Female</span>
                                            @else
                                            @endif
                                        </td>
                                        <td>
                                            @if($student->reporting_teacher==1)
                                                <span>Tea 1</span>
                                            @else
                                                <span>Tea 2</span>
                                            @endif
                                        </td>
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
                <input type="text" class="form-control" id="email" name="email" placeholder="Please enter email">
                <span id="email_error" class="error"></span>
            </div>
            <div class="form-group">
                <label for=contact>Contact </label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="phone">
                <span id="phone_error" class="error"></span>
            </div>
            <div class="form-group">
                <label for=contact>Age </label>
                <input type="number" class="form-control" id="age" name="age" placeholder="Please enter Age">
                <span id="age_error" class="error"></span>
            </div>
            <div class="form-group">
                <label for=contact>Gender </label>
                <select name="gender" id="gender" class="form-control">
                    <option value="1">Male</option>
                    <option value="2">Female</option>
                </select>
                <span id="gender_error" class="error"></span>
            </div>
            <div class="form-group">
                <label for=contact>Reporting Teacher </label>
                <select name="reporting_teacher" id="reporting_teacher" class="form-control">
                    <option value="1">tea 1</option>
                    <option value="2">tea 2</option>
                </select>
                <span id="reporting_teacher_error" class="error"></span>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>

      </div>
    </div>
  </div>
  <script src="{{asset('js/student_validate.js')}}"></script>
</body>
</html>
