@extends('layout.app')



@section('main')



<section class="section-5 bg-2">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Account Settings</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                @include('front.sidebar')
            </div>
            <div class="col-lg-9">
                @if(session()->has('success'))
                <p class="text-success text-light bg-success text-center">{{ session('success') }}</p>
                @endif





                <form action="{{route('account.update')}}" method="post" class="card border-0 shadow mb-4">
                    @csrf
                    <div class="card-body  p-4">
                        <h3 class="fs-4 mb-1">My Profile</h3>
                        <div class="mb-4">
                            <label for="" class="mb-2">Name*</label>
                            <input type="text" name="name" value="{{$user->name}}" placeholder="Enter Name" class="form-control" value="">

                            @error('name')
                            <p class="text-danger">{{$errors->first('name')}}</p>
                            @enderror

                        </div>
                        <div class="mb-4">
                            <label for="" class="mb-2">Email*</label>
                            <input type="text" name="email" value="{{$user->email}}" placeholder="Enter Email" class="form-control">
                            @error('email')
                            <p class="text-danger">{{$errors->first('email')}}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="" class="mb-2">Designation*</label>
                            <input type="text" name="designation" value="{{$user->designation}}" placeholder="Designation" class="form-control">
                            @error('designation')
                            <p class="text-danger">{{$errors->first('designation')}}</p>

                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="" class="mb-2">Mobile*</label>
                            <input type="text" name="mobile" value="{{$user->mobile}}" placeholder="Mobile" class="form-control">
                            @error('mobile')
                            <p class="text-danger">{{$errors->first('mobile')}}</p>

                            @enderror
                        </div>
                    </div>
                    <div class="card-footer  p-4">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>

                <div class="card border-0 shadow mb-4">
                    <div class="card-body p-4">
                        <h3 class="fs-4 mb-1">Change Password</h3>
                        <div class="mb-4">
                            <label for="" class="mb-2">Old Password*</label>
                            <input type="password" placeholder="Old Password" class="form-control">
                        </div>
                        <div class="mb-4">
                            <label for="" class="mb-2">New Password*</label>
                            <input type="password" placeholder="New Password" class="form-control">
                        </div>
                        <div class="mb-4">
                            <label for="" class="mb-2">Confirm Password*</label>
                            <input type="password" placeholder="Confirm Password" class="form-control">
                        </div>
                    </div>
                    <div class="card-footer  p-4">
                        <button type="button" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title pb-0" id="exampleModalLabel">Change Profile Picture</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="imgform" name="imgform"  method="post" enctype="multipart/form-data">
@csrf
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Profile Image</label>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary mx-3">Update</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection


@section('customjs')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
    });

    $("#imgform").submit(function(e){
        e.preventDefault();


        const data =new FormData(this)
        $.ajax({
            url: "{{route('account.updateimg')}}",
            type: "post",
            data: data,
            contentType: false,
            processData: false,
            success: (response) => {
                console.log(response)
            },
            error: (err) => {
                console.log(err);
            }
        })

    })
</script>


@endsection