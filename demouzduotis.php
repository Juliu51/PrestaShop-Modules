<?php

if (!defined('_PS_VERSION_')) {
    exit;
}

class demouzduotis extends Module
{
    
    public function __construct()
    {
        // Settings
        $this->name = 'demouzduotis';
        $this->tab = 'front_office_features';
        $this->version = '2.0.1';
        $this->author = 'PrestaShop';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = [
            'min' => '1.7.6.0',
            'max' => _PS_VERSION_,
        ];
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Modules for demo uzduotis');
        $this->description = $this->l('demo uzduotis testas');
        $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
        // Configuration
        if (!Configuration::get('MYMODULE_NAME')) {
            $this->warning = $this->l('No name provided');
        }

    }
/**
     * Module install
*/
    public function install()
    {

        if (Shop::isFeatureActive()) {
            Shop::setContext(Shop::CONTEXT_ALL);
        }
        // SQL install
        return $this->sqlinstall() &&
        $this->installtab() &&
         // Hooks
        parent::install() &&
        $this->registerHook('leftColumn') &&
        $this->registerHook('footer') &&
        // Configuration
        Configuration::updateValue('MYMODULE_NAME', 'my friend');

    }
/**
     * Database install
*/
    protected function sqlinstall()
    {
        // SQL
        $sqlCreate = "CREATE TABLE IF NOT EXISTS `" . _DB_PREFIX_ . "klientai`(
            `id` INT(11) unsigned NOT NULL AUTO_INCREMENT,
            `kliento_vardas` VARCHAR(256) NOT NULL,
            `kliento_pavarde` VARCHAR(256) NOT NULL,
            `kliento_el` VARCHAR(256) NOT NULL,
            PRIMARY KEY (`id`))";

        return Db::getInstance()->Execute($sqlCreate);
    }
    /**
     * Module uninstall
*/
    public function uninstall()
    {
         //Uninstall module
        return parent::uninstall() &&
        // Configuration
        Configuration::deleteByName('MYMODULE_NAME')
        && $this->sqlUninstall() && $this->uninstalltab();
    }
/**
     * Database uninstall
*/
    protected function sqlUninstall()
    {
        $sql = "DROP TABLE " . _DB_PREFIX_ . "klientai";
        return Db::getInstance()->execute($sql);
    }
  /**
     * Footer hook papildoma uzduotis 1,
     * Papildomas CSS/ JS stylesheetai
*/
    public function hookdisplayFooter($params)
    {
        if ('product' === $this->context->controller->php_self) {
            $this->context->controller->registerStylesheet(
                'module-modulename-style',
                'modules/'.$this->name.'/assets/css/modulename.css',
                [
                  'media' => 'all',
                  'priority' => 200,
                ]
            );
    
            $this->context->controller->registerJavascript(
                'module-modulename-simple-lib',
                'modules/'.$this->name.'/js/lib/simple-lib.js',
                [
                  'priority' => 200,
                  'attribute' => 'async',
                ]
            );}
        return $this->display(__FILE__, 'views/templates/hook/footer.tpl');
    }

/**
     *1.2.1 uzduotis zemiau perdaryta su helper klase.
*/
    // public function getContent() {

    //     if(Tools::getValue("pavadinimas")){
    //         Configuration::updateValue('PAVADINIMAS', Tools::getValue("pavadinimas"));

    //     }

    //     if(Tools::getValue("pasirinkimas")){
    //         Configuration::updateValue('PASIRINKIMAS', Tools::getValue("pasirinkimas"));

    //     }

    //     $pavadinimas = Configuration::get('PAVADINIMAS');
    //     $pasirinkimas = Configuration::get('PASIRINKIMAS');
    //     $this->context->smarty->assign(
    //         [
    //             'pavadinimas' => $pavadinimas,
    //             'pasirinkimas' => $pasirinkimas
    //         ]
    //         );
    //     return $this->fetch("module:demouzduotis/views/templates/admin/configuration.tpl");
    // }
