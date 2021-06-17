<?php
class ControllerExtensionModuleOptipic extends Controller {

    //Сработает только 1 раз при установке
    public function install() {
        if (version_compare(VERSION, '3.0.0') >= 0) {
            $this->load->model('setting/event');
            $this->model_setting_event->addEvent('optipic', 'catalog/view/*/after', 'extension/module/optipic');
        }
        elseif (version_compare(VERSION, '2.0.0') >= 0) {
            $this->load->model('extension/event');
            $this->model_extension_event->addEvent('optipic', 'catalog/view/*/after', 'extension/module/optipic');
        }
        
        
    }

    //Сработает только 1 раз при удалении (удалит действие)
    public function uninstall() {
        if (version_compare(VERSION, '3.0.0') >= 0) {
            $this->load->model('setting/event');
            $this->model_setting_event->deleteEventByCode('optipic');
        }
        elseif (version_compare(VERSION, '2.0.0') >= 0) {
            $this->load->model('extension/event');
            $this->model_extension_event->deleteEventByCode('optipic');
        }
    }
    
    public function getUserToken() {
        $token = [];
        if(!empty($this->session->data['user_token'])) {
            $token = array(
                'key' => 'user_token',
                'value' => $this->session->data['user_token'],
            );
        }
        elseif(!empty($this->session->data['token'])) {
            $token = array(
                'key' => 'token',
                'value' => $this->session->data['token'],
            );
        }
        
        return $token;
    }
    
    public function getExtensionListRoute() {
        
        if (version_compare(VERSION, '3.0.0') >= 0) {
            return 'marketplace/extension';
        }
        elseif (version_compare(VERSION, '2.0.0') >= 0) {
            return 'extension/extension';
        }
    }

    public function index() {

        // Загружаем "модель" модуля
        $this->load->model('extension/module/optipic');
        
        $userToken = $this->getUserToken();
        

        // Сохранение настроек модуля, когда пользователь нажал "Записать"
        if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
            // Вызываем метод "модели" для сохранения настроек
            $this->model_extension_module_optipic->SaveSettings();
            // Выходим из настроек с выводом сообщения
            $this->session->data['success'] = 'OptiPic settings have been saved';
            $this->response->redirect($this->url->link($this->getExtensionListRoute(), $userToken['key'].'=' . $userToken['value'] . '&type=module', true));
        }

        // Загружаем настройки через метод "модели"
        $settings = $this->model_extension_module_optipic->LoadSettings();
        
        $data = array();
        $data['autoreplace_active'] = $settings['autoreplace_active'];
        $data['site_id'] = $settings['site_id'];
        $data['domains'] = $settings['domains'];
        $data['exclusions_url'] = $settings['exclusions_url'];
        $data['whitelist_img_urls'] = $settings['whitelist_img_urls'];
        $data['srcset_attrs'] = $settings['srcset_attrs'];
        
        $data['cdn_domain'] = $settings['cdn_domain'];
        if(empty($data['cdn_domain'])) {
            $data['cdn_domain'] = 'cdn.optipic.io';
        }
        
        // Загружаем языковой файл
        $data += $this->load->language('extension/module/optipic');
        // Загружаем "хлебные крошки"
        $data += $this->GetBreadCrumbs();

        // Кнопки действий
        $data['action'] = $this->url->link('extension/module/optipic', $userToken['key'].'=' . $userToken['value'], true);
        $data['cancel'] = $this->url->link($this->getExtensionListRoute(), $userToken['key'].'=' . $userToken['value'] . '&type=module', true);
        // Загрузка шаблонов для шапки, колонки слева и футера
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');
        
        $data['domain'] = $this->request->server['HTTP_HOST'];

        // Выводим в браузер шаблон
        $this->response->setOutput($this->load->view('extension/module/optipic', $data));

    }

    // Хлебные крошки
    private function GetBreadCrumbs() {
        $data = array(); $data['breadcrumbs'] = array();
        
        $userToken = $this->getUserToken();
        
        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', $userToken['key'].'=' . $userToken['value'], true)
        );
        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_extension'),
            'href' => $this->url->link($this->getExtensionListRoute(), $userToken['key'].'=' . $userToken['value'] . '&type=module', true)
        );
        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('extension/module/optipic', $userToken['key'].'=' . $userToken['value'], true)
        );
        return $data;
    }

}