<?php
class FormExchangeController
{

    public function getFormExchange()
    {
        $language = Registry::get('language')->getLanguage('formExchange');

        $dataPage['text_title_form']    = $language['text_title_form'];
        $dataPage['text_email']         = $language['text_email'];
        $dataPage['text_personal_data'] = $language['text_personal_data'];
        $dataPage['text_number_wallet'] = $language['text_number_wallet'];
        $dataPage['text_number_card']   = $language['text_number_card'];
        $dataPage['text_button']        = $language['text_button'];

        $dataPage['text_placeholder_email'] = $language['text_placeholder_email'];
        $dataPage['text_placeholder_card']  = $language['text_placeholder_card'];

        $dataPage['text_donоt_remember'] = $language['text_donоt_remember'];

        

        require_once(Template::get('form_exchange'));
    }
}
