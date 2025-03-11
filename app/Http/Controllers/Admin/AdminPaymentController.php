<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
class AdminPaymentController extends Controller
{
    public function showPayment()
    {
        // dd('masuk');
        $data =  DB::table('payments')
            ->orderby('status_verifikasi', 'desc')
            ->orderBy('periode_tagihan', 'desc')
            ->get();
        // dd($payment);
        return view('admin.verifikasi-pembayaran.admin-riwayat', compact('data'));
    }

    public function actionPayment(Request $request)
    {
        // dd($request->all()); 
        $request->validate([
            'id_penyewa' => 'required|integer',
            'periode_tagihan' => 'required|string',
            'status' => 'required|boolean',
        ]);
        if ($request->status == 1) {
                
            $penyewa = DB::table('penyewa')
                ->where('id', $request->id_penyewa)
                ->first();
            $langganan = DB::table('ms_tipe_kos')
                ->where('id', $penyewa->tipe_kos)
                ->first();
            DB::table('penyewa')
                ->where('id', $request->id_penyewa)
                ->update([
                    'tanggal_jatuh_tempo' => \Carbon\Carbon::parse($penyewa->tanggal_jatuh_tempo)->addMonths($langganan->bulan)->format('Y-m-d'),
                ]);
            
            // dd($request->all());
            if ($request->metode_pembayaran == 'Transfer') {
                DB::table('payments')
                ->where('id_penyewa', $request->id_penyewa)
                ->where('periode_tagihan', $request->periode_tagihan)
                ->update([
                    'status_verifikasi' => $request->status,
                    'updated_at' => now(),
                ]);  
            }else{
                DB::table('payments')
                ->where('id_penyewa', $request->id_penyewa)
                ->where('periode_tagihan', $request->periode_tagihan)
                ->update([
                    'tanggal_pembayaran' => date('Y-m-d'),
                    'status_verifikasi' => $request->status,
                    'updated_at' => now(),
                ]);
            }
        }else{
            DB::table('payments')
                ->where('id_penyewa', $request->id_penyewa)
                ->where('periode_tagihan', $request->periode_tagihan)
                ->update([
                    'status_verifikasi' => $request->status,
                    'updated_at' => now(),
                ]);
        }    
        return redirect()->back();
    }

    public function showbuktitf($filename)
    {   
        $email = explode('-', $filename)[0];
        // dd($email);
        if (Storage::disk('local')->exists('bukti pembayaran/'.$email.'/' . $filename)) {
            // Menyajikan file secara aman
            $file = Storage::disk('local')->get('bukti pembayaran/'.$email.'/' . $filename);
            return Response::make($file, 200, [
                'Content-Type' => 'image/jpeg',  // Sesuaikan dengan tipe file
                'Content-Disposition' => 'inline; filename="' . $filename . '"',
            ]);
        }
        abort(404);
    }

    public function getHistoryPembayaran($id){
        $data = DB::table('payments')
            ->where('id_penyewa', $id)
            ->orderBy('periode_tagihan', 'desc')
            ->get();
        
        return response()->json($data);
    }
}
