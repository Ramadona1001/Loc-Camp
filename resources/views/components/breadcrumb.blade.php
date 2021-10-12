<div class="container">
    <div class="d-flex align-items-center flex-wrap py-2">
        <div id="kt_header_search" class="d-flex align-items-center my-2 me-4 me-lg-6" data-kt-search-keypress="true" data-kt-search-min-length="2" data-kt-search-enter="enter" data-kt-search-layout="menu" data-kt-menu-trigger="auto" data-kt-menu-permanent="true"
            data-kt-menu-placement="bottom-end">
            <nav aria-label="breadcrumb">
                <h4 style="text-align: left !important; float: left; line-height: 35px; margin-left: 20px; color: white; font-weight: normal; font-size: 15px;"><i class="fa fa-paperclip"></i>&nbsp;{{ $title }}</h4>
                <ol class="breadcrumb" style="background: #272e48;text-align:right;">
                    {!! breadcrumbWidget($title,$pages) !!}
                </ol>
            </nav>
        </div>
    </div>
</div>
