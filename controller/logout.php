<?php
include_once('config.php');

Auth::logout();
Utility::redirect(WELCOME_PAGE);