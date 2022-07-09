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

    <title>Ajax crud</title>
</head>
<style>
    .error{
        color:red;

    }

</style>

<body>
    @if (session()->has('delete'))
        <script>
            swal({
                title: "Successfully Deleted!",
                text: "Data deleted succesfully",
                icon: "success",
                button: "Ok",
            }).then((value) => {

                window.location = "{{ route('student_marks') }}";

            });
        </script>
    @endif
    <section style="padding-top:60px">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-primary float-left">Students Marks</h6>
                            <a href="#" class="btn btn-primary btn-sm" data-toggle="modal"
                                data-target="#studentModal" style="margin-left:52rem;">Add Marks</a>
                            <a href="{{ route('dashboard') }}" class="btn btn-primary btn-sm float-right"
                                style="margin-left: 1rem; margin-top: 9px; margin-right: 29px;">Student List</a>

                        </div>
                        <div class="card-body">
                            <table id="studentstable" class="table">
                                <thead>
                                    <tr>
                                        <th>Student Name</th>
                                        <th>Term</th>
                                        <th>Maths</th>
                                        <th>Science</th>
                                        <th>History</th>
                                        <th>Total Marks</th>
                                        <th>Created on</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($results as $student)
                                        <tr>
                                            @php  $name = App\Helper::get_student_name($student->student_id) @endphp
                                            <td>{{ $name }}</td>
                                            <td>
                                                @if ($student->term == 1)
                                                    <span>Term 1</span>
                                                @elseif($student->term == 2)
                                                    <span>Term 2</span>
                                                @else
                                                @endif
                                            </td>
                                            <td>{{ $student->maths }}</td>
                                            <td>{{ $student->science }}</td>
                                            <td>{{ $student->history }}</td>
                                            <?php $tot_marks = $student->maths + $student->science + $student->history; ?>
                                            <td>
                                                {{ $tot_marks }}

                                            </td>
                                            <td>
                                                {{ $student->created_at }}
                                            </td>
                                            <td>
                                                <a href="/edit-marks/{{ $student->id }}"><button type="submit"
                                                        class="btn btn-secondary">Edit</button></a>
                                                <form id="delete" name="delete" method="post"
                                                    action="/marks_delete/{{ $student->id }}">
                                                    @csrf
                                                    <button type="submit" style="margin-top:8px; padding:5px;"
                                                        class="btn btn-danger">Delete</button>
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
    <div class="modal fade" id="studentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Marks</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="studentmarkform" name="studentmarkform" onsubmit="return validate_register()">
                        @csrf
                        <div class="form-group">
                            <label for=student>Student</label>
                            <select name="student_id" id="student_id" class="form-control">
                                <option value="">Please Select Student</option>
                                @foreach ($students as $student)
                                    <option value="{{ $student->id }}">
                                        {{ $student->firstname }}.{{ $student->lastname }}</option>
                                @endforeach
                            </select>
                            <span id="student_id_error" class="error"></span>
                        </div>
                        <div class="form-group">
                            <label for=term>Term </label>
                            <select name="term" id="term" class="form-control">
                                <option value="1">Term 1</option>
                                <option value="2">Term 2</option>
                            </select>
                            <span id="term_error" class="error"></span>
                        </div>

                        <div class="form-group">
                            <label for=maths>Maths </label>
                            <input type="number" class="form-control" id="maths" name="maths"
                                placeholder="Please enter Maths marks">
                            <span id="maths_error" class="error"></span>
                        </div>
                        <div class="form-group">
                            <label for=science>Science </label>
                            <input type="number" class="form-control" id="science" name="science"
                                placeholder="Please enter Science marks">
                            <span id="science_error" class="error"></span>
                        </div>
                        <div class="form-group">
                            <label for=history>History </label>
                            <input type="number" class="form-control" id="history" name="history"
                                placeholder="Please enter History marks">
                            <span id="history_error" class="error"></span>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <script src="{{ asset('js/marks_validate.js') }}"></script>



</body>

</html>
