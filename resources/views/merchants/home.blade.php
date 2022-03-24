@extends('common.layouts')
<style>
  .content {
    background-color: white;
    padding: 10px;
  }
 .modal {
     overflow: auto !important; 
     }
.error{
    color:red;
}
</style>
@section('content')
    {{-- <a data-bs-toggle="modal" data-bs-target="#addModal" class="btn btn-success mb-1" style="float:right">Add New</a> --}}
    {{-- <button class="btn btn-info btn-md mg-r-30 mt-1 mb-1 shadow-lg" data-toggle="modal" data-target="#addModal" >
        <i class="fas fa-plus-square"></i>&nbsp Add New
    </button> --}}
    <a href="{{ route('show_add_page') }}" class="btn btn-success mb-1" style="float:right">Add New</a>
    <table class="table table-bordered table-hover mt-3">
        <thead>
            <th>#</th>
            <th>Shop name</th>
            <th>Email Id </th>
            <th>Address</th>
            <th>Phone</th>
            <th>Action</th>
        </thead>
        <tbody>    
            @foreach ($merchants as $merchant)  
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $merchant->shop_name }}</td>
                <td>{{ $merchant->email }}</td>
                <td>{{ $merchant->address }}</td>
                <td>{{ $merchant->phone }}</td>
                <td >
                    <a href="{{ url('edit-merchant/'.$merchant->id) }}"  title="edit"><button class="btn btn-info fa fa-pencil tx-20 edit-button mr-1"></button></a>
                    <a href="{{ url('delete-merchant/'.$merchant->id) }}" onclick="return confirm('Are you sure?')" class="fa fa-trash-alt tx-20 "><button class="btn btn-danger fa fa-trash tx-20 mr-1"></button></a>
                </td>
            </tr>
            @endforeach  
        </tbody>  
    </table>
@endsection

