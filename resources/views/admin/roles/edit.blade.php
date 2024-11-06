@extends('admin.master')
@section('content')
	 <h6 class="mb-0 text-uppercase">Edit Role</h6>
	<hr/>
	<div class="row">
		<div class="col-xl-10 mx-auto">		
			<div class="card">
              <div class="card-body">
                <div class="border p-3 rounded">
                <h6 class="mb-0 text-uppercase">Edit Role</h6>
                <hr/>

                <form class="row g-3" action="{{route('role.update',$role->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')

                <div class="col-12">
                    <label class="form-label">Role Name</label>
                    <input type="text" name="name" value="{{$role->name}}" class="form-control" required>
                  </div>


                  <br><br>

                  <h5>Permissions</h5>

                  <br>

                  <table>
                    @php $i = 1; @endphp
                    <tr>
                      <td><label class="form-check form-check-custom form-check-solid me-9"
                            for="checkPermissionAll">
                            <input class="form-check-input" type="checkbox" value="1"
                              {{ App\Models\Admin::roleHasPermissions($role, $all_permissions) ? 'checked' : '' }} 
                              onclick="checkPermissionByGroup('role-{{ $i }}-management-checkbox', this)"
                              id="checkPermissionAll" />
                            <span class="form-check-label">Select all</span>
                          </label></td>
                    </tr>


                    <tr>
                      <td>
                        
                        <div class="role-{{ $i }}-management-checkbox">
                        @foreach ($all_permissions as $permission)
                            <label
                              class="form-check form-check-sm form-check-custom form-check-solid me-2 me-lg-20 mt-1"
                              for="{{$permission->id}}">

                              <input class="form-check-input" type="checkbox"
                                name="permission[]" value="{{$permission->name}}"
                                id="{{$permission->id}}"
                                {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>

                              <span
                                class="form-check-label">{{ Str::title($permission->name) }}</span>
                            </label>
                           
                            @endforeach
                          </div>
                      </td>
                    </tr>
                    @php $i++; @endphp

                  </table>


                   <div class="col-12">
                    <div class="">
                      <button type="submit" class="btn btn-primary">Update Role</button>
                    </div>
                  </div>

                </form>

              </div>
              </div>
            </div>

		</div>
	</div>
	<!--end row-->

  <script>
    function checkPermissionByGroup(className, checkThis){
            const groupIdName = $("#"+checkThis.id);
            const classCheckBox = $('.'+className+' input');

            if(groupIdName.is(':checked')){
                 classCheckBox.prop('checked', true);
             }else{
                 classCheckBox.prop('checked', false);
             }
         }
  </script>


@endsection