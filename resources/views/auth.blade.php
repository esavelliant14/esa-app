<!doctype html>
<html lang="en">
    <script src="{{ url('/public/js/pages/sweet-alert.js') }}"></script>
    <script src="https://www.google.com/recaptcha/api.js"></script>
    @include('_partials.head')

    <body>
        <div class="account-pages my-5 pt-sm-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card overflow-hidden">
                            <div class="bg-white">
                                <div class="row justify-content-center">
                                    <div class="col-12 text-center p-4 mb-2">
                                        <img src="{{ url('public/img/hypernet-big.png') }}" alt="" class="img-fluid mx-auto" style="width: 400px; max-width:100%;">
                                        {{-- <a class="text-dark text-center"><h1>INI LOGOKU YA</h1></a> --}}
                                    </div>
                                    {{-- @if ($errors->any()) --}}
                                    @if(session()->has('error'))
                                        <script>
                                            Swal.fire({
                                                title:"Login Failed!",
                                                html:"",
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
                                    @elseif ($errors->first('g-recaptcha-response') == 'Gagal')
                                        <script>
                                            Swal.fire({
                                                title:"Login Failed!",
                                                html:"",
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
                                    
                                    <form class="form-horizontal" action="{{ route('login') }}" method="post" id="login-form">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter email" required>
                                            
                                        </div>
                
                                        <div class="mb-3">
                                            <label class="form-label">Password</label>
                                            <div class="input-group auth-pass-inputgroup">
                                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter password" aria-label="Password" aria-describedby="password-addon" required>
                                                <button class="btn btn-light " type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                                
                                            </div>
                                        </div>
                                       
                                        
                                        <div class="mt-1 d-grid">
                                            <button class="btn waves-effect waves-light text-white g-recaptcha" 
                                                data-sitekey="{{ $g_key }}" data-callback='onSubmit' data-action='submit' 
                                                type="submit" style="background-color:#19daa0;">Login
                                            </button>
                                        </div>
                                        <!--
                                        <div class="mt-4 text-center">
                                            <h5 class="font-size-14 mb-3">Sign in with</h5>
            
                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    <a href="javascript::void()" class="social-list-item bg-primary text-white border-primary">
                                                        <i class="mdi mdi-facebook"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="javascript::void()" class="social-list-item bg-info text-white border-info">
                                                        <i class="mdi mdi-twitter"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="javascript::void()" class="social-list-item bg-danger text-white border-danger">
                                                        <i class="mdi mdi-google"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        -->
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
        <script>
            function onSubmit(token) {
              document.getElementById("login-form").submit();
            }
          </script>
    </body>
</html>
