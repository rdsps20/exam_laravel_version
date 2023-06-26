@extends('layouts.employee_header')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/add_employee.css') }}">
@endsection

@section('title')
    <title>Edit Employee</title>
@endsection

@section('content')
    <div class="container mt-5">
        <form method="POST" enctype="multipart/form-data" id="employee_form">
            @csrf
            <div class="row">
                <div class="col-6">
                    <div class="row p-2">
                        <div class="col-2">
                            <label for="last_name"><b>Last Name</b></label>
                        </div>
                        <div class="col-10">
                            <input type="text" name="last_name" id="last_name" value="{{ $employee->last_name }}">
                            <br id="last_name_br" hidden>
                            <label class="input_required" id="last_name_required" hidden>Last name is required</label>
                        </div>
                    </div>

                    <div class="row p-2">
                        <div class="col-2">
                            <label for="first_name"><b>First Name</b></label>
                        </div>
                        <div class="col-10">
                            <input type="text" name="first_name" id="first_name" value="{{ $employee->first_name }}">
                            <br id="first_name_br" hidden>
                            <label class="input_required" id="first_name_required" hidden>First name is required</label>
                        </div>
                    </div>

                    <div class="row p-2">
                        <div class="col-2">
                            <label for="middle_name"><b>Middle Name</b></label>
                        </div>
                        <div class="col-10">
                            <input type="text" name="middle_name" id="middle_name" value="{{ $employee->middle_name }}">
                        </div>
                    </div>

                    <div class="row p-2">
                        <div class="col-2">
                            <label for="date_hired"><b>Date Hired</b></label>
                        </div>
                        <div class="col-10">
                            <input type="datetime-local" name="date_hired" id="date_hired" value="{{ $employee->date_hired }}">
                            <br id="date_hired_br" hidden>
                            <label class="input_required" id="date_hired_required" hidden>Date Hired is required</label>
                        </div>
                    </div>

                    <div class="ms-5 ps-5 pt-3">
                        <button type="button" name="submit" id="submit">Save</button>
                    </div>
                </div>

                <div class="col-6 flex">
                    <div class="row p-2">
                        <div class="col-2">
                            <label for="image_upload"><b>Image</b></label>
                        </div>
                        <div class="col-3">
                            <div>
                                <img src="{{ asset('storage/images/default_image_icon.png') }}" name="image" id="image" width="100%" height="100%">
                            </div>
                            <div>
                                <input type="file" name="image_upload" id="image_upload" accept="image/*">
                                <input type="hidden" name="image_alter" id="image_alter" value="{{ $employee->image }}">
                                <br id="image_upload_br" hidden>
                                <label class="input_required" id="image_upload_required" hidden>Image is required</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script>
        $("#submit").on('click', function(){
            last_name = $("#last_name").val();
            first_name = $("#first_name").val();
            date_hired = $("#date_hired").val();
            proc = true;

            if(last_name == '' || last_name == null){
                $("#last_name_br").attr('hidden', false);
                $("#last_name_required").attr('hidden', false);

                proc = false;
            }

            if(first_name == '' || first_name == null){
                $("#first_name_br").attr('hidden', false);
                $("#first_name_required").attr('hidden', false);

                proc = false;
            }

            if(date_hired == '' || date_hired == null){
                $("#date_hired_br").attr('hidden', false);
                $("#date_hired_required").attr('hidden', false);

                proc = false;
            }

            if(proc == false){
                return false;
            }
            else{
                updateEmployee();
            }
        });

        $("#last_name").on('change', function(){
            if($("#last_name").val() != ''){
                $("#last_name_br").attr('hidden', true);
                $("#last_name_required").attr('hidden', true);
            }
        });

        $("#first_name").on('change', function(){
            if($("#first_name").val() != ''){
                $("#first_name_br").attr('hidden', true);
                $("#first_name_required").attr('hidden', true);
            }
        });

        $("#date_hired").on('change', function(){
            if($("#date_hired").val() != ''){
                $("#date_hired_br").attr('hidden', true);
                $("#date_hired_required").attr('hidden', true);
            }
        });

        $("#image_upload").on('change', function(){
            if($("#image_upload").val() == '' || $("#image_upload").val() == null){
                $("#image_upload").attr('src', '../../src/images/default_image_icon.png');
            }
            else{
                const [file] = image_upload.files
                if (file) {
                    image.src = URL.createObjectURL(file)
                }
            }
        });

        function updateEmployee(){
            var form = $("#employee_form")[0];
            var formData = new FormData(form);

            $.ajax({
                url : "{{ route('update_employee', ['id' => $employee->id]) }}",
                type : "POST",
                contentType : false,
                processData : false,
                data : formData,
                success : function(res){
                    Swal.fire({
                        icon : "success",
                        title : "Success",
                        text : res.message
                    }).then(function(){
                        window.location = "{{ route('employee_list') }}";
                    });
                    
                },
                error : function(xhr, status, error){
                    alert(xhr.responseText);
                }
            });
        }
    </script>
@endsection