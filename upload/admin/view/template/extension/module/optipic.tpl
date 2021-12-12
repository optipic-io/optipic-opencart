<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">

            <!-- Кнопки управления -->
            <div class="pull-right">
                <button type="submit" form="form-module" data-toggle="tooltip" title="<?php echo $button_save ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
                <a href="<?php echo $cancel ?>" data-toggle="tooltip" title="<?php echo $button_cancel ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
            </div>

            <!-- Название модуля -->
            <h1><?php echo $heading_title ?></h1>

            <!-- Хлебные крошки -->
            <ul class="breadcrumb">
                <?php foreach($breadcrumbs as $breadcrumb):?>
                    <li><a href="<?php echo $breadcrumb['href'] ?>"><?php echo $breadcrumb['text'] ?></a></li>
                <?php endforeach; ?>
            </ul>

        </div>
    </div>

    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-pencil"></i><?php echo $text_edit ?></h3>
            </div>
            <div class="panel-body">
                <b><?php echo $text_description ?></b>

                <form action="<?php echo $action ?>" method="post" enctype="multipart/form-data" id="form-module" class="form-horizontal">
                    <!-- Настройка -->
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-autoreplace-active"><?php echo $entry_autoreplace_active ?></label>
                        <div class="col-sm-10">
                            <?php if ($autoreplace_active == 'Y'):?>
                                <input type="checkbox" id="input-autoreplace-active" name="module_optipic_autoreplace_active" value="Y" checked="checked">
                            <?php else: ?>
                                <input type="checkbox" id="input-autoreplace-active" name="module_optipic_autoreplace_active" value="Y">
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-site-id"><?php echo $entry_site_id ?></label>
                        <div class="col-sm-10">
                            <input type="text" id="input-site-id" name="module_optipic_site_id" value="<?php echo $site_id ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-domains"><?php echo $entry_domains ?></label>
                        <div class="col-sm-10">
                            <textarea id="input-domains" name="module_optipic_domains"  title="<?php echo $entry_domains_title ?>"><?php echo $domains ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-exclusions-url"><?php echo $entry_exclusions_url ?></label>
                        <div class="col-sm-10">
                            <textarea id="input-exclusions-url" name="module_optipic_exclusions_url" title="<?php echo $entry_exclusions_url_title ?>"><?php echo $exclusions_url ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-whitelist-img-urls"><?php echo $entry_whitelist_img_urls ?></label>
                        <div class="col-sm-10">
                            <textarea id="input-whitelist-img-urls" name="module_optipic_whitelist_img_urls" title="<?php echo $entry_whitelist_img_urls_title ?>"><?php echo $whitelist_img_urls ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-srcset-attrs"><?php echo $entry_srcset_attrs ?></label>
                        <div class="col-sm-10">
                            <textarea id="input-srcset-attrs" name="module_optipic_srcset_attrs" title="<?php echo $entry_srcset_attrs_title ?>"><?php echo $srcset_attrs ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-cdn-domain"><?php echo $entry_cdn_domain ?></label>
                        <div class="col-sm-10">
                            <input type="text" id="input-cdn-domain" name="module_optipic_cdn_domain" value="<?php echo $cdn_domain ?>">
                        </div>
                        <div class="col-sm-12 small" style="margin-top: 10px;">
                            <?php echo $entry_cdn_domain_description ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://optipic.io/api/cp/stat?domain=<?php echo $domain ?>&sid=<?php echo $site_id ?>&cms=opencart&stype=cdn&append_to=%23content+.container-fluid+.panel-body&version=1.25.0"></script> 
<?php echo $footer; ?>