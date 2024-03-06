@extends('layout.app')

@section('main')
<section class="section-5">
    
    <div class="container my-5">
        <div class="py-lg-2">&nbsp;</div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-5">
                <div class="card shadow border-0 p-5">
                    <h1 class="h3">Register</h1>
                    <form id="registersubmit">
                        <div class="mb-3">
                            <label for="" class="mb-2">Name*</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name">
                            <p></p>
                        </div>
                        <div class="mb-3">
                            <label for="" class="mb-2">Email*</label>
                            <input type="text" name="email" id="email" class="form-control" placeholder="Enter Email">
                            <p></p>
                        </div>
                        <div class="mb-3">
                            <label for="" class="mb-2">Password*</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Enter Password">
                            <p></p>

                        </div>
                        <div class="mb-3">
                            <label for="" class="mb-2">Confirm Password*</label>
                            <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Enter Password">
                        </div>
                        <button class="btn btn-primary mt-2" type="submit">Register</button>
                    </form>
                </div>
                <div class="mt-4 text-center">
                    <p>Have an account? <a href="login.html">Login</a></p>
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
                <form>
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
    const registersubmit = document.getElementById('registersubmit')
    $("#registersubmit").submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: "{{route('account.registerprocess')}}",
            data: $('#registersubmit').serializeArray(),
            success: (response) => {
                var errors = response.errors ||{};
                if (response.status === false) {
                    if (errors.name) {
                        $('#name').addClass('is-invalid').siblings('p').html(errors.name).addClass('text-danger');
                    }
                    if (errors.email) {
                        $('#email').addClass('is-invalid').siblings('p').html(errors.email).addClass('text-danger')
                    }
                    if (errors.password) {
                        $('#password').addClass('is-invalid').siblings('p').html(errors.password).addClass("text-danger");
                    }
                } else {
                    if (errors.name) {
                        $('#name').removeClass('is-invalid').siblings('p').html('').removeClass('text-danger')
                    }
                    if (errors.email) {
                        $('#email').removeClass('is-invalid').siblings('p').html('').removeClass('text-danger')
                    }
                    if (errors.password) {
                        $('#password').removeClass('is-invalid').siblings('p').html('').removeClass('text-danger')
                    }
                }
                console.log(response)
                if(response.status){
                    window.location.replace("{{route('account.login')}}")
                }
            },
            error:(err)=>{
                console.log(err);

            }

        })
    })
</script>
@endsection