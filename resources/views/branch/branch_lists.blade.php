@extends('layouts.branch_header')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('title')
    <title>Branch Lists</title>
@endsection

@section('content')
    <div class="container">
        <div>
            <h1>Branch List</h1>
        </div>
        <div>
            <button type="button" name="add" id="add">Add New</button>
        </div>
        <div class="mt-3">
            <table id="lists">
                <thead>
                    <tr>
                        <th>Branch Code</th>
                        <th>Branch Name</th>
                        <th>Branch Manager</th>
                        <th>Date Opened</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){

            var table = $("#lists").DataTable({
                "language" : {
                    "emptyTable" : "No data found, click on <b>Add New</b> button"
                },
                ajax:{
                    url : "{{ route('get_branch_lists') }}",
                    type : "GET",
                    dataSrc : function(json){
                        var return_data = new Array();

                        for(var i = 0; i < json.length; i++){
                            return_data.push({
                                "id" : json[i].id,
                                "branch_code" : json[i].branch_code,
                                "branch_name" : json[i].branch_name,
                                "address" : json[i].address,
                                "barangay" : json[i].barangay,
                                "city" : json[i].city,
                                "permit_no" : json[i].permit_no,
                                "branch_manager" : json[i].branch_manager,
                                "date_opened" : json[i].date_opened,
                                "isActive" : json[i].active_flag,
                                "action" : `<button type="button" class="edit_btn" onclick="editBtn(${json[i].id})"><i class="fa fa-edit"></i>Edit</button>
                                            <button type="button" class="delete_btn" onclick="deleteBtn(${json[i].id})"><i class="fa fa-trash-o"></i>Delete</button>`
                            });
                        }

                        return return_data;
                    },
                },
                createdRow: function(row, data, dataIndex){
                    $( row ).find('td:eq(0)').attr('data-validate', 'branch_code');
                    $( row ).find('td:eq(1)').attr('data-validate', 'branch_name');
                    $( row ).find('td:eq(2)').attr('data-validate', 'branch_manager');
                    $( row ).find('td:eq(3)').attr('data-validate', 'date_opened');
                    $( row ).find('td:eq(4)').attr('data-validate', 'action');
                },
                columns:[
                    {data: 'branch_code',class: 'text-center mainText py-2',},
                    {data: 'branch_name',class: 'text-center mainText py-2',},
                    {data: 'branch_manager',class: 'text-center mainText py-2',},
                    {data: 'date_opened',class: 'text-center mainText py-2',},
                    {data: 'action',class: 'text-center mainText py-2',},
                ],
            });

        });

            $("#add").on('click', function(){
                window.location = "{{ route('add_new_branch') }}";
            });

            function editBtn(id){
                window.location = "{{ route('edit_branch', '') }}/" + id ;
            }

            function deleteBtn(id){
                if(id == 0) return false;
    
                $.ajax({
                    url : "{{ route('delete_branch', '') }}/" + id,
                    type : "POST",
                    data : {
                        _token : "{{ csrf_token() }}",
                    },
                    success : function (res){
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: res.message,
                        })
                        .then(function(){
                            location.reload();
                        });
                    },
                    error : function (xhr, status, error){
                        alert(xhr.responseText)
                    }
                });
            }
    </script>
@endsection