/**
     * Generuoti Lentele atvaizdavimui.
*/
    public function getContent()
    {
          // Configuration
        if (Tools::isSubmit('submit' . $this->name)) {
            Configuration::updateValue('PAVADINIMAS', Tools::getValue("pavadinimas"));
            Configuration::updateValue('PASIRINKIMAS', Tools::getValue("pasirinkimas"));
        }
        return $this->displayForm();
    }
    /**
     * Generuoti Lentele su dviem kintamaisiais su helper klase.
*/
    public function displayForm()
    {
        $defaultLang = (int) Configuration::get('PS_LANG_DEFAULT');
        $fields[0]['form'] = [
            'legend' => [
                'title' => $this->trans('Demo uzduotis'),
            ],
            'input' => [
                [
                    'type' => 'text',
                    'label' => $this->l('Užduoties pavadinimas'),
                    'name' => 'pavadinimas',
                    'class' => 'form-control',
                    'size' => 20,
                    'required' => true,
                ],
                [
                    'type' => 'select',
                    'label' => $this->l('Užduoties sunkumas'),
                    'desc' => $this->l('Pasirinkite sunkuma'),
                    'name' => 'pasirinkimas',
                    'required' => true,
                    'options' => array(
                        'query' => $options = array(
                            array(
                                'id_option' => 1,
                                'name' => 'Lengva',
                            ),
                            array(
                                'id_option' => 2,
                                'name' => 'Vidutiniškai sunki',
                            ),
                            array(
                                'id_option' => 3,
                                'name' => 'Sunki',
                            ),
                        ),
                        'id' => 'id_option',
                        'name' => 'name',
                    ),
                ],
            ],
            'submit' => [
                'title' => $this->trans('Issaugoti'),
                'class' => 'btn btn-danger',
            ],
        ];
        //helper class
        $helper = new HelperForm();
        $helper->module = $this;
        $helper->name_controller = $this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->currentIndex = AdminController::$currentIndex . '&configure=' . $this->name;

        //Language
        $helper->default_form_language = $defaultLang;
        $helper->allow_employee_form_lang = $defaultLang;

        // Title and toolbar
        $helper->title = $this->displayName;
        $helper->show_toolbar = true;
        $helper->toolbar_scroll = true;
        $helper->submit_action = 'submit' . $this->name;
        $helper->toolbar_btn = [
            'save' => [
                'desc' => $this->l('Save'),
                'href' => AdminController::$currentIndex . '&configure=' . $this->name . '&save' . $this->name .
                '&token=' . Tools::getAdminTokenLite('AdminModules'),
            ],
            'back' => [
                'href' => AdminController::$currentIndex . '&token=' . Tools::getAdminTokenLite('AdminModules'),
                'desc' => $this->l('Back to list'),
            ],
        ];
        $helper->fields_value['pavadinimas'] = Configuration::get('PAVADINIMAS');
        $helper->fields_value['pasirinkimas'] = Configuration::get('PASIRINKIMAS');

        return $helper->generateForm($fields);
    }
/**
     * Generuoti Tab sonineje sekcijoje -> AdminTest pavadinimu.
*/
    public function installtab()
    {

        $tab = new Tab();
        $tab->active = 1;
        $tab->class_name = 'AdminTest';
        $tab->name = array();
        $tab->module = $this->name;
        $tab->id_parent = (int) Tab::getIdFromClassName('DEFAULT');
        $tab->icon = 'settings_applications';
        foreach (Language::getLanguages(true) as $lang) {
            $tab->name[$lang['id_lang']] = "AdminTest";
        }
        return $tab->add();
    }
/**
     * Istrinti Tab sonineje sekcijoje -> AdminTest pavadinimu.
*/
    public function uninstalltab()
    {
        $idTab = (int) Tab::getIdFromClassName('AdminTest');
        if ($idTab) {
            $tab = new Tab($idTab);
            try {
                $tab->delete();
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
        return true;
    }

}
