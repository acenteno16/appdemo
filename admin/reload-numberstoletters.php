<?php

class EnLetras
{
    private $Void = "";
    private $SP = " ";
    private $Dot = ".";
    private $Zero = "0";
    private $Neg = "Menos";

    public function ValorEnLetras(float $x, string $Moneda = ""): string
    {
        $Signo = $x < 0 ? $this->Neg . " " : "";
        $x = abs($x);
        $s = number_format($x, 2, '.', '');
        [$Ent, $Frc] = explode($this->Dot, $s) + [$this->Void, $this->Void];

        $TextoEntero = $this->ConvertirNumeroALetras(intval($Ent));
        $TextoFraccion = $Frc !== $this->Void ? "Con " . $this->ConvertirNumeroALetras(intval($Frc)) . " Centavos" : "";

        return trim("{$Signo}{$TextoEntero} {$Moneda} {$TextoFraccion}");
    }

    private function ConvertirNumeroALetras(int $numero): string
    {
        if ($numero === 0) {
            return "Cero";
        }

        if ($numero >= 1_000_000) {
            $millones = intval($numero / 1_000_000);
            $resto = $numero % 1_000_000;
            return $this->ConvertirNumeroALetras($millones) . " Millón" . ($millones > 1 ? "es" : "") .
                ($resto > 0 ? " " . $this->ConvertirNumeroALetras($resto) : "");
        }

        if ($numero >= 1_000) {
            $miles = intval($numero / 1_000);
            $resto = $numero % 1_000;
            return ($miles > 1 ? $this->ConvertirNumeroALetras($miles) . " Mil" : "Mil") .
                ($resto > 0 ? " " . $this->ConvertirNumeroALetras($resto) : "");
        }

        if ($numero >= 100) {
            $centenas = intval($numero / 100);
            $resto = $numero % 100;
            $textoCentenas = match ($centenas) {
                1 => ($resto > 0 ? "Ciento" : "Cien"),
                5 => "Quinientos",
                7 => "Setecientos",
                9 => "Novecientos",
                default => $this->Unidades($centenas) . "cientos"
            };
            return $textoCentenas . ($resto > 0 ? " " . $this->ConvertirNumeroALetras($resto) : "");
        }

        if ($numero >= 20) {
            $decenas = intval($numero / 10) * 10;
            $unidad = $numero % 10;
            $textoDecenas = match ($decenas) {
                20 => "Veinte",
                30 => "Treinta",
                40 => "Cuarenta",
                50 => "Cincuenta",
                60 => "Sesenta",
                70 => "Setenta",
                80 => "Ochenta",
                90 => "Noventa",
                default => ""
            };
            return $unidad > 0 ? $textoDecenas . " y " . $this->Unidades($unidad) : $textoDecenas;
        }

        return $this->Unidades($numero);
    }

    private function Unidades(int $numero): string
    {
        return match ($numero) {
            1 => "Uno",
            2 => "Dos",
            3 => "Tres",
            4 => "Cuatro",
            5 => "Cinco",
            6 => "Seis",
            7 => "Siete",
            8 => "Ocho",
            9 => "Nueve",
            10 => "Diez",
            11 => "Once",
            12 => "Doce",
            13 => "Trece",
            14 => "Catorce",
            15 => "Quince",
            16, 17, 18, 19 => "Dieci" . $this->Unidades($numero - 10),
            default => ""
        };
    }
}

//-------------- Programa principal ------------------------

 $num= $_POST['variable'];
 if(!isset($_POST['variable'])){
	 $num = $_GET['variable'];
 }
 

 $V=new EnLetras();
 
 if($mreturn == 1){
	 $letters = $V->ValorEnLetras($ammount);
 }else{
	 echo $V->ValorEnLetras($num);
 }
      
?>