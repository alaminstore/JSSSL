@extends('backend.home')
@section('title','Admin | Offices')
@section('content')

<div class="ms-content-wrapper">
    <div class="row">

      <div class="col-md-12">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb pl-0">
            <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}"><i class="material-icons">home</i> Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Offices</li>
          </ol>
        </nav>

        <div class="ms-panel">
          <div class="ms-panel-body">
            <div class="addnewdata">
                <button type="button" class="btn btn-sm btn-pill btn-dark has-icon clientBtn" title="Add" data-toggle="modal" data-target="#myModalSave"><i class="fa fa-plus"></i>Office</button>
            </div>
            <div class="service_list">
                <h4 class="text-center display-4" style="font-size: 25px;">Office List</h4>
            </div><br>
            <div id="reload-category">
                <table id="socialMedia" class="table w-100 table-striped  dataTable no-footer" role="grid" aria-describedby="data-table-4_info" style="width: 1098px;">
                    <thead>
                        <tr role="row">
                            <th class=" text-center">Office Title </th>
                            <th class=" text-center">Office Address </th>
                            <th class=" text-center">Email </th>
                            <th class=" text-center">Phone Number </th>
                            <th class=" text-center">Action </th>
                        </tr>
                    </thead>
                    <tbody id="loadnow">
                        @foreach ($offices as $office)
                        <tr class="item{{$office->office_id}}" role="row">
                            <td class="text-center">{{$office->office_title}}</td>
                            <td class="text-center">{{ \Illuminate\Support\Str::limit($office->office_address, 30, $end='...') }}</td>
                            <td class="text-center">{{$office->office_email}}</td>
                            <td class="text-center">{{$office->office_phone}}</td>
                            <td class="text-center">
                                <button type="button"
                                        class="ms-btn-icon btn-info viewData"
                                        data-id="{{$office->office_id}}">
                                    <i class="fa fa-eye"></i>
                                </button>
                                <button type="button"
                                        class="ms-btn-icon btn-success media-edit"
                                        data-id="{{$office->office_id}}" title="Edit">
                                    <i class="flaticon-pencil"></i>
                                </button>
                                <a class="deletetag" data-id="{{$office->office_id}}">
                                    <button class="ms-btn-icon btn-primary category-delete"
                                            title="Delete"><i
                                            class="flaticon-trash"></i></button>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--modal content  Save-->
<div id="myModalSave" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"aria-hidden="true">
  <div class="modal-dialog">
     <div class="modal-content">
         <div class="modal-header">
             <div class="headCenter">
                <div class="headCenter"><h5 class="modal-title mt-0" id="myModalLabel">Add New Office</h5></div>
             </div>
             <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
         </div>
         <div class="modal-body">
             {!!Form::open(['class' => 'form-horizontal','id'=>'mediaStore'])!!}
             @csrf
             <div class="form-group row flex_css">
                 <label for="name" class="col-sm-3 col-form-label">Office Title</label>
                 <div class="col-sm-9">
                     <input class="form-control" type="text"  name="office_title"
                            placeholder="Office Title...">
                 </div>
             </div>
             <div class="form-group row flex_css">
                <label for="name" class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-9">
                    <input class="form-control" type="email"  name="office_email"
                           placeholder="Email Here...">
                </div>
            </div>
            <div class="form-group row flex_css">
                <label for="name" class="col-sm-3 col-form-label">Phone Number</label>
                <div class="col-sm-9">
                    <input class="form-control" type="text"  name="office_phone"
                           placeholder="017********">
                </div>
            </div>
            <div class="form-group row flex_css">
                <label for="name" class="col-sm-3 col-form-label">Address</label>
                <div class="col-sm-9">
                     <textarea name="office_address" class="form-control" id="" cols="30" rows="3" placeholder="Office Address..."></textarea>
                </div>
            </div>
             <div class="form-group m-b-0">
                 <div>
                     <button type="submit" class="btn btn-square btn-info">
                         Submit
                     </button>
                     <button type="reset" class="btn btn-square btn-light waves-effect m-l-5" data-dismiss="modal">
                         Cancel
                     </button>
                 </div>
             </div>
             {!!Form::close()!!}
         </div>
     </div>
 </div>
</div>

