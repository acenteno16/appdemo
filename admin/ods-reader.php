<?

use PhpOffice\PhpSpreadsheet\IOFactory;

error_reporting(E_ALL);
error_reporting(-1);

$destino = "ods/file.ods";     	
	
if(file_exists($destino)){


require __DIR__ . '/../Header.php';

$inputFileType = 'ods';
$inputFileName = __DIR__ . "$destino";

$helper->log('Loading file ' . pathinfo($inputFileName, PATHINFO_BASENAME) . ' using IOFactory with a defined reader type of ' . $inputFileType);
$reader = IOFactory::createReader($inputFileType);
$spreadsheet = $reader->load($inputFileName);

$sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
var_dump($sheetData);





//End file_exists
} 

else{
	echo "No se encuentra el archivo";
}    
        


