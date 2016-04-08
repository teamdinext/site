<?php
session_start();
if(!empty($_SESSION["tid"]))
    {
?>

<div class="container head-em">
    <div style="float:right; color: #ffffff; margin-right: 1em;">
        Hello, <?= $_SESSION['firstName']?>
    </div>
</div>
<?php
    }
?>

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
