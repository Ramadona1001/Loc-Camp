@extends('layouts.master')

@section('title',$title)

@section('content')

    <h2 class="text-center mb-5">{{ $role->name }}</h2>
    <div class="row">
        @foreach ($permissionsName as $permissionName)
        <div class="col-lg-6 mb-5">
            <div class="ongoing-task-inner notika-shadow mg-t-30">
                <div class="realtime-ctn">
                    <div class="realtime-title ongoing-hd-wd">
                        <h4 class="card-label">
                            {{ ucfirst($permissionName).' ('.transWord("Permissions").')' }}
                        </h4>
                    </div>
                </div>

                <div class="skill-content-3 ongoing-tsk">
                    @foreach ($permissions as $permission)
                        @if (explode('_',$permission->name)[1] == $permissionName)
                            <div class="row">
                                @if (in_array($permission->id,$assignedPermissions))
                                <input type="checkbox" class="myinput large custom permissionCheck" name="" id="{{ $permission->id }}" value="{{ $permission->id }}" name="permissions[]" checked style="margin-left: 20px;margin-right:20px;">
                                @else
                                <input type="checkbox" class="myinput large custom permissionCheck" name="" id="{{ $permission->id }}" value="{{ $permission->id }}" name="permissions[]" style="margin-left: 20px;margin-right:20px;">
                                @endif
                                <label for="{{ $permission->id }}">{{ ucwords(str_replace('_',' ',$permission->name)) }}</label>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection
@section('javascript')


<script>
    $(function() {
        // (Optional) Active an item if it has the class "is-active"
        $(".accordion2 > .accordion-item.is-active").children(".accordion-panel").slideDown();

        $(".accordion2 > .accordion-item").click(function() {
            // Cancel the siblings
            $(this).siblings(".accordion-item").removeClass("is-active").children(".accordion-panel").slideUp();
            // Toggle the item
            $(this).toggleClass("is-active").children(".accordion-panel").slideToggle("ease-out");
        });
    });

    $(document).ready(function(){
        var checkedVals = null;
        var allPermissionsCheck = [];
        var checkedVals = $('.permissionCheck:checkbox:checked').map(function() {
                allPermissionsCheck.push(this.value);
            }).get();

        $('input[type="checkbox"]').click(function(){
            if($(this).prop("checked") == true){
                if (!allPermissionsCheck.includes($(this).val())) {
                    allPermissionsCheck.push($(this).val());
                }
            }
            else if($(this).prop("checked") == false){
                var index = allPermissionsCheck.indexOf($(this).val());
                if (index !== -1) allPermissionsCheck.splice(index, 1);
            }
            var roleId = '{{ $role->id }}';
            var assignPermissionUrl = '{{ route("assign_permissions_roles",["id"=>"#id"]) }}';
            assignPermissionUrl = assignPermissionUrl.replace('#id',roleId);

            $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
            jQuery.ajax({
                url: assignPermissionUrl,
                method: 'get',
                data: {
                    permissions: allPermissionsCheck,
                    role_id:roleId
                },
                success: function(result){
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-bottom-left",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    };

                    toastr.success("Process Done Successfully");
                },

                fail: function (result) {
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-bottom-left",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    };

                    toastr.error("Process Failed");
                }
            });
        });

    });


</script>
@endsection
