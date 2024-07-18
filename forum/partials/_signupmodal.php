<!-- Button trigger modal -->
<!--<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#signupModal">-->
<!--Launch demo modal-->
<!--</button>-->

<!-- Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="signupModalLabel">Signup for co-discuss</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="partials/_handlesignup.php" method="post">
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="signup_email" name="signup_email" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="s_password" name="s_password">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Conform Password</label>
                        <input type="password" class="form-control" id="s_cpassword" name="s_cpassword">
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Signup</button>

                </div>
                <!--<div class="modal-footer">-->
                <!--   <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>-->
                <!--   <button type="button" class="btn btn-primary">Save changes</button>-->
                <!--</div>-->
            </form>
        </div>
    </div>
</div>