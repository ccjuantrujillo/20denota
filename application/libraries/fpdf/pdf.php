<?php
require_once 'fpdf.php';
class Pdf extends FPDF{
    public function Header() 
    {
        global $arrcabecera;
        global $arrdetalle;
        global $offset;
        for ($k=0;$k<count($arrcabecera);$k++)
        {
            $arrdata=explode("=",$arrcabecera[$k]);
            if (count($arrdata)>1)
            {
                $arrdata[0]=strtolower($arrdata[0]);
                $arrpar=explode(";",$arrdata[1]);
                switch ($arrdata[0])
                {
                    case "image":
                        if (is_file($arrpar[0]))
                        {
                            $this->Image($offset[0]+$arrpar[0],$offset[1]+$arrpar[1],$arrpar[2],$arrpar[3]);
                        };
                        break;
                case "addfont":
                        $this->AddFont($arrpar[0]);
                        break;
                case "setfont":
                        $this->SetFont($arrpar[0],$arrpar[1],$arrpar[2]);
                        break;
                case "settextcolor":
                        $this->SetTextColor($arrpar[0],$arrpar[1],$arrpar[2]);
                        break;
                case "setfillcolor":
                        $this->SetFillColor($arrpar[0],$arrpar[1],$arrpar[2]);
                        break;
                case "cell":
                        $this->Cell($offset[0]+$arrpar[0],$offset[1]+$arrpar[1],$arrpar[2],$arrpar[3],$arrpar[4],$arrpar[5],$arrpar[6]);
                        break;
                case "multicell":
                        $this->MultiCell($offset[0]+$arrpar[0],$offset[1]+$arrpar[1],$arrpar[2],$arrpar[3],$arrpar[4],$arrpar[5],$arrpar[6]);
                        break;
                case "rect":
                        $this->Cell($offset[0]+$arrpar[0],$offset[1]+$arrpar[1],$arrpar[2],$arrpar[3],$arrpar[4]);
                        break;
                case "sety":
                        $this->sety($offset[0]+$arrpar[0]);
                        break;
                };
            };
        }; 
    }
    
    public function Footer() {
        global $arrpie;
        global $offset;
        for ($k=0;$k<count($arrpie);$k++)
        {
            $arrdata=explode("=",$arrpie[$k]);
            if (count($arrdata)>1)
            {
                $arrdata[0]=strtolower($arrdata[0]);
                $arrpar=explode(";",$arrdata[1]);
                switch ($arrdata[0])
                {
                case "image":
                    $this->Image($offset[0]+$arrpar[0],$offset[1]+$arrpar[1],$arrpar[2],$arrpar[3]);
                    break;
                case "addfont":
                    $this->AddFont($arrpar[0]);
                    break;
                case "setfont":
                    $this->SetFont($arrpar[0],$arrpar[1],$arrpar[2]);
                    break;
                case "settextcolor":
                    $this->SetTextColor($arrpar[0],$arrpar[1],$arrpar[2]);
                    break;
                case "setfillcolor":
                    $this->SetFillColor($arrpar[0],$arrpar[1],$arrpar[2]);
                    break;
                case "cell":
                    $this->Cell($offset[0]+$arrpar[0],$offset[1]+$arrpar[1],$arrpar[2],$arrpar[3],$arrpar[4],$arrpar[5],$arrpar[6]);
                    break;
                case "multicell":
                    $this->MultiCell($offset[0]+$arrpar[0],$offset[1]+$arrpar[1],$arrpar[2],$arrpar[3],$arrpar[4],$arrpar[5],$arrpar[6]);
                    break;
                case "rect":
                    $this->Cell($offset[0]+$arrpar[0],$offset[1]+$arrpar[1],$arrpar[2],$arrpar[3],$arrpar[4]);
                    break;
                case "sety":
                    $this->sety($offset[0]+$arrpar[0]);
                    break;
                };
            };
        };
    }
    
    
}
?>