<!--modal content Update -->
<div id="myModal" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="headCenter">
                    <div class="headCenter"><h5 class="modal-title mt-0" id="myModalLabel">Office Info Update</h5></div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                {!!Form::open(['class' => 'form-horizontal','id'=>'mediaUpdate'])!!}
                @csrf
                <div class="form-group row flex_css">
                    <label for="name" class="col-sm-3 col-form-label">Office Title</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" id="office_title"  name="office_title"
                               placeholder="Office Title...">
                    </div>
                </div>
                <div class="form-group row flex_css">
                   <label for="name" class="col-sm-3 col-form-label">Email</label>
                   <div class="col-sm-9">
                       <input class="form-control" type="email" id="office_email"  name="office_email"
                              placeholder="Email Here...">
                   </div>
               </div>
               <div class="form-group row flex_css">
                   <label for="name" class="col-sm-3 col-form-label">Phone Number</label>
                   <div class="col-sm-9">
                       <input class="form-control" type="text" id="office_phone"  name="office_phone"
                              placeholder="017********">
                   </div>
               </div>
               <div class="form-group row flex_css">
                   <label for="name" class="col-sm-3 col-form-label">Address</label>
                   <div class="col-sm-9">
                        <textarea name="office_address" class="form-control" id="office_address" cols="30" rows="3" placeholder="Office Address..."></textarea>
                   </div>
               </div>
                <input type="hidden" name="category_id" id="category-edit-id" class="form-control">

                <div class="form-group m-b-0">
                    <div>
                        <button type="submit" class="btn btn-square btn-success waves-effect waves-light">
                            Update
                        </button>
                        <button type="reset" class="btn btn-square btn-secondary waves-effect m-l-5" data-dismiss="modal">
                            Cancel
                        </button>
                    </div>
                </div>
                {!!Form::close()!!}
            </div>
        </div>
    </div>
</div>


{{-- View Modal --}}
<div id="viewModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
 <div class="modal-dialog">
   <div class="modal-content">
       <div class="modal-header">
           <div class="headCenter">
            <div class="headCenter"><h5 class="modal-title mt-0" id="myLargeModalLabel">Office Details</h5></div>
           </div>
           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
       </div>
       <div class="modal-body" style="background: #f5f5f5;">

           <div class="Catname">
               <div class="d-flex">
                   <div class="col-md-4 p-0">
                       <p><b>Office Title:</b></p>
                   </div>
                   <div class="col-md-8 p-0">
                       <div id="view_title"></div>
                   </div>
               </div>
           </div><br>
           <div class="Catname">
               <div class="d-flex">
                   <div class="col-md-4 p-0">
                       <p><b>Email:</b></p>
                   </div>
                   <div class="col-md-8 p-0">
                       <div id="view_email"></div>
                   </div>
               </div>
           </div><br>
           <div class="Catname">
               <div class="d-flex">
                   <div class="col-md-4 p-0">
                       <p><b>Phone Number:</b></p>
                   </div>
                   <div class="col-md-8 p-0">
                       <div id="view_phone"></div>
                   </div>
               </div>
           </div><br>
           <div class="Catname">
               <div class="d-flex">
                   <div class="col-md-4 p-0">
                       <p><b>Address:</b></p>
                   </div>
                   <div class="col-md-8 p-0">
                       <div id="view_address"></div>
                   </div>
               </div>
           </div><br>
       </div>
   </div>
</div>
</div>


