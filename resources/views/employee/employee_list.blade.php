@extends('layouts.employee_header')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/employee_list.css') }}">
@endsection

@section('title')
    <title>Employee List</title>
@endsection

@section('content')
    <div class="container mt-5">
        <ul class="nav nav-tabs">
            <li class="nav-item active-nav">
                <a class="nav-link active" aria-current="page" href="{{ route('employee_list') }}">Employee List</a>
            </li>
            <li class="nav-item non-active mx-1">
                <a class="nav-link" href="{{ route('add_new_employee') }}">Add New</a>
            </li>
        </ul>

        <div class="mt-3">
            <table id="employee_lists" width="100%">
                <thead>
                    <tr>
                        <th>Last Name</th>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Date Hired</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if($lists)
                        @foreach($lists as $list)
                            <tr>
                                <td>{{ $list->last_name }}</td>
                                <td>{{ $list->first_name }}</td>
                                <td>{{ $list->middle_name }}</td>
                                <td>{{ date('Y-m-d h:m A', strtotime($list->date_hired)) }}</td>
                                <td><button type="button" id="edit-employee-btn" onclick="editEmployeeBtn({{ $list->id }})">Edit</button>
                                <button type="button" id="delete-employee-btn" onclick="deleteEmployeeBtn({{ $list->id }})">Delete</button></td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function editEmployeeBtn(id){
            window.location = "{{ route('edit_employee', '') }}/" + id;
        }

        function deleteEmployeeBtn(id){
            
            $.ajax({
                url : "{{ route('delete_employee', '') }}/" + id,
                type : "POST",
                data : {
                    _token : "{{ csrf_token() }}"
                },
                success : function(res){
                    Swal.fire({
                        icon : 'success',
                        text : res.message,
                        title : 'Deleted'
                    }).then(function(){
                        location.reload();
                    });
                }
            });

        }
    </script>
@endsection