
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- ===== CSS ===== -->
        <link rel="stylesheet" href="<?=base_url("public/back/css/custom.css")?>">

        <!-- ===== BOX ICONS ===== -->
        <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

        <title>Yönetim Paneli</title>  

        <style>.text-danger{color:darkred;}
    
        .alert{
            margin-bottom: 32px;
            padding: 12px;
            border-radius: 5px;
        }
        .alert-danger{
            background-color: darkred;
            color: white;
        }
    </style>
    </head>
    <body>
        <div class="l-form">
            <div class="shape1"></div>
            <div class="shape2"></div>

            <div class="form">
                <img src="https://evie.undraw.co/images/undraw_designer.svg" alt="" class="form__img">

                <form action="<?=base_url("dashboard/login")?>" method="POST" class="form__content">
                    <?= csrf_field() ?>

                    <h1 class="form__title">Hoşgeldin</h1>
                    <?php if(!empty(session()->getFlashData('fail'))): ?>    
                        <div class="alert alert-danger"><?=session()->getFlashData('fail')?></div>
                    <?php endif ?>
                    <div class="form__div-one">
                        <div class="form__div <?=!empty(set_value('username','')) ? 'focus' : '' ?>">
                            <div class="form__icon">
                                <i class='bx bx-user-circle'></i>
                            </div>

                            <div class="form__div-input">
                                <label for="" class="form__label">Kulllanıcı adı veya mail adresiniz</label>
                                <input type="text" value="<?=set_value('username','demo@smurfweb.com')?>" name="username" class="form__input">
                            </div>
                        
                        </div>
                        <span class="text-danger"><?= ( isset($validation) ? display_error($validation,'username') : '')?></span>
                    </div>
                    
                    <div class="form__div-one">        
                        <div class="form__div">
                            <div class="form__icon">
                                <i class='bx bx-lock' ></i>
                            </div>

                            <div class="form__div-input">
                                <label for="" class="form__label">Şifre</label>
                                <input type="password" name="password" class="form__input" value="demo123">
                            </div>
                        </div>
                        <span class="text-danger"><?= ( isset($validation) ? display_error($validation,'password') : '')?></span>
                    </div>
                    <!--<a href="#" class="form__forgot">Şifremi Unuttum</a>-->

                    <input type="submit" class="form__button" value="Login">

                    <!--
                    <div class="form__social">
                        <span class="form__social-text">Our login with</span>

                        <a href="#" class="form__social-icon"><i class='bx bxl-facebook' ></i></a>
                        <a href="#" class="form__social-icon"><i class='bx bxl-google' ></i></a>
                        <a href="#" class="form__social-icon"><i class='bx bxl-instagram' ></i></a>
                    </div>

                    -->

                </form>
            </div>

        </div>

        <script src="<?=base_url('public/back/js/custom.js')?>"></script>
         
    </body>
</html>