@endsection
@section('js')
<script>
    $(document).ready( function () {
        $('#socialMedia').DataTable();

        $(".clientBtn").on('click', function () {
            $("#mediaStore").load(location.href + " #mediaStore>*", "");
        });


        $("#mediaStore").validate({
        rules: {
            office_title: {
                required:true,
                maxlength:80
            },
            office_email: {
                required:true,

            },
            office_phone: {
                required:true,
                minlength:11,
                maxlength:11
            },
            office_address: {
                required:true,
            },

        },
    });
    $("#mediaUpdate").validate({
        rules: {
            office_title: {
                required:true,
                maxlength:80
            },
            office_email: {
                required:true,

            },
            office_phone: {
                required:true,
                minlength:11,
                maxlength:11
            },
            office_address: {
                required:true,
            },


        },
    });

        // CRUD Operation

        //edit data
        $('#reload-category').on('click', '.media-edit', function () {
                let id = $(this).attr('data-id');
                $.ajax({
                    url: "{{url('offices')}}/" + id + '/edit',
                    method: "get",
                    data: {},
                    dataType: 'json',
                    success: function (response) {
                        let url = window.location.origin;
                        console.log('data', response);
                        $('#office_title').val(response.data.office_title);
                        $('#office_email').val(response.data.office_email);
                        $('#office_phone').val(response.data.office_phone);
                        $('#office_address').val(response.data.office_address);
                        $('#category-edit-id').val(response.data.office_id);
                        $('#myModal').modal('show');
                    },
                    error: function (error) {
                        if (error.status == 404) {
                            toastr.error('Not found!');
                        }
                    }
                });
            });

            //View===============================================================
            $('#reload-category').on('click', '.viewData', function () {
                let id = $(this).attr('data-id');
                console.log('id--', id);
                $.ajax({
                    url: "{{url('offices')}}/" + id,
                    method: "get",
                    data: {},
                    dataType: 'json',
                    success: function (response) {
                        let url = window.location.origin;
                        // console.log('data', response.data);
                        $('#view_title').html(response.data.office_title);
                        $('#view_email').html(response.data.office_email);
                        $('#view_phone').html(response.data.office_phone);
                        $('#view_address').html(response.data.office_address);
                        $('#viewModal').modal('show');
                    },
                    error: function (error) {
                        if (error.status == 404) {
                            toastr.error('Not found!');
                        }
                    }
                });
            });

        //save data
        $('#mediaStore').on('submit', function (e) {
            e.preventDefault();
            var $form = $(this);
            if(! $form.valid()) return false;
            $.ajax({
                url: "{{route('offices.store')}}",
                method: "POST",
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                    // console.log('save', response);
                    toastr.options = {
                        "debug": false,
                        "positionClass": "toast-bottom-right",
                        "onclick": null,
                        "fadeIn": 300,
                        "fadeOut": 1000,
                        "timeOut": 5000,
                        "extendedTimeOut": 1000
                    };
                    if(response.status == 0){
                        $.each(response.error,function(key,value){
                            toastr.error(value);
                        })
                    }else{
                        if(response.status = true){
                            $('#myModalSave').modal('hide');
                            toastr.success('Data Inserted Successfully');
                            $('#mediaStore').trigger('reset');
                            var content_table = $('#socialMedia').DataTable();
                        var tst = content_table.row.add([

                    "" + response.data.office_title + "",
                    "" + response.data.office_address.substring(0,20) + "",
                    "" + response.data.office_email + "",
                    "" + response.data.office_phone + "",
                    `<button type="button" class="ms-btn-icon btn-info viewData" data-id="${response.data.office_id}"><i class="fa fa-eye"></i></button>&nbsp;<button type="button" class="ms-btn-icon btn-success media-edit" data-id="${response.data.office_id}" title="Edit"><i class="flaticon-pencil"></i></button>&nbsp;<a class="deletetag" data-id="${response.data.office_id}"><button class="ms-btn-icon btn-primary category-delete" title="Delete"><i class="flaticon-trash"></i></button> </a>`
                ]).draw().node();
                        }
                        $("#loadnow").load(location.href + " #loadnow>*", "");

                    }

                }

            });

        });

        //Delete data
        $(document).on('click', '.deletetag', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            console.log('id: ', id);
            //alert(role);
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
            }).then(result => {
                    if (result.value) {
                        $.ajax({
                            url: "{!! route('offices.destroy') !!}",
                            type: "get",
                            data: {
                                id: id,
                            },
                            success: function(response) {
                                console.log('tt',response);
                                if (response.success === true) {
                                    toastr.success('Data Deleted Successfully');
                                    $('#socialMedia').DataTable().row('.item' + response.data.office_id).remove()
                                    .draw()
                                }
                                $("#loadnow").load(location.href + " #loadnow>*", "");
                            }

                        });
                    }
                }
            )
        });


        // //Update data
        $('#mediaUpdate').on('submit', function (e) {
            e.preventDefault();
            var $form = $(this);
            if(! $form.valid()) return false;
            $.ajax({
                url: "{{route('offices.updated')}}",
                method: "POST",
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    console.log('update', data);
                    toastr.options = {
                        "debug": false,
                        "positionClass": "toast-bottom-right",
                        "onclick": null,
                        "fadeIn": 300,
                        "fadeOut": 1000,
                        "timeOut": 5000,
                        "extendedTimeOut": 1000
                    };

                    if(data.status == 0){
                        $.each(data.error,function(key,value){
                            toastr.error(value);
                        })
                    }else{
                        if(data.status = true){
                            $('#myModal').modal('hide');
                            toastr.success('Data Updated Successfully');
                            $('#mediaUpdate').trigger('reset');
                            $("#loadnow").load(location.href + " #loadnow>*", "");
                        }
                    }
                }
            });
        });
    });
</script>
@endsection
