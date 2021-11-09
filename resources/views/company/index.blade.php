@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Comapnies') }}</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet">
                                <div class="portlet-body">
                                    <div class="table-toolbar">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <a href="" id="add-company" class="btn btn-primary" role="button">Create new company</p>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-header">{{ __('List') }}</div>
                                    <div id="company-alert-message" role="alert">
                                    </div>
                                    <div class="company-table" id="company-pagination">
                                        @include('company.table')
                                    </div>
                                </div>
                            </div>
                            <!-- END EXAMPLE TABLE PORTLET-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="company-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    @include('company.modal')
</div>
@endsection
@push('scripts')
<script>
    //show company form
    $("body").on('click', '#add-company', function(e) {
        e.preventDefault();
        $('#company-modal').modal('show');
    });


    //save company form

    $("body").on('click', '#save-comapny-form-button', function(e) {
        e.preventDefault();
        var formData = new FormData($('#comapny-form')[0]);
        saveUpdateCompany(formData, 'save');
    });

    function saveUpdateCompany(formData, type) {
        $.ajax({
            url: "{{route('companies.store')}}",
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function(response) {
                $(".company-table").html(response.html);
                $('#company-modal').modal('hide');
                if (response.status == "danger") {

                    // alert('#company-alert-message', 'danger', response.status);
                } else if ((response.status == "success")) {
                    // alert('#company-alert-message', 'success', response.status);
                }

            },
            error: function(error) {
                $.each(error.responseJSON.errors, function(key, value) {
                    console.log(key);
                    console.log(value);
                    $('input[name="' + key + '"]').parent().find('span.error').html(value).addClass('active').show();
                    $('select[name="' + key + '"]').parent().find('span.error').html(value).addClass('active').show();
                });
            }
        });
    }

    window.uploadPhotos = function(url) {
        console.log(url);
        // Read in file
        var file = event.target.files[0];

        // Ensure it's an image
        if (file.type.match(/image.*/)) {
            console.log('An image has been loaded');

            // Load the image
            var reader = new FileReader();
            reader.onload = function(readerEvent) {
                var image = new Image();
                image.onload = function(imageEvent) {

                    // Resize the image
                    var canvas = document.createElement('canvas'),
                        max_size = 544, // TODO : pull max size from a site config
                        width = image.width,
                        height = image.height;
                    if (width > height) {
                        if (width > max_size) {
                            height *= max_size / width;
                            width = max_size;
                        }
                    } else {
                        if (height > max_size) {
                            width *= max_size / height;
                            height = max_size;
                        }
                    }
                    canvas.width = width;
                    canvas.height = height;
                    canvas.getContext('2d').drawImage(image, 0, 0, width, height);
                    var dataUrl = canvas.toDataURL('image/jpeg');
                    var resizedImage = dataURLToBlob(dataUrl);
                    $.event.trigger({
                        type: "imageResized",
                        blob: resizedImage,
                        url: dataUrl
                    });
                }
                image.src = readerEvent.target.result;
            }
            reader.readAsDataURL(file);
        }
    };

    //delete-company

    $("body").on('click', '#delete-company', function(e) {
        e.preventDefault();
        let id = $(this).attr('data-id');
        let url = "/companies/" + id;
        $.ajax({
            url: url,
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            processData: false,
            contentType: false,
            dataType: "json",
            success: function(response) {
                $(".company-table").html(response.html);
                $('#company-modal').modal('hide');
                if (response.status == "danger") {

                    alert('#company-alert-message', 'danger', response.status);
                } else if ((response.status == "success")) {
                    alert('#company-alert-message', 'success', response.status);
                }

            },
            error: function(error) {
                $.each(error.responseJSON.errors, function(key, value) {
                    console.log(key);
                    console.log(value);
                    $('input[name="' + key + '"]').parent().find('span.error').html(value).addClass('active').show();
                    $('select[name="' + key + '"]').parent().find('span.error').html(value).addClass('active').show();
                });
            }
        });
    });


    //edit  company

    $("body").on('click', '#edit-company', function(e) {
        e.preventDefault();
        let id = $(this).attr('data-id');
        console.log(id);
        $.ajax({
            type: 'get',
            url: "/companies/"+id+"/edit",
            success: function(data) {
                $('#company-modal').html(data.html);
                $('#company-modal').modal('show');
                // $('#item-dynamic-edit-'+ clauseItemId ).html(data.html);
            },
        });
    });


    //update-company

    $("body").on('click', '#update-comapny-form-button', function(e) {
        e.preventDefault();
        let id = $(this).attr('data-id');
        var formData = new FormData($('#update-comapny-form')[0]);
        saveUpdateCompany(formData, 'update');
    });
</script>
@endpush