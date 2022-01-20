<?php

class ModelExtensionModuleOptipic extends Model {

    public function changeContent($content) {

        if (class_exists('\optipic\cdn\ImgUrlConverter') == false) {
            require_once(DIR_SYSTEM . 'library/optipic/ImgUrlConverter.php');
        }

        $settings = $this->getSettings();

        if($settings['autoreplace_active'] && $settings['site_id']){
            \optipic\cdn\ImgUrlConverter::loadConfig($settings);
            $content = \optipic\cdn\ImgUrlConverter::convertHtml($content);
        }

        return $content;
    }

    function getSettings(){
        $autoreplaceActive = $this->config->get('module_optipic_autoreplace_active');
        $siteId = $this->config->get('module_optipic_site_id');
        $domains = $this->config->get('module_optipic_domains')!=''? explode("\n", $this->config->get('module_optipic_domains')):array();
        $exclusionsUrl = $this->config->get('module_optipic_exclusions_url')!=''?explode("\n", $this->config->get('module_optipic_exclusions_url')):array();
        $whitelistImgUrls = $this->config->get('module_optipic_whitelist_img_urls')!=''?explode("\n", $this->config->get('module_optipic_whitelist_img_urls')):array();
        $srcsetAttrs = $this->config->get('module_optipic_srcset_attrs')!=''?explode("\n", $this->config->get('module_optipic_srcset_attrs')):array();
        $cdnDomain = $this->config->get('module_optipic_cdn_domain');

        return array(
            'autoreplace_active' => $autoreplaceActive,
            'site_id' => $siteId,     // your SITE ID from CDN OptiPic controll panel
            'domains' => $domains, // list of domains should replace to cdn.optipic.io
            'exclusions_url' => $exclusionsUrl, // list of URL exclusions - where is URL should not converted
            'whitelist_img_urls' => $whitelistImgUrls, // whitelist of images URL - what should to be converted (parts or full urls start from '/')
            'srcset_attrs' => $srcsetAttrs, // tag's srcset attributes // @see https://developer.mozilla.org/en-US/docs/Learn/HTML/Multimedia_and_embedding/Responsive_images
            'cdn_domain' => $cdnDomain,
        );
    }
}