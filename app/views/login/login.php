<section id="form">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form">
                    <h2>Login to your account</h2>
                    <form action="index.php?page=login" method="POST" form_type="login">
                        <input type="text" placeholder="Name" name="name" />
                        <input type="password" placeholder="Password" name="password" />
                        <input type="hidden" name="form_type" value="login">
                        <button type="submit" class="btn btn-default">Login</button>
                    </form>
                </div>
            </div>
            <div class="col-sm-1">
                <h2 class="or">OR</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form">
                    <h2>New User Signup!</h2>
                    <form action="index.php" method="POST" form_type="register">
                        <input type="text" placeholder="Name" name="name" required />
                        <input type="email" placeholder="Email Address" name="email" required />
                        <input type="password" placeholder="Password" name="password" required />
                        <input type="date" placeholder="Date of Birth" name="datenaissance" required />
                        <input type="text" placeholder="Phone Number" name="numtel" required />
                        <input type="text" placeholder="Adresse" name="adresse" required />
                        <input type="hidden" name="form_type" value="register">
                        <button type="submit" class="btn btn-default">Signup</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
