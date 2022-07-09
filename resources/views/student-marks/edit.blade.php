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

    <title>Student Management System</title>
</head>
<style>
    .error{
        color:red;

    }

</style>

<body>
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

                                Edit Marks <a href="{{ url()->previous() }}" class="btn btn-primary btn-sm float-right">Back</a>

                        </div>
                        <div class="card-body">
                            <form id="editform" name="editform" method="post" action="{{ route('marks_add') }}">
                                @csrf
                                <input type="hidden" name="id_val" id="id_val" value="{{ $students->id }}">
                                <div class="form-group">
                                    <label for=student>Student</label>
                                    <select name="student_id" id="student_id" class="form-control">

                                        @foreach ($stude as $stu)
                                            <option value="{{ $stu->id }}"
                                                {{ $students->student_id == $stu->id ? 'selected' : '' }}>
                                                {{ $stu->firstname }}.{{ $stu->lastname }}</option>
                                        @endforeach
                                    </select>
                                    <span id="student_id_error" class="error"></span>
                                </div>
                                <div class="form-group">
                                    <label for=term>Term </label>
                                    <select name="term" id="term" class="form-control">
                                        <option value="1" {{ $students->term == 1 ? 'selected' : '' }}>Term 1
                                        </option>
                                        <option value="2"{{ $students->term == 2 ? 'selected' : '' }}>Term 2
                                        </option>
                                    </select>
                                    <span id="term_error" class="error"></span>
                                </div>

                                <div class="form-group">
                                    <label for=maths>Maths </label>
                                    <input type="number" class="form-control" id="maths" name="maths"
                                        placeholder="Please enter Maths marks" value={{ $students->maths }}>
                                    <span id="maths_error" class="error"></span>
                                </div>
                                <div class="form-group">
                                    <label for=science>Science </label>
                                    <input type="number" class="form-control" id="science" name="science"
                                        placeholder="Please enter Science marks" value={{ $students->science }}>
                                    <span id="science_error" class="error"></span>
                                </div>
                                <div class="form-group">
                                    <label for=history>History </label>
                                    <input type="number" class="form-control" id="history" name="history"
                                        placeholder="Please enter History marks" value={{ $students->history }}>
                                    <span id="history_error" class="error"></span>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="{{ asset('js/edit_validate.js') }}"></script>
</body>

</html>
