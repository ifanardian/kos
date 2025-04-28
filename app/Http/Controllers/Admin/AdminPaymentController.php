<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Mail;
use App\Models\Payment;
use App\Models\Penyewa;
use App\Models\MsTipeKos;
use App\Mail\InvoiceMail;
use App\Mail\AlertPaymentMail;
use Carbon\Carbon;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class AdminPaymentController extends Controller
{
    public function showPayment(Request $request)
    {
        $query = Payment::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
        
            $query->where(function($q) use ($search) {
                $q->whereHas('penyewa', function($sub) use ($search) {
                    $sub->where('email', 'like', "%$search%")
                        ->orWhere('nama', 'like', "%$search%")
                        ->orWhere('no_kamar', 'like', "%$search%");
                })->orWhere('periode_tagihan', 'like', "%$search%");
            });
        }
        
        if ($request->start_date) {
            $query->whereDate('tanggal_pembayaran', '>=', $request->start_date);
        }

        if ($request->end_date) {
            $query->whereDate('tanggal_pembayaran', '<=', $request->end_date);
        }

        if ($request->has('status')) {
            switch ($request->status) {
                case '1':
                case '0':
                    $query->where('status_verifikasi', $request->status);
                    break;
                case 'null':
                    $query->whereNull('status_verifikasi');
                    break;
                default:
                    break;
            }
        }

        // $data = $query->orderBy('status_verifikasi', 'desc')
        //     ->orderBy('periode_tagihan', 'desc')
        //     ->get();

        // Tambahkan sorting
        $sortable = ['email', 'nama', 'no_kamar', 'tanggal_pembayaran', 'periode_tagihan', 'total_tagihan', 'metode_pembayaran', 'status_verifikasi'];
        $sort = $request->get('sort', 'status_verifikasi');
        $direction = $request->get('direction', 'desc');

        if (in_array($sort, $sortable)) {
            if (in_array($sort, ['email', 'nama', 'no_kamar'])) {
                $query->join('penyewa', 'penyewa.id_penyewa', '=', 'payment.id_penyewa')
                    ->orderBy("penyewa.$sort", $direction)
                    ->select('payment.*');
            } else {
                $query->orderBy($sort, $direction);
            }
        }

        $data = $query->get();


        return view('admin.verifikasi-pembayaran.admin-riwayat', compact('data'));
    }

    public function actionPayment(Request $request)
    {
        $request->validate([
            'id_penyewa' => 'required|integer',
            'periode_tagihan' => 'required|string',
            'created_at' => 'required|date',
            'status' => 'required|boolean',
        ]);

        $penyewa = Penyewa::findOrFail($request->id_penyewa);

        if ($request->status == 1) {
            $langganan = MsTipeKos::findOrFail($penyewa->tipe_kos);
            $penyewa->update([
                'tanggal_jatuh_tempo' => Carbon::parse($request->periode_tagihan)->addMonths($langganan->bulan)->format('Y-m-d'),
            ]);
        }

        Payment::where('id_penyewa', $request->id_penyewa)
            ->where('periode_tagihan', $request->periode_tagihan)
            ->where('created_at', $request->created_at)
            ->update([
                'status_verifikasi' => $request->status,
                'updated_at' => now(),
            ]);

        Mail::to($penyewa->email)->send(new InvoiceMail($penyewa, $request->status));
        
        return redirect()->back();
    }

    public function showbuktitf($filename)
    {   
        // $email = explode('-', $filename)[0];
        // $filePath = "bukti pembayaran/{$email}/{$filename}";

        // if (Storage::disk('local')->exists($filePath)) {
        //     return Response::make(Storage::disk('local')->get($filePath), 200, [
        //         'Content-Type' => 'image/jpeg',
        //         'Content-Disposition' => 'inline; filename="' . $filename . '"',
        //     ]);
        // }
        
        // abort(404);
        $email = explode('-', $filename)[0];

        try {
            // Attempt to retrieve the image from Cloudinary
            $imageUrl = Cloudinary::getUrl("kos/bukti_tf/{$filename}");

            return redirect($imageUrl);
        } catch (\Exception $e) {
            // Handle the error (e.g., image not found)
            abort(404);
        }
    }

    public function getHistoryPembayaran($id_penyewa)
    {
        $paymentCount = Payment::where('id_penyewa', $id_penyewa)
            ->selectRaw('SUM(CASE WHEN status_verifikasi IS NULL THEN 1 ELSE 0 END) AS tagihan_belum_terverifikasi')
            ->selectRaw('COUNT(*) AS total_tagihan')
            ->first();
        
        $isFirstPayment = $paymentCount->total_tagihan == 1 && $paymentCount->tagihan_belum_terverifikasi == 1;
        // var_dump($isFirstPayment);
        return response()->json([
            'data' => Payment::where('id_penyewa', $id_penyewa)
                ->orderBy('periode_tagihan', 'desc')
                ->get(),
            'isFirstPayment' => $isFirstPayment
        ]);
    }

    public function makeTagihPembayaran(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
        ]);
        
        $penyewa = Penyewa::findOrFail($request->id);
        Mail::to($penyewa->email)->send(new AlertPaymentMail($penyewa));
        
        return redirect()->back();
    }
}
