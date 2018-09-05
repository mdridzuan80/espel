<?php
namespace Espel;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

class AppExcel extends BaseLibrary
{
    private $spreadsheet;
    private $Excel_writer;

    function __construct()
    {
        $this->spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load(FCPATH . 'assets/template/Book1.xlsx');  /*----Spreadsheet object-----*/
        $this->Excel_writer = new Xls($this->spreadsheet);  /*----- Excel (Xls) Object*/
    }

    public function laporan_prestasi_penuh($data)
    {
        //$this->spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load(FCPATH  . 'assets/template/Book1.xlsx');

        //$this->spreadsheet->setActiveSheetIndex(0);
        $activeSheet = $this->spreadsheet->getActiveSheet();

        $activeSheet->getCell('A5')->setValue('Tarikh Cetakkan : ' . \Carbon\Carbon::now());
        //header
        $activeSheet->mergeCells('A7:A8');
        $activeSheet->getCell('A7')->setValue('BIL');
        $activeSheet->mergeCells('B7:B8');
        $activeSheet->getCell('B7')->setValue('GRED / PERJAWATAN');
        $activeSheet->mergeCells('C7:C8');
        $activeSheet->getCell('C7')->setValue('BILANGAN PERJAWATAN');
        $activeSheet->mergeCells('D7:J7');
        $activeSheet->getCell('D7')->setValue('BILANGAN HARI');
        $activeSheet->getCell('D8')->setValue('0');
        $activeSheet->getCell('E8')->setValue('1');
        $activeSheet->getCell('F8')->setValue('2');
        $activeSheet->getCell('G8')->setValue('3');
        $activeSheet->getCell('H8')->setValue('4');
        $activeSheet->getCell('I8')->setValue('5');
        $activeSheet->getCell('J8')->setValue('6');
        $activeSheet->getCell('K8')->setValue('7');
        $activeSheet->mergeCells('L7:L8');
        $activeSheet->getCell('L7')->setValue('LEBIH 7 HARI');
        $activeSheet->mergeCells('M7:M8');
        $activeSheet->getCell('M7')->setValue('JUMLAH (7 DAN LEBIH 7 HARI)');

        $x = 1;
        $jbiltotal = 0;
        $jbil0 = '';
        $jbil1 = '';
        $jbil2 = '';
        $jbil3 = '';
        $jbil4 = '';
        $jbil5 = '';
        $jbil6 = '';
        $jbil7 = '';
        $jbilover7 = '';
        $jbil7addover7 = '';
        $startRow = 8;
        foreach ($data['sen_kelas'] as $kelas)
        {
            $r = ($startRow + $x);
            $activeSheet->getCell('A' . $r)->setValue($x);
            $activeSheet->getCell('B' . $r)->setValue($kelas->kumpulan);
            $activeSheet->getCell('C' . $r)->setValue($kelas->pengisian);
            $activeSheet->getCell('D' . $r)->setValue((in_array('1', $data['objFilter']->hari)) ? $bil0 = $kelas->kosong : '');
            $activeSheet->getCell('E' . $r)->setValue((in_array('2', $data['objFilter']->hari)) ? $bil1 = $kelas->satu : '');
            $activeSheet->getCell('F' . $r)->setValue((in_array('3', $data['objFilter']->hari)) ? $bil2 = $kelas->dua : '');
            $activeSheet->getCell('G' . $r)->setValue((in_array('4', $data['objFilter']->hari)) ? $bil3 = $kelas->tiga : '');
            $activeSheet->getCell('H' . $r)->setValue((in_array('5', $data['objFilter']->hari)) ? $bil4 = $kelas->empat : '');
            $activeSheet->getCell('I' . $r)->setValue((in_array('6', $data['objFilter']->hari)) ? $bil5 = $kelas->lima : '');
            $activeSheet->getCell('J' . $r)->setValue((in_array('7', $data['objFilter']->hari)) ? $bil6 = $kelas->enam : '');
            $tujuh = (in_array('8', $data['objFilter']->hari)) ? $bil7 = $kelas->tujuh : '';
            $activeSheet->getCell('K' . $r)->setValue($tujuh);
            $over_tujuh = (in_array('9', $data['objFilter']->hari)) ? $bilover7 = $kelas->over_7 : '';
            $activeSheet->getCell('L' . $r)->setValue($over_tujuh);
            $activeSheet->getCell('M' . $r)->setValue((in_array('8', $data['objFilter']->hari) && in_array('9', $data['objFilter']->hari)) ? $kelas->over_77 : '');
            $jbiltotal += $kelas->pengisian;
                //dd((int) $jbil0);
            if (in_array('1', $data['objFilter']->hari)) {
                $jbil0 = (int)$jbil0;
                (int)$jbil0 += (int)$bil0;
            };
            if (in_array('2', $data['objFilter']->hari)) {
                $jbil1 = (int)$jbil1;
                (int)$jbil1 += (int)$bil1;
            };
            if (in_array('3', $data['objFilter']->hari)) {
                $jbil2 = (int)$jbil2;
                (int)$jbil2 += (int)$bil2;
            };
            if (in_array('4', $data['objFilter']->hari)) {
                $jbil3 = (int)$jbil3;
                (int)$jbil3 += (int)$bil3;
            };
            if (in_array('5', $data['objFilter']->hari)) {
                $jbil4 = (int)$jbil4;
                (int)$jbil4 += (int)$bil4;
            };
            if (in_array('6', $data['objFilter']->hari)) {
                $jbil5 = (int)$jbil5;
                (int)$jbil5 += (int)$bil5;
            };
            if (in_array('7', $data['objFilter']->hari)) {
                $jbil6 = (int)$jbil6;
                (int)$jbil6 += (int)$bil6;
            };
            if (in_array('8', $data['objFilter']->hari)) {
                $jbil7 = (int)$jbil7;
                (int)$jbil7 += (int)$bil7;
            };
            if (in_array('9', $data['objFilter']->hari)) {
                $jbilover7 = (int)$jbilover7;
                (int)$jbilover7 += (int)$bilover7;
            };
            $x++;
        }

        $r = ($startRow + $x);
        $activeSheet->getCell('A' . $r)->setValue($x);
        $activeSheet->getCell('B' . $r)->setValue('Jumlah');
        $activeSheet->getCell('C' . $r)->setValue($jbiltotal);
        $activeSheet->getCell('D' . $r)->setValue((in_array('1', $data['objFilter']->hari)) ? (int)$jbil0 : '');
        $activeSheet->getCell('E' . $r)->setValue((in_array('2', $data['objFilter']->hari)) ? (int)$jbil1 : '');
        $activeSheet->getCell('F' . $r)->setValue((in_array('3', $data['objFilter']->hari)) ? (int)$jbil2 : '');
        $activeSheet->getCell('G' . $r)->setValue((in_array('4', $data['objFilter']->hari)) ? (int)$jbil3 : '');
        $activeSheet->getCell('H' . $r)->setValue((in_array('5', $data['objFilter']->hari)) ? (int)$jbil4 : '');
        $activeSheet->getCell('I' . $r)->setValue((in_array('6', $data['objFilter']->hari)) ? (int)$jbil5 : '');
        $activeSheet->getCell('J' . $r)->setValue((in_array('7', $data['objFilter']->hari)) ? (int)$jbil6 : '');
        $tujuh = (in_array('8', $data['objFilter']->hari)) ? (int)$jbil7 : '';
        $activeSheet->getCell('K' . $r)->setValue($tujuh);
        $over_tujuh = (in_array('9', $data['objFilter']->hari)) ? (int)$jbilover7 : '';
        $activeSheet->getCell('L' . $r)->setValue($over_tujuh);
        $activeSheet->getCell('M' . $r)->setValue((in_array('8', $data['objFilter']->hari) && in_array('9', $data['objFilter']->hari)) ? ((int)$tujuh + (int)$over_tujuh) : '');


        $this->Excel_writer->save('php://output', 'xls');
    }
}