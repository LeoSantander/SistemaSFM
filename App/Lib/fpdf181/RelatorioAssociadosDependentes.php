<?php

namespace App\Lib\fpdf181;

use App\Models\DAO\EstadoDAO;
use App\Models\DAO\LocalTrabalhoDAO;
use App\Models\DAO\CidadeDAO;

class RelatorioAssociadosDependentes extends FPDF
{
    public function novo($postos, $inicio, $fim, $colunas,$total)
    {
        //var_dump($postos);
        $pdf = new FPDF();

        $pdf->SetTitle('SFM_Relatorio_Associados_Dependentes'.date("d-m-Y").'.pdf',true);
        $pdf->AddPage();//inicio do PDF

        $pdf->Image('http://agenciaroad.tech/wp-content/uploads/2018/11/cropped-Sem-T%C3%ADtulo-2.png', 10, 15, 50);

        $pdf->SetFont('Arial','B',20);
        $pdf->Cell(190,50,utf8_decode('Relatório de Associados/ Dependentes'),0,1,'C');
        $pdf->Cell(190,-35,utf8_decode('SFM Marília - '.date("d/m/Y")),0,1,'C');
        $pdf->SetFont('Arial','',14);
        $pdf->Cell(190,50,utf8_decode('Período: '.date('d/m/Y', strtotime($inicio)).' - '.date('d/m/Y', strtotime($fim))),0,0,'C');

        $pdf->SetFont('Arial', 'B', 16);
        $pdf->SetY("60");
        $pdf->Cell(190, 10, utf8_decode('Associados e Dependentes'), 1, 1, 'C');

        $conta = count($colunas);
        $tam = 190/$conta;

        for($i=0; $i<count($colunas); $i++)
            $teste[$i] = $tam;

        $pdf->SetFont('Arial','B',12);
        $pdf->SetWidths($teste);
        $i=0;
        foreach($colunas as $col){
            $colunas[$i] = utf8_decode($colunas[$i]);
            $i++;
        }
        $pdf->Row($colunas,'C');

        $pdf->SetFont('Arial','',11);
        $pdf->SetWidths($teste);//CADA VALOR DESTE ARRAY SERÁ A LARGURA DE CADA COLUNA
        $totalAssociados=0;

        $conta = count($postos);
        $i=0;
        /*while($i < $conta)
        {
            for ($j=0; $j < 2; $j++) {
                  $array[$j] = utf8_decode($postos[$i]);
                  $i++;
            }
            $pdf->Row($array,'C');
            $totalAssociados++;
        }*/
        foreach($postos as $linha)
        {
            $j = 0;
            foreach($linha as $col){
                  $array[$j] = utf8_decode($col);
                  $j++;
            }
            $pdf->Row($array);
            $totalAssociados++;
        }
        $pdf->Ln();
        //$pdf->Footer();
        $pdf->Cell(190,0,utf8_decode('Total de Associados: '.$total),0,1,'R');
        $pdf->Cell(190,14,utf8_decode('Total de Dependentes: 0'.$totalDependentes),0,1,'R');
        $pdf->AliasNbPages();

        $pdf->Output("SFM_Relatorio_Postos_".date("d-m-Y").".pdf",'I');//fim do PDF
    }

}
