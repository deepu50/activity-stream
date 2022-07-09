<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <title>Student Managment system</title>
</head>

<body>
    <style>
        .error {
            color: red;

        }
    </style>
    @if (session()->has('message'))
        <script>
            swal({
                title: "Successfully Edited!",
                text: "Data changes succesfully",
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
                            Edit Student <a href="{{ url()->previous() }}" class="btn btn-primary btn-sm float-right">Back</a>
                        </div>
                        <div class="card-body">
                            <form id="editform" name="editform" method="post" action="{{ route('student_add') }}">
                                @csrf
                                <input type="hidden" name="id_val" id="id_val" value="{{ $students->id }}">
                                <div class="form-group">
                                    <label for=firstname>Firstname</label>
                                    <input type="text" class="form-control" id="firstname" name="firstname"
                                        placeholder="firstname" value={{ $students->firstname }}>
                                    <span id="firstname_error" class="error"></span>
                                </div>
                                <div class="form-group">
                                    <label for=lastname>Lastname</label>
                                    <input type="text" class="form-control" id="lastname" name="lastname"
                                        placeholder="lastname" value={{ $students->lastname }}>
                                    <span id="lastname_error" class="error"></span>
                                </div>
                                <div class="form-group">
                                    <label for=email>Email</label>
                                    <input type="text" class="form-control" id="email" name="email"
                                        placeholder="email" value={{ $students->email }}>
                                    <span id="email_error" class="error"></span>
                                </div>
                                <div class="form-group">
                                    <label for=contact>Contact </label>
                                    <input type="text" class="form-control" id="phone" name="phone"
                                        placeholder="phone" value={{ $students->phone }}>
                                    <span id="phone_error" class="error"></span>
                                </div>
                                <div class="form-group">
                                    <label for=contact>Age </label>
                                    <input type="number" class="form-control" id="age" name="age"
                                        placeholder="Please enter Age" value={{ $students->age }}>
                                    <span id="age_error" class="error"></span>
                                </div>
                                <div class="form-group">
                                    <label for=contact>Gender </label>
                                    <select name="gender" id="gender" class="form-control">
                                        <option value="1" {{ $students->gender == 1 ? 'selected' : '' }}>Male
                                        </option>
                                        <option value="2" {{ $students->gender == 2 ? 'selected' : '' }}>Female
                                        </option>
                                        <option value="3" {{ $students->gender == '' ? 'selected' : '' }}>Other
                                        </option>
                                    </select>
                                    <span id="gender_error" class="error"></span>
                                </div>
                                <div class="form-group">
                                    <label for=contact>Reporting Teacher </label>
                                    <select name="reporting_teacher" id="reporting_teacher" class="form-control">
                                        <option value="1" {{ $students->gender == 1 ? 'selected' : '' }}>tea 1
                                        </option>
                                        <option value="2" {{ $students->gender == 2 ? 'selected' : '' }}>tea 2
                                        </option>
                                    </select>
                                    <span id="reporting_teacher_error" class="error"></span>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Button trigger modal -->


    <!-- Modal -->
    <script src="{{ asset('js/stud_edit.js') }}"></script>
</body>

</html>
