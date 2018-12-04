
plugin.tx_planningapp {
    view {
        # cat=plugin.tx_planningapp_dashboard/file; type=string; label=Path to template root (FE)
        templateRootPath = EXT:planning_app/Resources/Private/Templates/
        # cat=plugin.tx_planningapp_dashboard/file; type=string; label=Path to template partials (FE)
        partialRootPath = EXT:planning_app/Resources/Private/Partials/
        # cat=plugin.tx_planningapp_dashboard/file; type=string; label=Path to template layouts (FE)
        layoutRootPath = EXT:planning_app/Resources/Private/Layouts/
    }
    persistence {
        # cat=plugin.tx_planningapp_dashboard//a; type=string; label=Default storage PID
        storagePid =
    }
}
