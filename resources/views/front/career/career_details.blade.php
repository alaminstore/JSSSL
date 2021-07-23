@extends('front.home')
@section('title','Jsssl | Home')
@section('content')
    <style>ul {list-style: unset!important;}
    /* label#fullName-error, label#email-error,label#fatherName-error,label#motherName-error,label#contact-error,label#nidNo-error,label#dateOfBirth-error,label#religion-error,label#workingExp-error,label#uploadPicture-error,label#uploadCv-error,label#degree_sk1-error,label#gpsubject\[\]-error,label#institute\[\]-error,label#result\[\]-error,label#passingyear\[\]-error{
        color: #e10f0f;
        font-size: 14px;
        font-weight: 400;
    } */
    .error.mt-2.text-danger {
        font-size: 13px;
        font-weight: 500;
    }
    </style>


    <section class="career-details hero-pt">
        <div class="container">
            <div class="title-box">
                <h1 class="sc-title">
                    <span>{{$job_id->title}}</span>
                </h1>
                <p class="job-location">{{$job_id->location}}</p>
            </div>
            <div class="description">
                <p class="text">{!! $job_id->description !!}</p>
            </div>
            <div class="keypoints-wrapper">
                <div class="key-points">
                    <h2 class="title">Your Impact</h2>
                    @foreach($job_id->responsibilities as $resp )
                        {!! $resp->responsibility !!}
                    @endforeach
                </div>
                <div class="key-points">
                    <h2 class="title">Requirements</h2>
                    @foreach($job_id->requirements as $resp )
                        {!! $resp->requirement !!}
                    @endforeach
                </div>
            </div>

            <div class="apply-form-wrapper">
                {!!Form::open(['class' => 'form-horizontal','id'=>'applicantStore'])!!}
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-12 col-md-6">
                            <label for="fullName">Name</label>
                            <input type="text" class="form-control" id="fullName" name="fullname" placeholder="Full Name">
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Your Email">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-12 col-md-6">
                            <label for="fatherName">Father Name</label>
                            <input type="text" class="form-control" id="fatherName" name="fathername" placeholder="Father Name">
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label for="motherName">Mother Name</label>
                            <input type="text" class="form-control" id="motherName" name="mothername" placeholder="Mother Name">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-12 col-md-6">
                            <label for="contact">Mobile Number</label>
                            <input type="text" class="form-control" id="contact" name="contact" placeholder="Mobile Number">
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label for="nidNo">NID</label>
                            <input type="text" class="form-control" id="nidNo" name="nid" placeholder="NID Number">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-12 col-md-6">
                            <label for="dateOfBirth">Date of Birth</label>
                            <input type="date" class="form-control" id="dateOfBirth" name="dob">
                            <input type="hidden" class="form-control" value="{{$job_id->id}}" name="job_id">
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label for="religion">Religion</label>
                            <select id="religion" class="form-control" name="religion">
                                <option value="">Select...</option>
                                <option>Islam</option>
                                <option>Others</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <label for="religion">&nbsp; Educational Qualification</label>
                        <div class="form-group col-12 col-md-12">
                            <div class="table-responsive">

                                <table class="table" id="skill_table_edit">
                                    <thead>
                                        <tr>
                                            <th>Degree</th>
                                            <th>Group / Subject</th>
                                            <th>Institute</th>
                                            <th>Result</th>
                                            <th>Passing Year</th>
                                        </tr>
                                    </thead>
                                    <tbody id="skill_edit_tbody">
                                    </tbody>
                                </table>
                                <button type="button" class="btn btn-sm btn-icon-text" onclick="add_row_skill_edit();">
                                    <i class="fas fa-plus-square"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    {{--  --}}
                    <div class="form-row">
                        <label for="religion">&nbsp; Working Experience</label>
                        <div class="form-group col-12 col-md-12">
                            <div class="table-responsive">

                                <table class="table" id="working_table_edit">
                                    <thead>
                                        <tr>
                                            <th>Designation</th>
                                            <th>Company Name</th>
                                            <th>Joining Date</th>
                                            <th>End Date</th>
                                        </tr>
                                    </thead>
                                    <tbody id="skill_edit_tbody">
                                    </tbody>
                                </table>
                                <button type="button" class="btn btn-sm btn-icon-text" onclick="add_row_working_edit();">
                                    <i class="fas fa-plus-square"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    {{--  --}}

                    <div class="form-row">
                        <div class="form-group col-12 col-md-6">
                            <label for="uploadPicture">Upload Picture (300 x 300)</label>
                            <input type="file" class="form-control file-input" id="uploadPicture" accept="image/png, image/gif, image/jpeg"  name="image">
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label for="uploadCv">Upload Complete CV</label>
                            <input type="file" class="form-control file-input" id="uploadCv" accept="application/pdf" name="uploadcv">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-12 col-md-6">
                            <button type="submit" class="form-control sub-btn">save</button>
                            {{-- <button type="submit" class="form-control sub-btn" id="save_btn">save</button> --}}
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <button type="reset" class="form-control sub-btn">cancel</button>
                        </div>
                    </div>
                {!!Form::close()!!}
            </div>

            <!-- <div class="apply-info-wrapper">
                <div class="apply-info-inner">
                    <p>To apply, send your CV at</p>
                    <a href="mailto:info@jsssl.com">info@jsssl.com</a>
                </div>
            </div> -->
        </div>
    </section>
@endsection
@section('scripts')
    <script src="{{asset('frontend/assets/js/education.js')}}"></script>
    <script src="{{asset('frontend/assets/js/workingexp.js')}}"></script>
    <script>
        $(document).ready( function () {
            $("#applicantStore").validate({
                rules: {
                    fullname: {
                        required:true,
                        maxlength:80
                    },
                    email: {
                        required:true,

                    },
                    fathername: {
                        required:true,
                        maxlength:80

                    },
                    mothername: {
                        required:true,
                        maxlength:80

                    },

                    contact: {
                        required:true,
                        minlength:11,
                        maxlength:11
                    },
                    nid: {
                        required:true,
                    },
                    dob: {
                        required:true,
                    },
                    religion: {
                        required:true,
                    },
                    workingexp: {
                        required:true,
                    },
                    uploadcv: {
                        required:true,
                    },
                    image: {
                        required:true,
                    },
                    "degree[]":{
                        required:true
                    },
                    "gpsubject[]":{
                        required:true
                    },
                    "institute[]":{
                        required:true
                    },
                    "result[]":{
                        required:true
                    },
                    "passingyear[]":{
                        required:true
                    },
                    "designation[]":{
                        required:true
                    },
                    "company_name[]":{
                        required:true
                    },
                    "joining_date[]":{
                        required:true
                    },

                },
                errorPlacement: function(label, element) {
                    label.addClass('mt-2 text-danger');
                    label.insertAfter(element);
                },
            });

        });


        //save data
        $('#applicantStore').on('submit', function (e) {
            e.preventDefault();
            var $form = $(this);
            if(! $form.valid()) return false;
            $.ajax({
                url: "{{route('jobapplied.store')}}",
                method: "POST",
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                    console.log('save', response);
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
                            toastr.success('Your Information Inserted Successfully');
                            $('#applicantStore').trigger('reset');

                            $("#applicantStore").load(location.href + " #applicantStore>*", "");
                        }
                    }
                }

            });

        });
    </script>
@endsection
