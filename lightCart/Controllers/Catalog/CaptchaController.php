<?php
class CaptchaController
{
    public function actionCaptcha()
    {
        Captcha::getCaptcha();
        return true;
    }
}