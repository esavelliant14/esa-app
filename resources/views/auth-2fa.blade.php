<!doctype html>
<html lang="en">
    <script src="{{ url('/public/js/pages/sweet-alert.js') }}"></script>
    @include('_partials.head')

    <body>
        <div class="account-pages my-5 pt-sm-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card overflow-hidden">
                            <div class="bg-white">
                                <div class="row">
                                    <div class="col-3">


                                        <!--
                                        <div class="text-black p-4">
                                             <h5 class="text-black">Welcome Back !</h5> 
                                            <p>Sign in to SUPERAPPS.</p>
                                        </div>
                                        -->
                                        
                                    </div>
                                    <div class="justify-content-center col-0 p-4 align-self-end">
                                        <!--<img src="{{ url('public/img/hypernet-logo.png') }}" alt="" class="img-fluid"> -->
                                        <a class="text-dark text-center"><h3>{{ __(!$recovery ? 'TWO FACTOR AUTHENTICATION' : 'TWO FACTOR RECOVERY') }}</h3></a>
                                    </div>
                                    @if ($errors->any())
                                        <script>
                                            Swal.fire({
                                                title:"Login Failed!",
                                                html:"{{ session('failed') }}",
                                                icon: "error",
                                                timer:2e3,
                                                confirmButtonColor:"#34c38f",
                                                customClass: {
                                                    confirmButton: "rounded-pill",
                                                },
                                                onBeforeOpen:function(){
                                                    Swal.showLoading(),t=setInterval(function(){
                                                        Swal.getContent().querySelector("strong").textContent=Swal.getTimerLeft()
                                                    },
                                                    100)
                                                },
                                                onClose:function(){clearInterval(t)}
                                            })
                                        </script>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body pt-0"> 
                                <div class="auth-logo">
                                    
                                    <a href="index.html" class="auth-logo-light">
                                        <div class="avatar-md profile-user-wid mb-4">
                                            <span class="avatar-title rounded-circle bg-light">
                                                <img src="" alt="" class="rounded-circle" height="34">
                                            </span>
                                        </div>
                                    </a>
                                    <!--
                                    <a href="index.html" class="auth-logo-dark">
                                        <div class="avatar-md profile-user-wid mb-4">
                                            <span class="avatar-title rounded-circle bg-light">
                                                <img src="public/images/logo.svg" alt="" class="rounded-circle" height="34">
                                            </span>
                                        </div>
                                    </a>
                                    -->
                                </div>
                                <div class="p-2">
                                    <form class="form-horizontal" action="{{ route('two-factor.login') }}" method="post">
                                        @csrf
                                        @if (!$recovery)
                                        <div class="mb-3">
                                            <label for="code" class="form-label">Use Authentication Code</label>
                                            <input type="text" class="form-control" id="code" name="code" placeholder="Enter authentication code" required>
                                        </div>
                                        @else
                                        <div class="mb-3">
                                            <label for="recovery_code" class="form-label">Use Recovery Code</label>
                                            <input type="text" class="form-control" id="recover_code" name="recovery_code" placeholder="Enter recovery code" required>
                                        </div>
                                        @endif
                                        <div class="mt-1 ">
                                            <button class="btn waves-effect waves-light text-white" type="submit" style="background-color:#19daa0;">Login</button>
                                            <a class="btn btn-primary" href="{{ $recovery ? route('two-factor.login') : route('two-factor.login', ['recovery' => true]) }}">{{ __(!$recovery ? 'Use Recovery Code' : 'Use Authentication Code') }}</a>
                                        </div>
                                    </form>
                                </div>
            
                            </div>
                        </div>
                        <div class="mt-5 text-center">
                            
                            <div>
                                <p>© <script>document.write(new Date().getFullYear())</script> ESA <i class="mdi mdi-heart text-danger"></i></p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- end account-pages -->

        <!-- JAVASCRIPT -->
        <script src="public/libs/jquery/jquery.min.js"></script>
        <script src="public/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="public/libs/metismenu/metisMenu.min.js"></script>
        <script src="public/libs/simplebar/simplebar.min.js"></script>
        <script src="public/libs/node-waves/waves.min.js"></script>
        
        <!-- App js -->
        <script src="public/js/app.js"></script>
    </body>
</html>
