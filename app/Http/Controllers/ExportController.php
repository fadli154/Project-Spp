<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Box\Spout\Common\Entity\Row;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;

class ExportController extends Controller
{
    public function siswaExport()
    {
        // Get data from the database
        $data = Siswa::with('kelas')->get();

        // Create the writer object
        $writer = WriterEntityFactory::createXLSXWriter();

        // Open the file handle
        $writer->openToBrowser('Data-Siswa.xlsx');

        // Write the header row
        $headerRow = WriterEntityFactory::createRowFromArray([
            'NISN', 'NIK', 'Nama Siswa', 'Kelas', 'Jenis Kelamin', 'Tempat Lahir'
        ]);
        $writer->addRow($headerRow);

        // Write the data rows
        foreach ($data as $item) {
            $dataRow = WriterEntityFactory::createRowFromArray([
                $item->nisn, $item->nik, $item->nama, $item->kelas->kelas, $item->jk, $item->tempat_lahir
            ]);
            $writer->addRow($dataRow);
        }

        // Close the file handle
        $writer->close();
    }
}
