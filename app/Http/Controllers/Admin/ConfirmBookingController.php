<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Mail;

use App\Mail\SetPasswordMail;

use App\Models\Booking;
use App\Models\Mstipekos;
use App\Models\Penyewa;
use App\Models\Users;
use App\Models\Payments;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ConfirmBookingController extends Controller
{

    public function verifikasiBooking(){
        $pending = Booking::where('status', 'PENDING')->orderBy('created_at', 'asc')->get();
        $approved = Booking::where('status', 'APPROVED')->orderBy('created_at', 'asc')->get();
        $rejected = Booking::where('status', 'REJECTED')->orderBy('created_at', 'asc')->get();
        
        $tipe = Mstipekos::all();
        return view('admin.admin-verifikasi', compact('pending', 'approved', 'rejected', 'tipe'));
    }

    public function showKtp($filename){
        if (Storage::disk('local')->exists('ktp/' . $filename)) {
            $file = Storage::disk('local')->get('ktp/' . $filename);
            return Response::make($file, 200, [
                'Content-Type' => 'image/jpeg',  // Sesuaikan dengan tipe file
                'Content-Disposition' => 'inline; filename="' . $filename . '"',
            ]);
        }
        abort(404);
    }

    public function updateStatusBooking(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'status' => 'required|string',
            'room_number' => 'nullable|integer',
            'alasan_ditolak'=>'nullable|string',
        ]);
        
        DB::beginTransaction();
        try {
            $booking = Booking::find($request->id);
            $booking->status = $request->status;
            if ($request->status == "APPROVED") {
                $penyewa = Penyewa::create([
                    'email' => $booking->email,
                    'nama' => $booking->nama_lengkap,
                    'no_telepon' => $booking->no_hp,
                    'no_kamar' => $request->room_number,
                    'tipe_kos' => $booking->tipe_kos,
                    'alamat' => $booking->alamat,
                    'ktp' => $booking->ktp,
                    'status_penyewaan' => 1,
                    'tanggal_booking' => $booking->created_at->format('Y-m-d'),
                    'tanggal_menyewa' => $booking->periode_penempatan,
                    'tanggal_jatuh_tempo' => $booking->periode_penempatan,
                    'tanggal_berakhir' => null,
                ]);
                DB::table('users')->insert([
                    'id_penyewa' => $penyewa->id,
                    'email' => $booking->email,
                    'password' => null,
                ]);
                $tipekos = Mstipekos::where('id', $booking->tipe_kos)->first();
                DB::table('payments')->insert([
                    'id_kamar' => $request->room_number,
                    'id_penyewa' => $penyewa->id,
                    'periode_tagihan' => $booking->periode_penempatan,
                    'total_tagihan' => $tipekos->harga,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                DB::table('kamar')
                    ->where('id_kamar', $request->room_number)
                    ->update(['status' => 'T']);
                // dd("before email sent");
                Mail::to($booking->email)->send(new SetPasswordMail($booking,'approved',null));
                // dd("email sent");
            }
            if ($request->status == "REJECTED") {
                mail::to($booking->email)->send(new SetPasswordMail($booking,'rejected',$request->alasan_ditolak));
                
                // dd("email sent");
            }
            $booking->save();
            DB::commit();
            return redirect()->back()->with('success', 'Status booking berhasil diperbarui.');
        } catch (\Exception $e) {
            
            DB::rollBack();
            dd($e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }


    public function getKamarTersedia()
    {
        $kamarTersedia = Penyewa::where('status_penyewaan', 0)
                                ->whereNotNull('no_kamar')
                                ->distinct()
                                ->pluck('no_kamar');
    
        return response()->json($kamarTersedia);
    }

    public function penyewa()
    {
        $penghuniAktif = DB::table('penyewa')
            ->wherenull('tanggal_berakhir')
            ->get();

        $penghuniRiwayat = DB::table('penyewa')
        ->wherenotnull('tanggal_berakhir')
        ->get();
        $msTipe = DB::select("
                SELECT id, deskripsi
                FROM ms_tipe_kos
                ORDER BY id ASC
        ");

        return view('admin.admin-penyewa.adminpenyewa', compact('penghuniAktif', 'penghuniRiwayat', 'msTipe'));
    }

    public function updatePenyewa(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'nama' => 'required|string',
            'no_telepon' => 'required|string',
            'tipe_kos' => 'required|string',
            'alamat' => 'required|string',
            'tanggal_menyewa' => 'required|date',
            'tanggal_berakhir' => 'nullable|date',
            'no_kamar'=>'required',
            'status_penyewaan' => 'required|boolean',
            'ktp' => 'nullable|mimes:jpeg,png,jpg|max:2048',
        ]);
        $penyewa = Penyewa::find($request->id);
        if ($request->hasFile('ktp')) {
            $ktp = $request->file('ktp');
            $fileName =$request->email.'-'.time().'.'.$ktp->extension();
            $filePath = $ktp->storeAs('ktp', $fileName, 'local');
            if ($penyewa->ktp) {
                Storage::disk('local')->delete('ktp/' . $penyewa->ktp);
            }

            $penyewa->ktp = $fileName;
        }
        if(!$request->status_penyewaan){
            $penyewa->tanggal_berakhir = Carbon::now()->toDateString();
            DB::table('kamar')->where('id_kamar',$penyewa->no_kamar)->update(['status'=>'F']);
            DB::table('users')->where('email',$penyewa->email)->delete();
            $penyewa->status_penyewaan =$request->status_penyewaan;
        }
        if($penyewa->no_kamar != $request->no_kamar){
            DB::table('kamar')->where('id_kamar',$penyewa->no_kamar)->update(['status'=>'F']);
            DB::table('kamar')->where('id_kamar',$request->no_kamar)->update(['status'=>'T']);
            $penyewa->no_kamar= $request->no_kamar;
        }
        $penyewa->no_telepon = $request->no_telepon;
        $penyewa->tipe_kos = $request->tipe_kos;
        $penyewa->alamat = $request->alamat;
        $penyewa->tanggal_menyewa = $request->tanggal_menyewa;
        $penyewa->nama = $request->nama;
        
        $penyewa->save();
        return redirect()->back()->with('success', 'Data penyewa berhasil diperbarui.');
    }

    public function detailPenyewa($id = null){
        $detail = DB::table('penyewa')->where('id',$id)->first();

        return response()->json($detail, 200);

        
        
    }


}
