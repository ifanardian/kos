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
use Illuminate\Support\Facades\DB;


class ConfirmBookingController extends Controller
{
    // public function index()
    // {
    //     $data = Booking::all();

    //     return view('admin.confirm-booking.index', compact('data'));   
    // }

    public function verifikasiBooking()
    {
        $data = Booking::orderByRaw("FIELD(status, 'PENDING') DESC")->orderBy('created_at', 'asc')->get();
        $tipe = Mstipekos::all();
        return view('admin.admin-verifikasi', compact('data', 'tipe'));
    }

    public function showKtp($filename)
    {
        if (Storage::disk('local')->exists('ktp/' . $filename)) {
            // Menyajikan file secara aman
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
        $booking = Booking::find($request->id);
        $booking->status = $request->status;
        
        if ($booking->status == "APPROVED") {
            // Add user to 'users' table with null password initially
            Users::create([
                'email' => $booking->email,
                'password' => null, // Password akan diatur oleh user
            ]);

            Penyewa::create([
                'email' => $booking->email,
                'nama' => $booking->nama_lengkap,
                'no_telepon' => $booking->no_hp,
                'no_kamar' => $request->room_number,
                'tipe_kos' => $booking->tipe_kos,
                'alamat' => $booking->alamat,
                'ktp' => $booking->ktp,
                'tanggal_booking' => $booking->created_at->format('Y-m-d'),
                'tanggal_menyewa' => $booking->periode_penempatan,
                'tanggal_jatuh_tempo' => $booking->periode_penempatan,
                'tanggal_berakhir' => null,
            ]);
            
            $tipekos = Mstipekos::where('id', $booking->tipe_kos)->first();

            DB::table('payments')->insert([
                'email' => $booking->email,
                'periode_tagihan' => $booking->periode_penempatan,
                'total_tagihan' => $tipekos->harga,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            Mail::to($booking->email)->send(new SetPasswordMail($booking));

        }

        $booking->save();
        return redirect()->back();
    }

    public function penyewa()
    {
        $data = Penyewa::all();
        return view('admin.admin-penyewa', compact('data'));
    }

    // fiona bikin status penyewa aktif/nonaktif
    // tolong cek dah benar pa blm
    // public function updatePenyewa(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email',
    //         'no_telepon' => 'required|string',
    //         'no_kamar' => 'required|string',
    //         'status' => 'required|boolean',
    //     ]);
    //     if ($request->status == 1) {
                
    //         $penyewa = DB::table('penyewa')
    //             ->where('email', $request->email)
    //             ->first();
    //         DB::table('penyewa')
    //             ->where('email', $request->email)
    //             ->update([
    //                 'status_penyewaan' => \Carbon\Carbon::parse($penyewa->status_penyewaan),
    //             ]);
            
    //     }else{
    //         DB::table('penyewa')
    //             ->where('email', $request->email)
    //             ->where('periode_tagihan', $request->periode_tagihan)
    //             ->update([
    //                 'status_penyewaan' => $request->status,
    //                 'tanggal_berakhir' => now(),
    //                 'updated_at' => now(),
    //             ]);
    //     }    
    //     return redirect()->back();
    // }

    // public function updatePenyewa(Request $request)
    // {
    //     $request->validate([
    //         'id' => 'required|integer',
    //         'nama' => 'required|string',
    //         'no_telepon' => 'required|string',
    //         'tipe_kos' => 'required|string',
    //         'alamat' => 'required|string',
    //         'tanggal_menyewa' => 'required|date',
    //         'tanggal_jatuh_tempo' => 'required|date',
    //         'status_penyewaan' => 'required|boolean',
    //     ]);

    //     Penyewa::where('id', $request->id)->update([
    //         'nama' => $request->nama,
    //         'no_telepon' => $request->no_telepon,
    //         'tipe_kos' => $request->tipe_kos,
    //         'alamat' => $request->alamat,
    //         'tanggal_menyewa' => $request->tanggal_menyewa,
    //         'tanggal_jatuh_tempo' => $request->tanggal_jatuh_tempo,
    //         'status_penyewaan' => $request->status_penyewaan,
    //     ]);

    //     return redirect()->back()->with('success', 'Data penyewa berhasil diperbarui.');
    // }

    public function updatePenyewa(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'id' => 'required|integer',
            'nama' => 'required|string',
            'no_telepon' => 'required|string',
            'tipe_kos' => 'required|string',
            'alamat' => 'required|string',
            'tanggal_menyewa' => 'required|date',
            'tanggal_berakhir' => 'nullable|date',
            'status_penyewaan' => 'required|boolean',
            'ktp' => 'nullable|mimes:jpeg,png,jpg|max:2048', // Validasi file
        ]);

        $penyewa = Penyewa::findOrFail($request->id);

        // Jika ada file KTP baru, simpan dan ganti file lama
        if ($request->hasFile('ktp')) {
            // $fileName = time() . '_' . $request->ktp->getClientOriginalName();
            // $request->ktp->storeAs('ktp', $fileName, 'local');
            $ktp = $request->file('ktp');
            $fileName =$request->email.'-'.time().'.'.$ktp->extension();
            $filePath = $ktp->storeAs('ktp', $fileName, 'local');
            

            // Hapus file lama jika ada
            if ($penyewa->ktp) {
                Storage::disk('local')->delete('ktp/' . $penyewa->ktp);
            }

            $penyewa->ktp = $fileName;
        }

        $penyewa->save();

        Penyewa::where('id', $request->id)->update([
            'nama' => $request->nama,
            'no_telepon' => $request->no_telepon,
            'tipe_kos' => $request->tipe_kos,
            'alamat' => $request->alamat,
            'tanggal_menyewa' => $request->tanggal_menyewa,
            'tanggal_berakhir' => $request->tanggal_berakhir,
            'status_penyewaan' => $request->status_penyewaan,
            'ktp' => $fileName,
        ]);

        return redirect()->back()->with('success', 'Data penyewa berhasil diperbarui.');
    }



}
