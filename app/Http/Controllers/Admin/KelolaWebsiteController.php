<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\select;

class KelolaWebsiteController extends Controller{
    public function ShowKelolaWebsite(){
        $panorama = DB::table('ms_panorama')->get();
        return view('admin.kelola-website.website',compact('panorama'));
    }

    public function PostPanorama(Request $request){
        $request->validate([
            'nama' => 'required|string|max:30',
            'gambar' => 'required|file|mimes:jpg,jpeg,png', 
            'yaw' => 'required|numeric|between:-180,180', 
            'pitch' => 'required|numeric|between:-90,90', 
            'hfov' => 'required|numeric|between:-120,-50'
        ]);
        $filename = '';
        $default  = 0;

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/panorama'), $filename);
            $cek=DB::table('ms_panorama')->exists();
            if(!$cek){
                $default = 1;
            }

            DB::table('ms_panorama')->insert([
                'text' => $request->input('nama'),
                'namafile' => $filename,
                'yaw' => $request->input('yaw'),
                'pitch' => $request->input('pitch'),
                'hfov' => $request->input('hfov')*-1,
                'default' => $default,
                // 'created_at' => now(), 
                // 'updated_at' => now()
            ]);
        }

        return redirect()->back();
    }

    public function DetailKelolaWebsite(Request $request){
        $request->validate([
            'id' => 'required|numeric'
        ]);
        
        $id = $request->input('id');
        
        $detail= null;
        $hotspots= null;
        if($id){
            $detail = DB::table('ms_panorama')->where('id',$id)->first();
            $hotspots = DB::select("
                SELECT h.*, p2.text AS text
                FROM ms_panorama p
                JOIN panorama_hotspots h ON h.id_panorama = p.id
                JOIN ms_panorama p2 ON h.scene = p2.id
                WHERE p.id =".$id);
        }
        
        return response()->json([
            'hotspots' => $hotspots, // Tidak perlu ->toArray()
            'detail' => $detail ?? [] // Jika null, kirim array kosong agar valid JSON
        ]);
    }


    public function SaveHotspots(Request $request){
        $request->validate([
            'id' => 'required|numeric',
            'yaw' => 'required|numeric',
            'pitch' => 'required|numeric',
            'hfov' => 'required|numeric',
            'hotspots' => 'array'
        ]);

        DB::table('ms_panorama')->where('id',$request->input('id'))
        ->update([
            'yaw'=>$request->input('yaw'),
            'pitch'=>$request->input('pitch'),
            'hfov'=>$request->input('hfov')*-1,
        ]);
        if($request->input('hotspots')){
            // var_dump($request->input('hotspots'));
            $a = 0;
            foreach($request->input('hotspots') as $h){
                if (isset($h['id'])) {
                    $a++;
                    DB::table('panorama_hotspots')->where('id',$h['id'])
                    ->update([
                        'pitch'=>$h['pitch'],
                        'yaw'=>$h['yaw'],
                        'scene'=>$h['scene'],
                    ]);
                }else if(isset($h['pitch']) && isset($h['yaw']) && isset($h['scene'])){
                    $a++;
                    DB::table('panorama_hotspots')->insert([
                        'id_panorama'=>$request->input('id'),
                        'pitch'=> $h['pitch'],
                        'yaw'=>$h['yaw'],
                        'scene'=>$h['scene']
                    ]);
                }
            }
        }
        return true;
    }

    public function DeleteHotspots(Request $request){
        $request->validate([
            'id' => 'required|numeric',
        ]);
        $deleted = DB::table('panorama_hotspots')->where('id',$request->input('id'))->delete();
        if ($deleted) {
            return response()->json(['message' => 'Data berhasil dihapus'], 200);
        } else {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
    }
}