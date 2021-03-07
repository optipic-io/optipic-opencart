<?php
class ModelExtensionModuleOptipic extends Model {

    // Запись настроек в базу данных
    public function SaveSettings() {
        $this->load->model('setting/setting');
        
        $settingsData = $this->request->post;
        $settingsData['module_optipic_status'] = $settingsData['module_optipic_autoreplace_active'];
        
        $this->model_setting_setting->editSetting('module_optipic', $settingsData);
    }

    // Загрузка настроек из базы данных
    public function LoadSettings() {
        $settings = array();
        $settings['autoreplace_active'] = $this->config->get('module_optipic_autoreplace_active');
        $settings['site_id'] = $this->config->get('module_optipic_site_id');
        $settings['domains'] = $this->config->get('module_optipic_domains');
        $settings['exclusions_url'] = $this->config->get('module_optipic_exclusions_url');
        $settings['whitelist_img_urls'] = $this->config->get('module_optipic_whitelist_img_urls');
        $settings['srcset_attrs'] = $this->config->get('module_optipic_srcset_attrs');
        return $settings;
    }

}