<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit8518d197a0355f222894cc3c9e737283
{
    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'WPDesk\\ShopMagicTwilio\\' => 23,
        ),
        'P' => 
        array (
            'Psr\\Log\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'WPDesk\\ShopMagicTwilio\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
    );

    public static $classMap = array (
        'Psr\\Log\\AbstractLogger' => __DIR__ . '/..' . '/psr/log/Psr/Log/AbstractLogger.php',
        'Psr\\Log\\InvalidArgumentException' => __DIR__ . '/..' . '/psr/log/Psr/Log/InvalidArgumentException.php',
        'Psr\\Log\\LogLevel' => __DIR__ . '/..' . '/psr/log/Psr/Log/LogLevel.php',
        'Psr\\Log\\LoggerAwareInterface' => __DIR__ . '/..' . '/psr/log/Psr/Log/LoggerAwareInterface.php',
        'Psr\\Log\\LoggerAwareTrait' => __DIR__ . '/..' . '/psr/log/Psr/Log/LoggerAwareTrait.php',
        'Psr\\Log\\LoggerInterface' => __DIR__ . '/..' . '/psr/log/Psr/Log/LoggerInterface.php',
        'Psr\\Log\\LoggerTrait' => __DIR__ . '/..' . '/psr/log/Psr/Log/LoggerTrait.php',
        'Psr\\Log\\NullLogger' => __DIR__ . '/..' . '/psr/log/Psr/Log/NullLogger.php',
        'Psr\\Log\\Test\\DummyTest' => __DIR__ . '/..' . '/psr/log/Psr/Log/Test/DummyTest.php',
        'Psr\\Log\\Test\\LoggerInterfaceTest' => __DIR__ . '/..' . '/psr/log/Psr/Log/Test/LoggerInterfaceTest.php',
        'Psr\\Log\\Test\\TestLogger' => __DIR__ . '/..' . '/psr/log/Psr/Log/Test/TestLogger.php',
        'ShopMagicTwilioVendor\\Psr\\Container\\ContainerExceptionInterface' => __DIR__ . '/../..' . '/vendor_prefixed/psr/container/src/ContainerExceptionInterface.php',
        'ShopMagicTwilioVendor\\Psr\\Container\\ContainerInterface' => __DIR__ . '/../..' . '/vendor_prefixed/psr/container/src/ContainerInterface.php',
        'ShopMagicTwilioVendor\\Psr\\Container\\NotFoundExceptionInterface' => __DIR__ . '/../..' . '/vendor_prefixed/psr/container/src/NotFoundExceptionInterface.php',
        'ShopMagicTwilioVendor\\WPDesk\\Notice\\AjaxHandler' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-notice/src/WPDesk/Notice/AjaxHandler.php',
        'ShopMagicTwilioVendor\\WPDesk\\Notice\\Factory' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-notice/src/WPDesk/Notice/Factory.php',
        'ShopMagicTwilioVendor\\WPDesk\\Notice\\Notice' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-notice/src/WPDesk/Notice/Notice.php',
        'ShopMagicTwilioVendor\\WPDesk\\Notice\\PermanentDismissibleNotice' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-notice/src/WPDesk/Notice/PermanentDismissibleNotice.php',
        'ShopMagicTwilioVendor\\WPDesk\\PluginBuilder\\BuildDirector\\LegacyBuildDirector' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-builder/src/BuildDirector/LegacyBuildDirector.php',
        'ShopMagicTwilioVendor\\WPDesk\\PluginBuilder\\Builder\\AbstractBuilder' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-builder/src/Builder/AbstractBuilder.php',
        'ShopMagicTwilioVendor\\WPDesk\\PluginBuilder\\Builder\\InfoActivationBuilder' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-builder/src/Builder/InfoActivationBuilder.php',
        'ShopMagicTwilioVendor\\WPDesk\\PluginBuilder\\Builder\\InfoBuilder' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-builder/src/Builder/InfoBuilder.php',
        'ShopMagicTwilioVendor\\WPDesk\\PluginBuilder\\Plugin\\AbstractPlugin' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-builder/src/Plugin/AbstractPlugin.php',
        'ShopMagicTwilioVendor\\WPDesk\\PluginBuilder\\Plugin\\Activateable' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-builder/src/Plugin/Activateable.php',
        'ShopMagicTwilioVendor\\WPDesk\\PluginBuilder\\Plugin\\ActivationAware' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-builder/src/Plugin/ActivationAware.php',
        'ShopMagicTwilioVendor\\WPDesk\\PluginBuilder\\Plugin\\ActivationTracker' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-builder/src/Plugin/ActivationTracker.php',
        'ShopMagicTwilioVendor\\WPDesk\\PluginBuilder\\Plugin\\Conditional' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-builder/src/Plugin/Conditional.php',
        'ShopMagicTwilioVendor\\WPDesk\\PluginBuilder\\Plugin\\Deactivateable' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-builder/src/Plugin/Deactivateable.php',
        'ShopMagicTwilioVendor\\WPDesk\\PluginBuilder\\Plugin\\Hookable' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-builder/src/Plugin/Hookable.php',
        'ShopMagicTwilioVendor\\WPDesk\\PluginBuilder\\Plugin\\HookableCollection' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-builder/src/Plugin/HookableCollection.php',
        'ShopMagicTwilioVendor\\WPDesk\\PluginBuilder\\Plugin\\HookableParent' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-builder/src/Plugin/HookableParent.php',
        'ShopMagicTwilioVendor\\WPDesk\\PluginBuilder\\Plugin\\HookablePluginDependant' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-builder/src/Plugin/HookablePluginDependant.php',
        'ShopMagicTwilioVendor\\WPDesk\\PluginBuilder\\Plugin\\PluginAccess' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-builder/src/Plugin/PluginAccess.php',
        'ShopMagicTwilioVendor\\WPDesk\\PluginBuilder\\Plugin\\SlimPlugin' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-builder/src/Plugin/SlimPlugin.php',
        'ShopMagicTwilioVendor\\WPDesk\\PluginBuilder\\Plugin\\TemplateLoad' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-builder/src/Plugin/TemplateLoad.php',
        'ShopMagicTwilioVendor\\WPDesk\\PluginBuilder\\Storage\\Exception\\ClassAlreadyExists' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-builder/src/Storage/Exception/ClassAlreadyExists.php',
        'ShopMagicTwilioVendor\\WPDesk\\PluginBuilder\\Storage\\Exception\\ClassNotExists' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-builder/src/Storage/Exception/ClassNotExists.php',
        'ShopMagicTwilioVendor\\WPDesk\\PluginBuilder\\Storage\\PluginStorage' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-builder/src/Storage/PluginStorage.php',
        'ShopMagicTwilioVendor\\WPDesk\\PluginBuilder\\Storage\\StaticStorage' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-builder/src/Storage/StaticStorage.php',
        'ShopMagicTwilioVendor\\WPDesk\\PluginBuilder\\Storage\\StorageFactory' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-builder/src/Storage/StorageFactory.php',
        'ShopMagicTwilioVendor\\WPDesk\\PluginBuilder\\Storage\\WordpressFilterStorage' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-builder/src/Storage/WordpressFilterStorage.php',
        'ShopMagicTwilioVendor\\WPDesk_Basic_Requirement_Checker' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-basic-requirements/src/Basic_Requirement_Checker.php',
        'ShopMagicTwilioVendor\\WPDesk_Basic_Requirement_Checker_Factory' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-basic-requirements/src/Basic_Requirement_Checker_Factory.php',
        'ShopMagicTwilioVendor\\WPDesk_Basic_Requirement_Checker_With_Update_Disable' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-basic-requirements/src/Basic_Requirement_Checker_With_Update_Disable.php',
        'ShopMagicTwilioVendor\\WPDesk_Buildable' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-builder/src/Plugin/WithoutNamespace/Buildable.php',
        'ShopMagicTwilioVendor\\WPDesk_Has_Plugin_Info' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-builder/src/Plugin/WithoutNamespace/Has_Plugin_Info.php',
        'ShopMagicTwilioVendor\\WPDesk_Plugin_Info' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-builder/src/Plugin/WithoutNamespace/Plugin_Info.php',
        'ShopMagicTwilioVendor\\WPDesk_Requirement_Checker' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-basic-requirements/src/Requirement_Checker.php',
        'ShopMagicTwilioVendor\\WPDesk_Requirement_Checker_Factory' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-basic-requirements/src/Requirement_Checker_Factory.php',
        'ShopMagicTwilioVendor\\WPDesk_Translable' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-builder/src/Plugin/WithoutNamespace/Translable.php',
        'ShopMagicTwilioVendor\\WPDesk_Translatable' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-builder/src/Plugin/WithoutNamespace/Translatable.php',
        'WPDesk\\Helper\\HelperAsLibrary' => __DIR__ . '/..' . '/wpdesk/wp-wpdesk-helper-override/src/Helper/HelperAsLibrary.php',
        'WPDesk\\ShopMagicTwilio\\Action\\TwilioSendSms' => __DIR__ . '/../..' . '/src/Action/TwilioSendSms.php',
        'WPDesk\\ShopMagicTwilio\\Admin\\Settings' => __DIR__ . '/../..' . '/src/Admin/Settings.php',
        'WPDesk\\ShopMagicTwilio\\Plugin' => __DIR__ . '/../..' . '/src/Plugin.php',
        'WPDesk_Tracker_Data_Provider' => __DIR__ . '/..' . '/wpdesk/wp-wpdesk-helper-override/src/Interop/Tracker/class-wpdesk-tracker-data-provider.php',
        'WPDesk_Tracker_Factory' => __DIR__ . '/..' . '/wpdesk/wp-wpdesk-helper-override/src/Helper/TrackerFactory.php',
        'WPDesk_Tracker_Interface' => __DIR__ . '/..' . '/wpdesk/wp-wpdesk-helper-override/src/Interop/Tracker/class-wpdesk-tracker-interface.php',
        'WPDesk_Tracker_Sender' => __DIR__ . '/..' . '/wpdesk/wp-wpdesk-helper-override/src/Interop/Tracker/class-wpdesk-tracker-sender.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit8518d197a0355f222894cc3c9e737283::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit8518d197a0355f222894cc3c9e737283::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit8518d197a0355f222894cc3c9e737283::$classMap;

        }, null, ClassLoader::class);
    }
}
