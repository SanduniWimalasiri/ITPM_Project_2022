<?php include('partials/menu.php');?>

        <!--Content Start-->
        <div class="main-content">
            <div class="wrapper">
                <h1>THIS IS THE HOME PAGE</h1>
            </div>

            <?php
                if(isset($_SESSION['order']))
                {
                    echo $_SESSION['order'];
                    unset($_SESSION['order']);
                }
            ?>
            <br><br><br><br><br><br><br><br><br><br><br>
            <br><br><br><br><br><br><br><br><br><br><br>
        </div>
        <!--Content End-->
        
<?php include('partials/footer.php');?>       