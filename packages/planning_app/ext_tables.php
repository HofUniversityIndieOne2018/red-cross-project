<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'OliverHader.PlanningApp',
            'Dashboard',
            'Dashboard'
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'OliverHader.PlanningApp',
            'Management',
            'Management'
        );

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('planning_app', 'Configuration/TypoScript', 'Planning App');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_planningapp_domain_model_volunteer', 'EXT:planning_app/Resources/Private/Language/locallang_csh_tx_planningapp_domain_model_volunteer.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_planningapp_domain_model_volunteer');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_planningapp_domain_model_activity', 'EXT:planning_app/Resources/Private/Language/locallang_csh_tx_planningapp_domain_model_activity.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_planningapp_domain_model_activity');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_planningapp_domain_model_dateperiod', 'EXT:planning_app/Resources/Private/Language/locallang_csh_tx_planningapp_domain_model_dateperiod.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_planningapp_domain_model_dateperiod');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_planningapp_domain_model_location', 'EXT:planning_app/Resources/Private/Language/locallang_csh_tx_planningapp_domain_model_location.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_planningapp_domain_model_location');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_planningapp_domain_model_address', 'EXT:planning_app/Resources/Private/Language/locallang_csh_tx_planningapp_domain_model_address.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_planningapp_domain_model_address');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_planningapp_domain_model_resource', 'EXT:planning_app/Resources/Private/Language/locallang_csh_tx_planningapp_domain_model_resource.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_planningapp_domain_model_resource');

    }
);
