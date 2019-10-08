<template>
    <div >
        <header class="header">
            <nav class="navbar navbar-toggleable-md navbar-light pt-0 pb-0 ">
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">НА САЙТ</span>
                </button>

                <div class="collapse navbar-collapse flex-row-reverse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li >
                            <button type="button" class="btn btn-warning"><router-link :to="{ name: 'main_home' }">На сайт</router-link></button>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="main">
            <div class="container">
                <div class="row ">
                    <div class="sidebar col-2" >
                        <div class="user-panel">
                        </div>
                        <ul class="list-sidebar bg-defoult">
                            <li> <a href="#" data-toggle="collapse" data-target="#dashboard" class="collapsed " > <i class="fa fa-th-large"></i> <span class="nav-label"> Контент </span> <span class="fa fa-chevron-left pull-right"></span> </a>
                                <ul class="sub-menu collapse" id="dashboard">
                                    <li><router-link :to="{ name: 'add_new' }">Новый пост</router-link></li>
                                    <li><router-link :to="{ name: 'posts' }">Список постов</router-link></li>
                                </ul>
                            </li>
                            <li> <a href="#" data-toggle="collapse" data-target="#products" class="collapsed active" > <i class="fa fa-bar-chart-o"></i> <span class="nav-label">Пользователи</span> <span class="fa fa-chevron-left pull-right"></span> </a>
                                <ul class="sub-menu collapse" id="products">
                                    <li><a href="#">#</a></li>
                                    <li><a href="#">#</a></li>
                                    <li><a href="#">#</a></li>
                                </ul>
                            </li>
                            <li> <a href="#"><i class="fa fa-files-o"></i> <span class="nav-label">#</span></a> </li>
                            <li> <a href="#"><i class="fa fa-files-o"></i> <span class="nav-label">#</span></a> </li>
                            <li> <a href="#"><i class="fa fa-files-o"></i> <span class="nav-label">#</span></a> </li>
                            <li> <a href="#"><i class="fa fa-files-o"></i> <span class="nav-label">#</span></a> </li>
                            <li> <a href="#"><i class="fa fa-files-o"></i> <span class="nav-label">#</span></a> </li>
                            <li> <a href="#"><i class="fa fa-files-o"></i> <span class="nav-label">#</span></a> </li>
                            <li> <a href="#"><i class="fa fa-files-o"></i> <span class="nav-label">#</span></a> </li>
                            <li> <a href="#"><i class="fa fa-files-o"></i> <span class="nav-label">#</span></a> </li>
                        </ul>
                    </div>
                    <div class="col-10 admin_content">
                        <router-view ></router-view>
                    </div>
                </div>
            </div>
        </div>
</div>

</template>

<script>

    // $(document).ready(function(){
    //     $('#dashboard').children('li').addClass("my_hide");
    //     $('.button-left').click(function(){
    //         $('.sidebar').toggleClass('fliph');
    //         $('.sidebar').removeClass('col-sm-3');
    //
    //         if($('.sidebar').hasClass('fliph')){
    //             $('.my_hide').attr('data-toggle', 'collapse');
    //             $('.my_hide').attr('data-target', '#dashboard');
    //         }else{
    //             $('.my_hide').removeAttr('data-toggle', 'collapse');
    //             $('.my_hide').removeAttr('data-target', '#dashboard');
    //         }


            //   $('#dashboard ').attr('data-toggle', 'collapse');
            // $('#my_toggle').attr('data-target', '#dashboard');
    //     });
    //
    // });
</script>

