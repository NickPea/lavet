

 @guest
 <div class="card shadow-lg rounded-lg">
     <div class="card-body">

         <form action="/login" method="POST">
            @csrf
             <div class="row">
                 <div class="form-group col">
                     <label class="sr-only" for="usernam">Username</label>
                     <input class="form-control form-control-lg" type="email" name="email" id="username">
                 </div>
             </div>
             <div class="row">
                 <div class="form-group col">
                     <label class="sr-only" for="possword">Password</label>
                     <input class="form-control form-control-lg" type="password" name="password" id="password">
                 </div>
             </div>
             <button type="submit" class="btn btn-primary btn-lg btn-block font-weight-bold">Log In</button>
         </form>
         <div class="row my-3">
             <div class="col d-flex justify-content-center">
                 <a href={{url('/forgottenpassword')}}>Forgotten password?</a>
             </div>
         </div>
         <div class="row">
             <div class="col d-flex justify-content-center align-items-center" style="border-top: 1px solid lightgrey; padding-top:20px">
                 <a href="/register" class="btn btn-success btn-lg font-weight-bold">Sign Up Today</a>
             </div>
         </div>


     </div><!-- //card-body -->
 </div><!-- //card -->
 @endguest

 @auth

 <div class="card shadow-lg rounded-lg">
    <div class="card-body">

    

            <h4>Welcome back</h4>
            <h2>{{Auth::user()->name}}</h2>


           
    </div><!-- //card-body -->
</div><!-- //card -->
     
 @endauth