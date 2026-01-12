<?php
require("./header.php");
?>
<div class="container">
    <div class="row justify-content-center">
        <form class="col-12 col-md-8" action="actionForm.php" method="post">
            <div class="row">
                <div class="input-field col-12 col-md-6">
                    <input id="username" name="username" type="text" class="validate" required="">
                    <label for="username">Имя</label>
                </div>
                <div class="input-field col-12 col-md-6">
                    <input id="lastname" name="lastname" type="text" class="validate" required="">
                    <label for="lastname">Фамилия</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col-12 col-md-6">
                    <input id="nameOrganization" name="nameOrganization" type="text" class="validate" required="">
                    <label for="nameOrganization">Название организации</label>
                </div>
                <div class="input-field col-12 col-md-6">
                    <input id="viewOrganization" name="viewOrganization" type="text" class="validate" required="">
                    <label for="viewOrganization">Вид организации</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col-12 col-md-6">
                    <input id="number" name="number" type="number" class="validate" required="">
                    <label for="number">Номер телефона</label>
                </div>
                <div class="input-field col-12 col-md-6">
                    <input id="email" name="email" type="email" class="validate" required="">
                    <label for="email">email</label>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-center">
                    <button class="btn waves-effect waves-light w-50 h-30" type="submit" name="action">Отправить</button>
                </div>
            </div>
        </form>
    </div>
</div>


