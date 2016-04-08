<?php
    session_start();
    if(!empty($_SESSION["tid"]))
    {
        header("Location: classlist/");

    }
    else
    {
?>
    <!DOCTYPE html>
    <html ng-app="login">

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>D&amp;D Login</title>
        <?php require('resources/config/head.php'); ?>
        <script type="text/javascript" src="app.js"></script>
        <style>
            .register-only {
                display: none;
            }
        </style>

        <link rel="icon" type="image/png" href="resources/images/Dragon-Logo.png">

    </head>

    <body>
        <div class="container head-em">

        </div>

        <div class="container head-em">
            <div class="row nav">
                <ul class="nav">
                    <li class="nav active">
                        <a href="/is410/">Home</a>
                    </li>
                    <li class="nav">
                        <a href="/is410/about/">About Us</a>
                    </li>
                    <li class="nav logo">
                        <a href="/is410/"><img src="/is410/resources/images/Dragon-logo2.png" alt=""></a>
                    </li>
                    <li class="nav">
                        <a href="/is410/help/">Help</a>
                    </li>
                    <li class="nav">
                        <a href="/is410/logout/">Log Out</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="container">
            <div class="row">
                  <div class="logo-sm">
                    <a href="/is410/"><img src="/is410/resources/images/Dragon-logo2.png" alt=""></a>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="content row" ng-controller="loginController as page">

                <div class="eight columns center-column">

                    <div class="row header">
                        <h1> <span id="pageFunction"> Sign Up </span> </h1>
                        <h3> Discussions and Dragons is free and always will be! </h3>
                    </div>
                    <div class="row">

                        <div class="eight columns center-column">
                            <div class="">
                                <div class="inputs row" align="center">

                                  <form action="{{page.action}}" 
                                        method="POST" 
                                        enctype="multipart/form-data">
                                      <div class="row">
                                        <label class="points">
                                          Username:
                                        </label>
                                        <input type="text" 
                                               name="username" 
                                               required 
                                               autofocus>
                                      </div>
                                      <div class="row">
                                        <label class="points">
                                          Password:
                                        </label>
                                        <input ng-model="page.pass" 
                                               type="password"
                                               name="password" 
                                               required>
                                      </div>
                                      <div class="row" ng-hide="page.login">
                                        <label class="points">
                                          Confirm Password:
                                        </label>
                                        <input ng-model="page.passVerify" 
                                               type="password" 
                                               name="passwordConfirm" 
                                               ng-required="!page.login" 
                                               ng-blur="page.verify()">
                                      </div>
                                      <div class="row" ng-hide="page.login">
                                        <label class="u-pull-right" 
                                               ng-hide="page.verify()" 
                                               style="font-weight: normal; color: red" 
                                               name="confirmtext">
                                           Please ensure that <br/> your passwords match.
                                        </label>
                                      </div>
                                      <div class="row" ng-hide="page.login">
                                        <label class="points">First Name:</label>
                                        <input type="text" 
                                               name="fName" 
                                               ng-required="!page.login">
                                      </div>
                                      <div class="row" ng-hide="page.login">
                                        <label class="points">Last Name:</label>
                                        <input type="text" 
                                               name="lName" 
                                               ng-required="!page.login">
                                      </div>
                                      <div class="row" ng-hide="page.login">
                                        <label class="points">Email:</label>
                                        <input type="text" 
                                               name="email" 
                                               ng-required="!page.login">
                                      </div>
                                      <div class="row">
                                        <input class="center login-only" 
                                               id="loginButton" 
                                               type="submit" 
                                               value="{{page.submitText}}">
                                      </div>
                                      <?php if($_GET['loginError'] == true) 
                                      { ?>
                                        <div class="row">
                                          <label class="u-pull-right" style="font-weight: normal; color: red">
                                            Your username and password combination are invalid.
                                          </label>
                                      </div>
                                      <?php } ?>
                                      <div class="row">
                                          <a class="toggle-registration" 
                                             id="toggleRegistration" 
                                             ng-click="page.toggleRegister()">
                                            {{page.toggleText}}
                                          </a>
                                      </div>

                                      <input type="hidden"
                                             name="formType" 
                                             value="register">

                                  </form>
                              </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="footer" class="footer row">
            <span>&copy; 2016 <a href="index.html">Discussions and Dragons.</a> All rights reserved.</span>
        </div>
    </body>

    </html>
    <?php
    }
?>
