@extends('layouts.branch_header')

@section('css')
<link rel="stylesheet" href="{{ asset('css/add_branch.css') }}">
@endsection

@section('title')
    <title>Add New Branch</title>
@endsection

@section('content')
    <div class="container">
        <div id="add_branch_div">
            <p id="add_branch">Add Branch</p>
        </div>
        <form method="POST">
            @csrf
            <div>
                <div class="row p-2">
                    <div class="col-2">
                        <label for="branch_code"><b>Branch Code</b></label>
                    </div>
                    <div class="col-10">
                        <input type="text" name="branch_code" id="branch_code">
                        <br id="branch_code_br" hidden>
                        <label class="input_required" id="branch_code_required" hidden>Branch code is required</label>
                    </div>
                </div>

                <div class="row p-2">
                    <div class="col-2">
                        <label for="branch_name"><b>Branch Name</b></label>
                    </div>
                    <div class="col-10">
                        <input type="text" name="branch_name" id="branch_name">
                        <br id="branch_name_br" hidden>
                        <label class="input_required" id="branch_name_required" hidden>Branch name is required</label>
                    </div>
                </div>

                <div class="row p-2">
                    <div class="col-2">
                        <label for="address"><b>Address</b></label>
                    </div>
                    <div class="col-10">
                        <input type="text" name="address" id="address">
                        <br id="address_br" hidden>
                        <label class="input_required" id="address_required" hidden>Address is required</label>
                    </div>
                </div>

                <div class="row p-2">
                    <div class="col-2">
                        <label for="barangay"><b>Barangay</b></label>
                    </div>
                    <div class="col-10">
                        <input type="text" name="barangay" id="barangay">
                        <br id="barangay_br" hidden>
                        <label class="input_required" id="barangay_required" hidden>Barangay is required</label>
                    </div>
                </div>

                <div class="row p-2">
                    <div class="col-2">
                        <label for="city"><b>City</b></label>
                    </div>
                    <div class="col-10">
                        <input type="text" name="city" id="city">
                        <br id="city_br" hidden>
                        <label class="input_required" id="city_required" hidden>City is required</label>
                    </div>
                </div>

                <div class="row p-2">
                    <div class="col-2">
                        <label for="permit_no"><b>Permit No.</b></label>
                    </div>
                    <div class="col-10">
                        <input type="text" name="permit_no" id="permit_no">
                    </div>
                </div>

                <div class="row p-2">
                    <div class="col-2">
                        <label for="branch_manager"><b>Branch Manager</b></label>
                    </div>
                    <div class="col-10">
                        <select name="branch_manager" id="branch_manager">
                            <option disabled></option>
                            @if($employee_lists)
                                @foreach($employee_lists as $list)
                                    <option value="{{ $list->first_name . " " . $list->last_name }}">{{ $list->first_name . " " . $list->last_name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>

                <div class="row p-2">
                    <div class="col-2">
                        <label for="date_opened"><b>Date Opened</b></label>
                    </div>
                    <div class="col-10">
                        <input type="date" name="date_opened" id="date_opened">
                    </div>
                </div>

                <div class="row p-2">
                    <div class="col-2">
                        <label for="active_flag"><b>IsActive</b></label>
                    </div>
                    <div class="col-10">
                        <input type="checkbox" name="active_flag" id="active_flag">
                    </div>
                </div>

                <div class="ms-5 ps-5 pt-3">
                    <button type="button" name="submit" id="submit">Submit</button>
                </div>

                <div class="pt-1">
                    <a href="{{ route('index') }}">Back to List</a>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            // getEmployeeDropDown();
        });

        $("#submit").on('click', function(){
            branch_code = $("#branch_code").val();
            branch_name = $("#branch_name").val();
            address = $("#address").val();
            barangay = $("#barangay").val();
            city = $("#city").val();
            proc = true;

            if(branch_code == '' || branch_code == null){
                $("#branch_code_br").attr('hidden', false);
                $("#branch_code_required").attr('hidden', false);

                proc = false;
            }

            if(branch_name == '' || branch_name == null){
                $("#branch_name_br").attr('hidden', false);
                $("#branch_name_required").attr('hidden', false);

                proc = false;
            }

            if(address == '' || address == null){
                $("#address_br").attr('hidden', false);
                $("#address_required").attr('hidden', false);

                proc = false;
            }

            if(barangay == '' || barangay == null){
                $("#barangay_br").attr('hidden', false);
                $("#barangay_required").attr('hidden', false);

                proc = false;
            }

            if(city == '' || city == null){
                $("#city_br").attr('hidden', false);
                $("#city_required").attr('hidden', false);

                proc = false;
            }

            if(proc == false){
                return false;
            }
            else{
                addNewBranch(branch_code, branch_name, address, barangay, city);
            }
        });

        $("#branch_code").on('change', function(){
            if($("#branch_code").val() != ''){
                $("#branch_code_br").attr('hidden', true);
                $("#branch_code_required").attr('hidden', true);
            }
        });

        $("#branch_name").on('change', function(){
            if($("#branch_name").val() != ''){
                $("#branch_name_br").attr('hidden', true);
                $("#branch_name_required").attr('hidden', true);
            }
        });

        $("#address").on('change', function(){
            if($("#address").val() != ''){
                $("#address_br").attr('hidden', true);
                $("#address_required").attr('hidden', true);
            }
        });

        $("#barangay").on('change', function(){
            if($("#barangay").val() != ''){
                $("#barangay_br").attr('hidden', true);
                $("#barangay_required").attr('hidden', true);
            }
        });

        $("#city").on('change', function(){
            if($("#city").val() != ''){
                $("#city_br").attr('hidden', true);
                $("#city_required").attr('hidden', true);
            }
        });


        function addNewBranch(branch_code, branch_name, address, barangay, city){
            permit_no = $("#permit_no").val();
            branch_manager = $("#branch_manager").val();
            date_opened = $("#date_opened").val();
            if($("#active_flag").is(":checked")){
                active_flag = 1
            }
            else{
                active_flag = 0;
            }
            
            $.ajax({
                url : "{{ route('add_new_branch_action') }}",
                type : "POST",
                data : {
                    branch_code : branch_code,
                    branch_name : branch_name,
                    address : address,
                    barangay : barangay,
                    city : city,
                    permit_no : permit_no,
                    branch_manager : branch_manager,
                    date_opened : date_opened,
                    active_flag : active_flag,
                    _token : "{{ csrf_token() }}",
                },
                success : function(res){
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: res.message,
                    })
                    .then(function(){
                        window.location = "{{ route('index') }}";
                    });
                    
                },
                error : function(xhr, status, error){
                    alert(xhr.responseText);
                }
            });
        }

        function getEmployeeDropDown(){
            $.ajax({
                url : "../functions/action.php",
                type : "GET",
                data : {
                    action : 'get_employee_drop_down',
                },
                success : function (res){
                    data = JSON.parse(res);
                    console.log(data);
                    for(var i = 0; i < data.length; i++){
                        if(data[i].middle_name != '' || data[i].middle_name != null){
                            fullname = data[i].first_name + " " + data[i].middle_name + " " + data[i].last_name;
                        }
                        else{
                            fullname = data[i].first_name + " " + data[i].last_name;
                        }
                        $("#branch_manager").append(`
                            <option value="${fullname}">${fullname}</option>
                        `);
                    }
                }
            });
        }


    </script>
@endsection