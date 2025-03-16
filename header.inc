<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
?>
<header>
        <div id="navbar" class="obj-width">
            <a href="index.php"><img class="logo" src="images/logo.png" alt="Next_gen logo"></a>
            <!--responsive navbar-->
            <input type="checkbox" id="nav-toggle" class="nav-toggle" name="checkbox">
            <ul id="menu">
                <li><a class="navbar_button" href="jobs.php">Jobs</a></li>
                <li><a class="navbar_button" href="about.php">About</a></li>
                <li><a class="navbar_button" href="apply.php">Apply</a></li>
                <li><a class="navbar_button" href="contact.php">Contact</a></li>
                <li class="dropdown">
                    <a class="navbar_button dropbtn" href="#">Enhancements</a>
                    <div class="dropdown-content">
                        <a href="enhancements.php">Enhancement 1</a>
                        <a href="enhancements2.php">Enhancement 2</a>
                    </div>
                </li>
                <?php if(isset($_SESSION["user_id"])): ?>
                    <li><a id="w-btn" href="after_login.php"><i class='bx bx-user'></i></a></li>
                <?php else: ?>
                    <li><a id="w-btn" href="join.php">Join</a></li>
                <?php endif; ?>
            </ul>
            <label for="nav-toggle" class="nav-toggle-label">
                <i class='bx bx-menu'></i>
            </label>
        </div>
    </header>

    <style>
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #1f3e5d;
            min-width: 220px;
            box-shadow: 0px 8px 16px rgba(0,0,0,0.5);
            border-radius: 12px;
            z-index: 1000;
            margin-top: 10px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.68, -0.55, 0.27, 1.55);
            left: 50%;
            transform: translateX(-50%);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .dropdown-content a {
            color: #ffffff;
            padding: 14px 20px;
            text-decoration: none;
            display: block;
            font-size: 1.1rem;
            font-weight: 500;
            transition: all 0.3s ease;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
        }

        .dropdown-content a:last-child {
            border-bottom: none;
        }

        .dropdown-content a:hover {
            background-color: rgba(255, 255, 255, 0.15);
            color: #ffffff;
            transform: translateX(5px);
            box-shadow: inset 4px 0 0 white;
        }

        .dropdown .dropbtn {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .dropdown .dropbtn::after {
            display: inline-block;
            font-size: 0.7em;
            margin-left: 5px;
            transition: transform 0.4s ease;
        }

        .dropdown:hover .dropbtn::after {
            transform: rotate(180deg);
        }

        .dropdown:hover .dropdown-content {
            display: block;
            animation: dropdownFade 0.5s ease forwards;
        }

    @keyframes dropdownFade {
            from {
                opacity: 0;
                transform: translateX(-50%) translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateX(-50%) translateY(0);
            }
        }

        .dropdown:hover .dropbtn {
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
        }

    @media screen and (max-width: 775px) {
        .dropdown-content a {
            padding: 12px 30px;
            text-align: left;
            font-size: 1rem;
            background-color:rgb(255, 255, 255); 
        }
    
        .dropdown:hover .dropdown-content {
            animation: none;
            display: block;
        }
    
        .dropdown-content a:hover {
            background-color:rgb(218, 219, 221);
        }
    
        .dropdown {
            width: 100%;
            display: block;
        }
    
        .dropdown .dropbtn {
            width: 100%;
            justify-content: space-between;
            padding-right: 20px;
        }
    }
    </style>
