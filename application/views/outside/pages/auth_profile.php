<div class="user_container p10">
    <div class="center">
        <h3>[<?=$user->id;?>] <?=$user->username;?> (<?=$user->email;?>)
            <a title="LogOut" class="glyphicon glyphicon-new-window" href="/auth/logout"></a>
            <?php if ($this->ion_auth->is_admin()) { ?>
                <a title="Inside" class="glyphicon glyphicon-th-list" href="/inside"></a>
            <?php } ?>
        </h3>

    </div>
    <div class="row">

        <form action="/auth_api/edit_info/" method="post" id="update_info_form" class="style_form form-inline" enctype="multipart/form-data">

        <div class="col-xs-12 col-sm-6 col-md-4" id="user_info">

            <div>
                <b>NickName</b>
                <br/>
                <input class="wbgs0 p10 form-control" type="text" id="name" name="username" value="<?=$user->username?>" />
            </div>
            <div class="top10">
                <b>Company</b>
                <br/>
                <input class="wbgs0 p10 form-control" type="text" id="cname"  name="company"  value="<?=$user->company;?>">
            </div>

            <div class="top10">
                <b>Телефон</b>
                <br/>
                <input class="wbgs0 p10 form-control" type="text" id="social_vk"  name="phone"  value="<?=$user->phone;?>">
            </div>

            <div class="top10">
                <b>Доп. инфо</b>
                <br/>
                <input class="wbgs0 p10 form-control" type="text" id="adv_info"  name="adv_info"  value="<?=$user->adv_info;?>">
            </div>

            <br/><br/>

        </div>


        <div class="col-xs-12 col-sm-6 col-md-4 finance_part">

            <div class="clearfix center">
            <?php if ($user->img != '') { ?>

                <img src="/files/uploads/users_img/<?=$user->img?>" class="img_shadow" alt="User Image" style="width:60%; margin-bottom: 7px;" />
                <br/>
                <div class="checkbox checkbox_dell_img">
                    <label>
                        <input type="checkbox"  id="del_image"  name="del_image"  value="<?=$user->img?>">
                        <a>Отметка на удаление</a>
                    </label>
                </div>

            <?php } else { ?>
                <b class="form-control-static"><nobr>Аватар</nobr></b>
                <br/>
                <input id="file_select" class="form-control" type="file" name="image">
                <input id="img_code" name="img_code" type="hidden" />
                <img id="show_img" style="width:100%; margin-top:10px;" />
            <?php } ?>
            </div>
            <div class="clearfix"></div>

            <div class="center">


            <a class="btn mbtn1 btn-success update_info top10">Сохранить</a>
            <div class="uinfo_msg message"></div>

                <a class="btn mbtn1 wbgs1 btn-sm top10" onclick="$(this).next().toggle();" >Смена пароля и Email</a>
                <div id="user_pass" class="user_pass" style="display: none;">

                    <form method="post" id="ch_pass_form" class="style_form form-inline">

                        <br />


                        <b class="add-on form-control-static">Ваш пароль</b>
                        <br />
                        <input class="wbgs0 p10 form-control" type="text" id="old_password"  name="old_password">



                        <b class="add-on form-control-static">Новый пароль</b>
                        <br />
                        <input class="wbgs0 p10 form-control" type="text" id="new_password"  name="new_password">


                        <b class="add-on form-control-static">Повторить пароль</b>
                        <br />
                        <input class="wbgs0 p10 form-control"  type="text" id="confirm_password"  name="confirm_password">

                        <b class="add-on form-control-static">Email</b>
                        <br />
                        <input class="wbgs0 p10 form-control"  type="text" id="email"  name="email" value="<?=$user->email;?>">

                        <br/>
                        <div class="ch_pass_msg message"></div>
                        <br/>
                        <div class="clearfix"></div>
                        <a class="btn btn-primary change_pass fright">Обновить</a>
                        <div class="clearfix"></div>
                        <br/><br/>
                    </form>
                </div>

                <br/><br/>
            </div>

        </div>



        </form>
        <div class="finance_part_holder">
            <div class="col-xs-12 col-sm-6 col-md-4 finance_part">

                <div class="alert alert-success bottom10">

                    <b>Балланс:</b> <b>0$</b>
                </div>

                <div class="top10">
                    <b>Пополнить [$]</b><br/>
                    <input type="text" name="amount" value="50" class="wbgs0 p10 amount add_money form-control" />
                    <a class="btn send_money btn-primary pay_online top10">Оплатить онлайн</a>
                </div>

                <a class="btn wbgs1 p10 btn-sm send_cashout top10">Вывести деньги</a>
                <a class="btn wbgs1 p10 btn-sm top10" onclick="$(this).next().toggle();">Мои операции</a>
                <br/>

            </div>
        </div>
				

    </div>
</div>