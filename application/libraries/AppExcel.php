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
            $x++;
        }

        $this->Excel_writer->save('php://output', 'xls');
    }
}