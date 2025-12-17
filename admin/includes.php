<?php
/*	
<script src="../assets/admin/pages/scripts/form-samples.js"></script>
FormSamples.init();
<script src="../assets/global/plugins/jquery-idle-timeout/jquery.idletimeout.js" type="text/javascript"></script>

<script src="../assets/global/plugins/jquery-idle-timeout/jquery.idletimer.js" type="text/javascript"></script>
*/

function loadCSS($requiredFiles, $nonce) {
    $catalog = [
        'general' => [
            #'<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>',
            '<link href="../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>',
            '<link href="../assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>',
            '<link href="../assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>',
            '<link href="../assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>',
            '<link href="../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>',
            '<link href="../assets/global/css/components.css" rel="stylesheet" type="text/css"/>',
            '<link href="../assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>',
            '<link href="../assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>',
            '<link href="../assets/admin/layout/css/themes/blue.css" rel="stylesheet" type="text/css" id="style_color"/>',
            '<link href="../assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>',
			'<style nonce="'.$nonce.'">.dNone{ display: none !important; } .redText{ color: red !important; } #customModal{ display: none; }</style>'
        ],
        'datepicker' => [
            '<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-datepicker/css/datepicker.css"/>'
        ],
        'timepicker' => [
            '<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css"/>'
        ],
        'colorpicker' => [
            '<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css"/>'
        ],
        'datetimepicker' => [
            '<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-datetimepicker/css/datetimepicker.css"/>'
        ],
        'clockpicker' => [
            '<link rel="stylesheet" type="text/css" href="../assets/global/plugins/clockface/css/clockface.css"/>'
        ],
        'select2' => [
            '<link rel="stylesheet" type="text/css" href="../assets/global/plugins/select2/select2.css"/>'
        ],
        'toastr' => [
            '<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-toastr/toastr.min.css"/>'
        ],
        'ckeditor' => [
            '<link rel="stylesheet" type="text/css" href="../assets/global/plugins/ckeditor/sample.css">'
        ],
		'chart' => [
            '<script src="../assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script>'
        ],
        'lock' => [
            '<link rel="stylesheet" type="text/css" href="../assets/admin/pages/css/lock.css">'
        ]
		
    ];

    foreach ($requiredFiles as $group) {
        if (isset($catalog[$group])) {
            foreach ($catalog[$group] as $file) {
                echo $file . "\n";
            }
        }
    }
} 
 
function loadJS($requiredFiles, $nonce) {
    $catalog = [
        'general' => [
            #'<script src="../assets/global/plugins/jquery-1.11.0.min.js"></script>',
            #'<script src="../assets/global/plugins/jquery-migrate-1.2.1.min.js"></script>',
            #'<script src="../assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js"></script>',
			'<script src="../assets/global/plugins/jquery-3.6.4.min.js"></script>',
            '<script src="../assets/global/plugins/jquery-migrate-3.4.1.min.js"></script>',
            '<script src="../assets/global/plugins/jquery-ui/1.13.2/jquery-ui.min.js"></script>',
            '<script src="../assets/global/plugins/bootstrap/js/bootstrap.min.js"></script>',
			'<script src="../assets/admin/pages/scripts/components-pickers.js"></script>',
            '<script src="../assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"></script>',
            '<script src="../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>',
            #'<script src="../assets/global/plugins/jquery.blockui.min.js"></script>',
            #'<script src="../assets/global/plugins/jquery.cokie.min.js"></script>',
            '<script src="../assets/global/plugins/uniform/jquery.uniform.min.js"></script>',
            '<script src="../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>',
            '<script src="../assets/global/scripts/metronic.js"></script>',
            '<script src="../assets/admin/layout/scripts/layout.js"></script>',
            '<script src="../assets/admin/layout/scripts/quick-sidebar.js"></script>'
        ],
        'datepicker' => [
            '<script src="../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>'
        ],
        'timepicker' => [
            '<script src="../assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>'
        ],
        'colorpicker' => [
            '<script src="../assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>'
        ],
        'datetimepicker' => [
            '<script src="../assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>'
        ],
        'clockpicker' => [
            '<script src="../assets/global/plugins/clockface/js/clockface.js"></script>'
        ],
        'select2' => [
            '<script src="../assets/global/plugins/select2/select2.min.js"></script>'
        ],
        'toastr' => [
            '<script src="../assets/global/plugins/bootstrap-toastr/toastr.min.js"></script>'
        ],
        'ckeditor' => [
            '<script src="../assets/global/plugins/ckeditor/ckeditor.js"></script>'
        ],
		
		'chart' => [
            '<script src="../assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script>'
        ],
		'lock' => [
            '<script src="../assets/admin/pages/scripts/lock.js"></script>'
        ],
		
        'datatable' => [
            '<script src="../assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>',
            '<script src="../assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>',
            '<script src="../assets/admin/pages/scripts/table-managed.js"></script>'
        ]
		 
    ];

    foreach ($requiredFiles as $group) {
        if (isset($catalog[$group])) {
            foreach ($catalog[$group] as $file) {
                echo $file . "\n";
            }
        }
    } 

    // Inicializadores
    echo "<script nonce='$nonce'>\njQuery(document).ready(function() {\n";

    if (in_array('general', $requiredFiles)) {
        echo "Metronic.init();\n";
        echo "Layout.init();\n";
        echo "QuickSidebar.init();\n";
    }

    $pickers = ['datepicker', 'timepicker', 'colorpicker', 'datetimepicker', 'clockpicker'];
    if (array_intersect($requiredFiles, $pickers)) {
        echo "ComponentsPickers.init();\n";
    }

    if (in_array('dashboard', $requiredFiles)) {
        echo "Index.init();\n";
        echo "Index.initDashboardDaterange();\n";
        echo "Index.initJQVMAP();\n";
        echo "Index.initCharts();\n";
        echo "Index.initChat();\n";
        echo "Index.initMiniCharts();\n";
    }

    if (in_array('datatable', $requiredFiles)) {
        echo "TableManaged.init();\n";
    }
	if (in_array('lock', $requiredFiles)) {
        echo "Lock.init();\n";
    }
	if (in_array('chart', $requiredFiles)) {
        echo "Index.initCharts();\n";
    }
	
	
	

    if (in_array('toastr', $requiredFiles)) {
        echo "UIToastr.init();\n";
    }

    echo "});\n</script>";
}

?>