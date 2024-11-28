<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoiceMail;


class ConfirmBookingController extends Controller
{
    public function index()
    {
        $data = Booking::all();

        return view('admin.confirm-booking.index', compact('data'));   
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
        $booking->save();
        if($booking->status == "APPROVED"){
            Mail::to($booking->email)->send(new InvoiceMail($booking));
        }
        return redirect()->back();
    }
}
