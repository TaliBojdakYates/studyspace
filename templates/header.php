<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

<nav class="navbar navbar-expand-md" style="background-color:#cc0000;">
    <div class=" mr-auto p-3 order-0 ">
       <a class="navbar-brand display-1 ml-3" href="https://www.iit.edu/" style="color:white;">
          <img class="d-none d-sm-inline-block"src="images/logo.png" alt="" class="">
          Illinois Institute of Technology
      </a>
    </div>
    <div class="mx-auto ">
        <a class="navbar-brand mx-auto" style="color:white; font-weight: bold;" href="http://localhost/studyspace/index.php">Home</a>
    </div>
    <div class="ms-auto p-3">
       <a style="text-decoration: none; color:white;"  type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Login
</a>
        <a class="btn btn-light rounded-pill"  href="">Sign Up</a>
    </div>
</nav>


<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" data-backdrop="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="margin:0 auto;">
     
        <h1 class="modal-title fs-5 " id="exampleModalLabel">Login</h1>
        <!-- <button type="button" style="position: relative;right: 5px !important; "class="btn-close ms-auto"data-bs-dismiss="modal" aria-label="Close"></button> -->
      </div>
      <div class="modal-body">
         <form id=signUp>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control border border-primary" id="email"aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control border border-primary" id="password">
            </div>
            <p class="small"><a class="text-primary" href="forget-password.html">Forgot password?</a></p>
            <div class="d-grid">
                <button type="button" id='quit'class="d-none" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary" onclick="login()" id="loginSubmit">Login</button>
            </div>
        </form>
        <div class="mt-3">
            <p class="mb-0  text-center">Don't have an account? <a href="signup.html"
                    class="text-primary fw-bold">Sign
                    Up</a></p>
        </div>
      </div>
     
    </div>
  </div>
</div>

<script >
    

    function login() {
        var password = document.getElementById("password").value;
        var email = document.getElementById('email').value;
        
        const emailCheck = email.split('@');

       
        if((emailCheck[1] == 'hawk.iit.edu') || (emailCheck[1] =='iit.edu')){
            document.getElementById("signUp").submit();
    
            document.getElementById("quit").click();
       
        }else{
            alert('err0r');
        }
       
    }


    

</script>



