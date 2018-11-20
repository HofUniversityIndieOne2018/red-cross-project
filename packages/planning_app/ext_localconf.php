<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'OliverHader.PlanningApp',
            'Dashboard',
            [
                'Volunteer' => 'list, show, new, create, edit, update, delete',
                'Activity' => 'list, show, new, create, edit, update, delete',
                'Location' => 'list, show, new, create, edit, update, delete',
                'Resource' => 'list, show, new, create, edit, update, delete'
            ],
            // non-cacheable actions
            [
                'Volunteer' => 'create, update, delete',
                'Activity' => 'create, update, delete',
                'Location' => 'create, update, delete',
                'Resource' => 'create, update, delete'
            ]
        );

    // wizards
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        'mod {
            wizards.newContentElement.wizardItems.plugins {
                elements {
                    dashboard {
                        iconIdentifier = planning_app-plugin-dashboard
                        title = LLL:EXT:planning_app/Resources/Private/Language/locallang_db.xlf:tx_planning_app_dashboard.name
                        description = LLL:EXT:planning_app/Resources/Private/Language/locallang_db.xlf:tx_planning_app_dashboard.description
                        tt_content_defValues {
                            CType = list
                            list_type = planningapp_dashboard
                        }
                    }
                }
                show = *
            }
       }'
    );
		$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
		
			$iconRegistry->registerIcon(
				'planning_app-plugin-dashboard',
				\TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
				['source' => 'EXT:planning_app/Resources/Public/Icons/user_plugin_dashboard.svg']
			);
		
    }
);
