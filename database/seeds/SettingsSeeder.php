<?php

use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        setting()->set([
            'general.logo' => '',
            'general.website_name' => 'AISENT.NET',
            'general.tags' => '',
            'general.map_iframe_link'=>'',
            'general.address' => '',
            'general.phone_number' => '',
            'general.contact_email' => '',
            'general.facebook_page_link' => '',
            'general.twitter_page_link' => '',
            'general.whatsapp_number' => '',
            'general.linkedin_page_link' => '',
            'general.instagram_page_link' => '',
            'general.youTube_page_link' => '',
            'general.website_description'=>'',
            'general.facebook_pixel'=>'',
            'general.google_analytic'=>'',
            'general.button_color'=>'',
            'general.top_bar_background_color'=>'',
            'general.top_bar_visible'=>'1',
            'general.phone_number_visible'=>'1',
            'general.email_address_visible'=>'1',
            'general.top_bar_text_color'=>'',
            'general.top_border_color'=>'',
            'general.navbar_background_color'=>'',
            'general.navbar_text_color'=>'',
            'general.navbar_hover_color'=>'',
            'general.navbar_active_color'=>'',
            'general.footer_bottom_background_color'=>'',
            'general.footer_bottom_text_color'=>'',
            'general.footer_background_color'=>'',
            'general.footer_text_color'=>'',
            'general.footer_bottom_border_color'=>'',
            'theme.site'=>'theme7',


        ]);

        setting()->save();
    }
}
