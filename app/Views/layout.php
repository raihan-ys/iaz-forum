<?php $session = session() ?>
<?php $router = service('router'); ?>
<?php $controller = $router->controllerName(); ?>
<?php $errors = $session->getFlashdata('errors'); ?>
<?php $success = $session->getFlashdata('success'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= $title ?> - Institut Az Zuhra</title>

    <meta charset="UTF-8">
    <meta name="description" content="Forum Institut Az Zuhra">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/jpg" href="<?= base_url('assets/images/iaz-logo.png') ?>">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('css/bootstrap.min.css') ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/fontawesome6/css/all.css') ?>">
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('css/styles.css') ?>">
    <!-- Custom CSS -->
    <style>
        body {
            <?php if($title === 'Login' || $title === 'Register') : ?>
                background-image: url(<?= base_url('assets/images/login-background.jpg') ?>);
                background-repeat: no-repeat;
                background-size: cover;
            <?php else : ?>
                <?php if($title !== 'Home') : ?>
                    background-color: #f4f4f4;
                <?php else : ?>
                    background-color: white;
                <?php endif ?>
            <?php endif ?>
        }
    
        /* font */
        @font-face {
            font-family: "Poppins";
            src: url("<?= base_url('fonts/poppins/poppins.woff2') ?>") format("truetype");
            font-weight: normal;
            font-style: normal;
        }
    </style>

    <!-- jQuery JS -->
	<script src="<?= base_url('js/jquery.min.js') ?>"></script>
    <!-- Bootstrap JS -->
    <script src="<?= base_url('js/bootstrap.min.js') ?>"></script>
</head>

<body class="d-flex flex-column min-vh-100"> 
    <header>
        <nav id="navbar">
            <ul>
                <!-- Left navbar items -->
                <!-- logo -->
                <li class="logo">
                    <a href="https://institutazzuhra.ac.id" target="_blank">
                        <img src="<?= base_url('assets/images/iaz-logo-white.jpg') ?>" alt="Institut Az Zuhra Logo" class="rounded img-fluid" style="height: 100px; width: 100px">
                    </a>
                </li>

                <!-- menu toogle -->
                <li class="menu-toggle"><button id="menuToggle">&#9776;</button></li>
                    
                <ul class="navbar-menu">
                    <!-- home -->
                    <li class="menu-item">
                        <a href="<?= base_url('home') ?>"><i class="fas fa-home"></i> Home</a>
                    </li>

                    <!-- thread -->
                    <li class="menu-item">
                        <a href="<?= base_url('thread') ?>"><i class="fas fa-comments"></i> Thread</a>
                    </li>

                    <!-- user management -->
                    <?php if($session->role === 'Admin') : ?>
                    <li class="menu-item">
                        <a href="<?= base_url('user') ?>"><i class="fas fa-user"></i> User</a>
                    </li>
                    <?php endif ?>

                    <!-- Right navbar items -->
                    <!-- user panel -->
                    <li class="user-panel" id="userPanel">
                        <!-- Logged in panel -->
                        <?php if($session->has('loggedIn')) : ?>
                        <a href="<?= base_url('user/view/'.$session->id) ?>">

                            <!-- avatar -->
                            <img src="<?= $session->has('avatar') ? base_url('uploads/avatar/'.$session->avatar) : base_url('assets/images/user-logo.jpeg') ?>" alt="<?= htmlspecialchars($session->username).'\s avatar' ?>" class="rounded-circle img-fluid" style="width: 100px; height: 100px">

                            <!-- username -->
                            <span>
                                <?php if(strlen($session->username) > 10) : ?>
                                <?= substr($session->username, 0, 10).'...' ?>
                                <?php else : ?>
                                <?= $session->username ?>
                                <?php endif ?>
                                <br>
                                <small>
                                    <i class="fas fa-envelope"></i>
                                    <?php if(strlen($session->email) > 10) : ?>
                                    <?= substr($session->email, 0, 10).'...' ?>
                                    <?php else : ?>
                                    <?= $session->email ?>
                                    <?php endif ?>
                                </small>
                            </span>
                        </a>

                        <!-- Guest panel -->
                        <?php else : ?>
                        <a href="<?= base_url(' login') ?>" title="Login">
                            <img src="<?= base_url('assets/images/user-logo.jpeg') ?>" alt="User's logo" class="rounded-circle img-fluid" style="max-width:100%; height: 100px">
                            <span>
                                Tamu<br>
                                <small>Silahkan login untuk akses lebih banyak fitur!</small>
                            </span>
                        </a>
                        <?php endif ?>
                    </li>

                    <!-- logout -->
                    <?php if($session->has('loggedIn')) : ?>
                    <li class="logout" id="logout">
                        <a href="<?= base_url('logout') ?>">
                            <i class="fas fa-power-off"></i> Logout
                        </a>
                    </li>
                    <?php endif ?>
                </ul>
            </ul>
        </nav>

        <!-- breadcrumb -->
        <?php if($title !== 'Login' && $title !== 'Register') : ?>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">

                <!-- home -->
                <li class="breadcrumb-item">
                    <a href="<?= base_url() ?>">
                        Forum Institut Az Zuhra
                    </a>
                </li>

                <!-- controller -->
                <li class="breadcrumb-item active">
                    <?= substr($controller, 17) ?>
                </li>

                <!-- title -->
                <?php if($title !== 'Home') : ?>
                <li class="breadcrumb-item active" aria-current="page"><?= $title ?></li>
                <?php endif ?>
            </ol>
        </nav>
        <?php endif ?>
    </header>

    <main class="container p-3 flex-grow-1">
        <!-- Show errors flashdata -->
        <?php if($errors !== null) : ?>
        <div class="alert-danger text-left">
            <span class="button-close" id="closeAlert">&times;</span>
            <strong>Terjadi Kesalahan <i class="fas fa-warning"></i></strong>
            <hr>
            <p>
                <?php foreach($errors as $error) : ?>
                <?= '- '.$error ?><br>
                <?php endforeach ?>
            </p>
            <?php $session->remove($errors) ?>
        </div>
        <?php endif ?>

        <!-- Show success flashdata. -->
        <?php if($success !== null) : ?>
        <div class="alert-success text-left">
            <span class="button-close" id="closeAlert">&times;</span>
            <strong><?= $success ?> <i class="fas fa-check"></i></strong>
            <?php $session->remove($success) ?>
        </div>
        <?php endif ?>

        <!-- main content -->
        <?= $this->renderSection('content') ?>
    </main>

    <footer class="footer p-2">
        <p class="text-white text-center mb-2">&copy; <?= date('Y') ?> Az Zuhra Group. All Rights Reserved.</p>

        <!-- Social media links -->
		<ul class="d-flex justify-content-center list-unstyled m-0">	
            <li>
                <a href="https://www.facebook.com/amik.atd.16" target="_blank">
                    <img src="<?= base_url('assets/images/facebook-logo.png') ?>" alt="facebook link">
                </a>
            </li>
            <li>
                <a href="https://www.instagram.com/institut.azzuhra/" target="_blank">
                    <img src="<?= base_url('assets/images/instagram-logo.png') ?>" alt="instagram link">
                </a>
            </li>
            <li>
                <a href="https://x.com/" target="_blank">
                    <img src="<?= base_url('assets/images/x-logo.png') ?>" alt="twitter link">
                </a>
            </li>
            <li>
                <a href="https://wa.me/6281990576161" target="_blank">
                    <img src="<?= base_url('assets/images/whatsapp-logo.png') ?>" alt="whatsapp link">
                </a>
            </li>
        </ul>
    </footer>
    
    <!-- jQuery slim JS-->
    <script type="text/javascript" src="<?= base_url('js/jquery.slim.min.js') ?>"></script>
    <!-- Popper JS -->
    <script type="text/javascript" src="<?= base_url('js/popper.min.js') ?>"></script>
    <!-- Custom JS -->
    <script type="text/javascript" src="<?= base_url('js/script.js') ?>"></script>
</body>
</html>
