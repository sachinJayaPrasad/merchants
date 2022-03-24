@extends('common.layouts')
@section('content')
    <form action="{{ route('add_merchants') }}" method="POST">
    	@csrf
        <div class="col-md-6" style="margin-left:350px;">
            <h2 class="text-center">ADD MERCHANTS</h2>
            <hr>
            <div class="row">
		        <div class="form-group">
		            <strong>Shop Name:</strong>                   
		            <input type="hidden" name="id" value="{{ $merchants->id ?? '' }}">
		            <input type="text" name="name" value="{{ $merchants->name ?? '' }}" class="form-control" placeholder="Shop Name">
		        </div>
		        <div class="form-group">
		            <strong>Email Id:</strong>
		            <input type="email" name="email" value="{{ $merchants->email ?? '' }}" class="form-control" placeholder="Email Id">
		        </div>
		        <div class="form-group">
		            <strong>Phone Number:</strong>
		            <input type="number" name="phone" value="{{ $merchants->phone ?? '' }}" class="form-control" placeholder="Phone Number">
		        </div>
            </div>
            <div class="row mt-2">
		        <div class="form-group">
		            <strong>Address:</strong>
		            <textarea class="form-control" style="height:150px" name="address" placeholder="Address">{{ $merchants->address ?? '' }}</textarea>
		        </div>
		        <div class="form-group">
		            <strong>Multiple Locations of Branch:</strong>
					<button type="button" class=" btn btn-success mb-2 mt-2" id="add" name="add">Add new +</button>
                    <div id="dynamic_row">
                    </div>
		        </div>
		    </div>
		    <div class="mt-2">
		      <button type="submit" class="btn btn-primary">Submit</button>
		    </div>
		</div>
    </form>
@endsection
@section('scripts')
<script>
$(document).ready(function(){
        var i = 1;
        $('#add').click(function() {

            var html = '<div class="form-group" id="row' + i + '">'
            html += '<input  class="form-control" id="location" name="location[]"  placeholder="Enter Location"/>'
            html += '<div class="form-group mt-2"><button type="button" class="btn btn-danger remove mb-2" id="' + i + '" name="remove">-</button></div>'
            html += '</div>'
            $('#dynamic_row').append(html);
            i++;

        });
        // removing parent clone
        $(document).on('click', '.remove', function() {
            var button_id = $(this).attr('id');
            $("#row" + button_id + "").remove();
        });
})
</script>
@endsection