<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Tagihan;
use App\Models\Pembayaran;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Box\Spout\Common\Entity\Row;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;

class LaporanController extends Controller
{
    public function laporanPembayaran(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        if ($request['start_date'] || $request['end_date']) {
            $request->validate([
                'start_date' => 'required|date',
                'end_date' => 'required|date',
            ]);
            $pembayaranList = Pembayaran::whereBetween('created_at', [
                $startDate, $endDate
            ])->get();
            // dd($pembayaranList);
            $tagihanList = Tagihan::with('siswa')->groupBy('nisn')->get();
            $kelasList = Kelas::get();
        } else {
            $pembayaranList =
                Pembayaran::whereBetween('created_at', [
                    $startDate, $endDate
                ])->get();;
            $tagihanList = null;
            $kelasList = null;
        }

        return view('/pembayaran.pembayaran.laporan_pembayaran', [
            'title' => 'Admin',
            'active' => 'laporan-pembayaran',
            'active1' => 'laporan',
            'dataList' => $pembayaranList,
            'tagihanList' => $tagihanList,
            'kelasList' => $kelasList,
            'startDate' => $startDate,
            'endDate' => $endDate,
        ]);
    }

    public function pembayaranExport(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $pembayaranList = Pembayaran::whereBetween('created_at', [$startDate, $endDate])->get();

        // Create the writer object
        $writer = WriterEntityFactory::createXLSXWriter();

        // Open the file handle
        $writer->openToBrowser('Laporan-pembayaran-' . $startDate . ' sampai ' . $endDate . '.xlsx');

        // Write the header row
        $headerRow = WriterEntityFactory::createRowFromArray([
            'Nama Siswa', 'Kelas', 'Jumlah Dibayar', 'Tanggal Bayar', 'Status Konfirmasi',
        ]);
        $writer->addRow($headerRow);

        // Write the data rows
        foreach ($pembayaranList as $item) {
            $tagihanList = Tagihan::with('Siswa')->where('id', $item->tagihan_id)->get();
            foreach ($tagihanList as $itemTagihan) {
                $tanggal_bayar = date('d/m/Y', strtotime($item->tanggal_bayar));
                $dataRow = WriterEntityFactory::createRowFromArray([
                    $itemTagihan->siswa->nama, $itemTagihan->siswa->nisn, $item->jumlah_dibayar, $tanggal_bayar,  $item->status_konfirmasi,
                ]);
                $writer->addRow($dataRow);
            }
        }

        // Close the file handle
        $writer->close();
    }
}
