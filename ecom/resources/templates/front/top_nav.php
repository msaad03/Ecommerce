<div class="container colo">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">shipSHOPship</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                     <li>
                        <a href="cart.php">Cart</a>
                    </li>
                    <li>
                        <a href="contact.php">Contact</a>
                    </li>
                <!--     <li>
                        <a href="aboutus.php">About Us</a>
                    </li> -->

                </ul>

                    <?php

                       if(isset($_POST['search_btn']) && $_POST['search'] != ""){
                           search_product();
                       }

                    ?>

                <?php
                    if(!isset($_SESSION['name'])){ 
                ?>
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="login.php">LogIn</a>
                            </li>
                            <li>
                                <a href="signup.php">SignUp</a>
                            </li>
                        </ul>
                <?php
                    }
                    else{
                    ?>
                        <ul class="nav navbar-right top-nav">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" style="color: white; margin-top: 5px" data-toggle="dropdown">
                                    <i class="fa fa-user"></i>
                                    <?php echo " " . $_SESSION['name']; ?>
                                    <b class="caret"></b>
                                </a>
                            <ul class="dropdown-menu">
                            <li class="divider"></li>
                            <?php if(isset($_SESSION['user']) && $_SESSION['user'] == 1){ ?>

                        <li>
                            <a href="customer_portal.php"><i class="fa fa-fw fa-power-off"></i> My Portal</a>
                        </li>

                    <?php } ?>
                    
                    <?php if(isset($_SESSION['user']) && $_SESSION['user'] == 2){ ?>

                        <li>
                            <a href="shipper_portal.php"><i class="fa fa-fw fa-power-off"></i> My Portal</a>
                        </li>

                    <?php } ?>

                    <?php if(isset($_SESSION['user']) && $_SESSION['user'] == 3){ ?>

                        <li>
                            <a href="shop_portal.php"><i class="fa fa-fw fa-power-off"></i> My Portal</a>
                        </li>

                    <?php } ?>

                        <li>
                            <a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <?php
                    }

                ?>


                <ul class="nav navbar-right top-nav">


                    <li>
                        <form method="post">
                            <input type="text" style="margin-top: 10px; height: 30px; width: 200px; border-radius: 5px; border-color: red" placeholder=" Search Products..." name="search">&nbsp&nbsp
                            <input type="submit" class="btn btn-danger" name="search_btn" value="Search">&nbsp&nbsp
                        </form>
                    </li>

                </ul>


            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->