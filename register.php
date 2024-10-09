<?php
include('includes/config.php');
if(isset($_POST['submit']))
{

    $file = $_FILES['image']['name'];
    $file_loc = $_FILES['image']['tmp_name'];
    $folder="images/";
    $new_file_name = strtolower($file);
    $final_file=str_replace(' ','-',$new_file_name);

    $name=$_POST['name'];
    $email=$_POST['email'];
    $password=md5($_POST['password']);
    $gender=$_POST['gender'];
    $mobileno=$_POST['mobileno'];
    $designation=$_POST['designation'];

    if(move_uploaded_file($file_loc,$folder.$final_file))
    {
        $image=$final_file;
    }
    $notitype='Create Account';
    $reciver='Admin';
    $sender=$email;

    $sqlnoti="insert into notification (notiuser,notireciver,notitype) values (:notiuser,:notireciver,:notitype)";
    $querynoti = $dbh->prepare($sqlnoti);
    $querynoti-> bindParam(':notiuser', $sender, PDO::PARAM_STR);
    $querynoti-> bindParam(':notireciver',$reciver, PDO::PARAM_STR);
    $querynoti-> bindParam(':notitype', $notitype, PDO::PARAM_STR);
    $querynoti->execute();

    $sql ="INSERT INTO users(name,email, password, gender, mobile, designation, image, status) VALUES(:name, :email, :password, :gender, :mobileno, :designation, :image, 1)";
    $query= $dbh -> prepare($sql);
    $query-> bindParam(':name', $name, PDO::PARAM_STR);
    $query-> bindParam(':email', $email, PDO::PARAM_STR);
    $query-> bindParam(':password', $password, PDO::PARAM_STR);
    $query-> bindParam(':gender', $gender, PDO::PARAM_STR);
    $query-> bindParam(':mobileno', $mobileno, PDO::PARAM_STR);
    $query-> bindParam(':designation', $designation, PDO::PARAM_STR);
    $query-> bindParam(':image', $image, PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if($lastInsertId)
    {
        echo "<script type='text/javascript'>alert('Registration Sucessfull!');</script>";
        echo "<script type='text/javascript'> document.location = 'login.php'; </script>";
    }
    else
    {
        $error="Something went wrong. Please try again";
    }

}
?>
<?php require_once("header.php")?>

    <!-- Normal Breadcrumb Begin -->
    <section class="normal-breadcrumb set-bg" data-setbg="img/normal-breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="normal__breadcrumb__text">
                        <h2>Sign Up</h2>
                        <p>Welcome to the official Anime blog.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Normal Breadcrumb End -->
<script type="text/javascript">

    function validate()
    {
        var extensions = new Array("jpg","jpeg");
        var image_file = document.regform.image.value;
        var image_length = document.regform.image.value.length;
        var pos = image_file.lastIndexOf('.') + 1;
        var ext = image_file.substring(pos, image_length);
        var final_ext = ext.toLowerCase();
        for (i = 0; i < extensions.length; i++)
        {
            if(extensions[i] == final_ext)
            {
                return true;

            }
        }
        alert("Image Extension Not Valid (Use Jpg,jpeg)");
        return false;
    }

</script>
    <!-- Signup Section Begin -->
    <section class="signup spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="login__form">
                        <h3>Sign Up</h3>
                        <form method="post" class="form-horizontal" enctype="multipart/form-data" name="regform" onSubmit="return validate();">
                            <div class="input__item">
                                <input type="text" name="name" placeholder="Your Name" required>
                                <span class="icon_profile"></span>
                            </div>
                            <div class="input__item">
                                <input type="text" name="email" placeholder="Email address" required>
                                <span class="icon_mail"></span>
                            </div>
                            <div class="input__item">
                                <input type="password" placeholder="Password" name="password" id="password" required>
                                <span class="icon_lock"></span>
                            </div>
                            <div class="input__item">
                                <input type="text" placeholder="Designation" name="designation" required>
                                <span class="icon_lock"></span>
                            </div>
                            <div class="input__item">
                                <input type="number" placeholder="Phone" name="mobileno" required>
                                <span class="icon_lock"></span>
                            </div>
                            <div class="form-group">
                                <input type="file" name="image" required>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-1 control-label">Gender<span style="color:red">*</span></label>
                                <div class="col-sm-5">
                                    <select name="gender" class="form-control" required>
                                        <option value="">Select</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" name="submit" class="site-btn">Register</button>
                        </form>
                        <h5>Already have an account? <a href="login.php">Log In!</a></h5>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="login__social__links">
                        <h3>Login With:</h3>
                        <ul>
                            <li><a href="#" class="facebook"><i class="fa fa-facebook"></i> Sign in With Facebook</a>
                            </li>
                            <li><a href="#" class="google"><i class="fa fa-google"></i> Sign in With Google</a></li>
                            <li><a href="#" class="twitter"><i class="fa fa-twitter"></i> Sign in With Twitter</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Signup Section End -->
<?php require_once ("footer.php") ?>