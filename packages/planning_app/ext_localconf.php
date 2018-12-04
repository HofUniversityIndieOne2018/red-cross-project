<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'OliverHader.PlanningApp',
            'Dashboard',
            [
                'Dashboard' => 'index, editProfile, updateProfile, myActivities, allActivities, showActivity, subscribe, unsubscribe',
            ],
            // non-cacheable actions
            [
                'Dashboard' => 'index, editProfile, updateProfile, myActivities, allActivities, showActivity, subscribe, unsubscribe',
            ]
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'OliverHader.PlanningApp',
            'Management',
            [
                'ActivityManagement' => 'list, show, new, create, edit, update, delete',
                'VolunteerManagement' => 'list, show, new, create, edit, update, delete',
                'ResourceManagement' => 'list, show, new, create, edit, update, delete',
                'LocationManagement' => 'list, show, new, create, edit, update, delete'
            ],
            // non-cacheable actions
            [
                'ActivityManagement' => 'create, update, delete',
                'VolunteerManagement' => 'create, update, delete',
                'ResourceManagement' => 'create, update, delete',
                'LocationManagement' => 'create, update, delete',
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
