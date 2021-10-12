<div class="modal fade" id="kt_modal_update_role{{ $role->id }}" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-750px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">

                <!--begin::Modal title-->
                <h2 class="fw-bolder">Update Role {{ $role->name }}</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <!--begin::Svg Icon | path: icons/duotone/Navigation/Close.svg-->
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)" fill="#000000">
                                <rect fill="#000000" x="0" y="7" width="16" height="2" rx="1" />
                                <rect fill="#000000" opacity="0.5" transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000)" x="0" y="7" width="16" height="2" rx="1" />
                            </g>
                        </svg>
                    </span>

                </div>

            </div>

            <div class="modal-body scroll-y mx-5 my-7">

                <form id="kt_modal_update_role_form" class="form" action="{{ route('update_roles',Crypt::encrypt($role->id)) }}" method="POST">
                    @csrf
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_update_role_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_update_role_header" data-kt-scroll-wrappers="#kt_modal_update_role_scroll" data-kt-scroll-offset="300px">

                        <div class="fv-row mb-10">

                            <label class="fs-5 fw-bolder form-label mb-2">
                                <span class="required">Role name</span>
                            </label>

                            <input class="form-control form-control-solid" required placeholder="Enter a role name" name="name" value="{{ $role->name }}" />
                        </div>

                        <div class="fv-row">

                        </div>

                    </div>

                    <div class="text-center pt-15">
                        <button type="reset" class="btn btn-light me-3" class="btn-close" data-bs-dismiss="modal" aria-label="Close">Discard</button>
                        <button type="submit" class="btn btn-primary" data-kt-roles-modal-action="submit">
                            <span class="indicator-label">Save</span>
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
