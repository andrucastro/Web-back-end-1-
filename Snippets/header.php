
    <div class="logo_container_top">
        <img src="/phpmotors/images/site/logo.png" alt="PHP motors logo"> 
        <?php
        if (isset($_SESSION['loggedin'])) {
            $welcomeName = $_SESSION['clientData']['clientFirstname'];
            echo "<span><a href='/phpmotors/accounts/'> Welcome $welcomeName</a></span>";
        }

        if (!isset($_SESSION['loggedin'])){
            echo "<span><a href='/phpmotors/accounts/?action=login'>My account</a></span>";
           }
        else{

            echo "<span><a href='/phpmotors/accounts/?action=Logout'>Logout</a></span>";
        }

        ?>
    </div>
    