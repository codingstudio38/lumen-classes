<?php

namespace App\Exports;
use App\Models\OrdersModel;
use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeSheet;
use App\Http\Controllers\ExcelhealperFunction;

class OrdersExport implements FromCollection, WithHeadings, WithEvents
{ 
    protected $data;
    
    /** 
     * Write code on Method
     *
     * @return response()
     */
    public function __construct($alldata)
    {
        $this->data = $alldata['list'];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        try {
           return $this->data;
        } catch (\Throwable $th) {
            echo $th->getMessage(); die('failed');
        }
    }
     public function headings(): array
    {
        return [
            // 'EMPLOYEE TYPE',
            // 'EMPLOYEE CATEGORY',
            // 'CODE',
            // 'EMPLOYEE NAME',
            // 'DESIGNATION',
            // 'DEPARTMENT',
            // 'ACTIVE TYPE',
            // 'JOINING DATE'
        ];
    }
 public function registerEvents(): array
    {
    return [
        AfterSheet::class => function (AfterSheet $event) {
            $styleArray = [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
            ];
            $event->sheet->getDelegate()->getStyle('A1:E1')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $event->sheet->getDelegate()->getStyle('A1:E1')->applyFromArray($styleArray);
            $event->sheet->getDelegate()->getStyle('A1:E1')->getFont()->setSize(16);  
            $event->sheet->mergeCells('A1:E1')->setCellValue('A1', "LUMEN EXCEL EXPORT");  


            $event->sheet->getDelegate()->getStyle('A2:E2')->applyFromArray($styleArray);
            $event->sheet->getDelegate()->getStyle('A2:E2')->getFont()->setSize(13);
            $event->sheet->getDelegate()->getStyle('A2:E2')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('f0f8ff');
            $event->sheet->mergeCells('A2:E2')->setCellValue('A2', "ALL PRODUCT LIST");
            


            $event->sheet->getDelegate()->getStyle('A3:E3')->applyFromArray($styleArray);
            $event->sheet->getDelegate()->getStyle('A3:E3')->getFont()->setSize(12)->getColor()->setARGB('1b55e2');
            $event->sheet->getDelegate()->getStyle('A3:E3')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('f5f3f3');

            $event->sheet->getDelegate()->getStyle('A3:E3')->getAlignment()->setWrapText(true);    
            $event->sheet->getColumnDimension('A')->setWidth(15);
            $event->sheet->getColumnDimension('B')->setWidth(15);
            $event->sheet->getColumnDimension('C')->setWidth(15);
            $event->sheet->getColumnDimension('D')->setWidth(15);
            $event->sheet->getColumnDimension('E')->setWidth(15);
        
            
            $event->sheet->setCellValue('A3', "ID");
            $event->sheet->setCellValue('B3', "PRODUCT NAME");
            $event->sheet->setCellValue('C3', "QUANTITY");
            $event->sheet->setCellValue('D3', "CREATED AT");
            $event->sheet->setCellValue('E3', "UPDATED AT");
           
            $i=4;
            foreach($this->data as $key=>$val){
                    $event->sheet->getDelegate()->getStyle('A'.$i.":E".$i)->applyFromArray($styleArray);
                    $event->sheet->setCellValue('A'.$i, @$val->id);
                    $event->sheet->setCellValue('B'.$i, @$val->product_name);
                    $event->sheet->setCellValue('C'.$i, @$val->quantity);
                    $event->sheet->setCellValue('D'.$i, @$val->created_at);
                    $event->sheet->setCellValue('E'.$i, @$val->updated_at);
                    $i++;
            }
        },
    ];
    }





}
