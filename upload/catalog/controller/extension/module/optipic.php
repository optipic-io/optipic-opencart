<?php
class ControllerExtensionModuleOptipic extends Controller {
    public function index(&$route, &$data, &$output) {

        // Загружаем "модель"
        $this->load->model('extension/module/optipic');

        $output = $this->model_extension_module_optipic->changeContent($output);

    }
}