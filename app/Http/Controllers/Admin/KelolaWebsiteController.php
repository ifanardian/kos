<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MsPanorama;
use App\Models\PanoramaHotspot;

class KelolaWebsiteController extends Controller
{
    public function ShowKelolaWebsite()
    {
        $panorama = MsPanorama::all();
        return view('admin.kelola-website.website', compact('panorama'));
    }

    public function PostPanorama(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:30',
            'gambar' => 'required|file|mimes:jpg,jpeg,png',
            'yaw' => 'required|numeric|between:-180,180',
            'pitch' => 'required|numeric|between:-90,90',
            'hfov' => 'required|numeric|between:-120,-50'
        ]);

        $filename = '';
        $default = !MsPanorama::exists();

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/panorama'), $filename);

            MsPanorama::create([
                'text' => $request->nama,
                'namafile' => $filename,
                'yaw' => $request->yaw,
                'pitch' => $request->pitch,
                'hfov' => $request->hfov * -1,
                'default' => $default
            ]);
        }

        return redirect()->back();
    }

    public function DetailKelolaWebsite(Request $request)
    {
        $request->validate(['id' => 'required|numeric']);

        $detail = MsPanorama::find($request->id);
        $hotspots = PanoramaHotspot::where('id_panorama', $request->id)
            ->with('scenePanorama:id_panorama,text')
            ->get();

        return response()->json([
            'hotspots' => $hotspots,
            'detail' => $detail ?? []
        ]);
    }

    public function SaveHotspots(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric',
            'default' => 'string',
            'text' => 'required|string',
            'yaw' => 'required|numeric',
            'pitch' => 'required|numeric',
            'hfov' => 'required|numeric',
            'dihapus' => 'array',
            'hotspots' => 'array',
        ]);
        $panorama = MsPanorama::findOrFail($request->id);

        if ((int)$request->default == 1) {
            MsPanorama::query()->update(['default' => 0]);
            $panorama->update(['default' => 1]);
        }

        $panorama->update([
            'yaw' => $request->yaw,
            'pitch' => $request->pitch,
            'hfov' => $request->hfov * -1,
            'text' => $request->text
        ]);

        if ($request->hotspots) {
            // var_dump($request->hotspots);
            foreach ($request->hotspots as $h) {
                if (isset($h['id'])) {
                    PanoramaHotspot::where('id_hotspot', $h['id'])->update([
                        'pitch' => (float)$h['pitch'],
                        'yaw' => (float)$h['yaw'],
                        'scene' => (int)$h['scene'],
                    ]);
                } else if (isset($h['pitch'], $h['yaw'], $h['scene'])) {
                    PanoramaHotspot::create([
                        'id_panorama' => $request->id,
                        'pitch' => (float)$h['pitch'],
                        'yaw' => (float)$h['yaw'],
                        'scene' => (int)$h['scene']
                    ]);
                }
            }
        }

        if ($request->dihapus) {
            PanoramaHotspot::whereIn('id_hotspot', $request->dihapus)->delete();
        }

        return true;
    }

    public function DeletePanorama(Request $request)
    {
        $request->validate(['id' => 'required|numeric']);
        
        $panorama = MsPanorama::findOrFail($request->id);
        
        if ($panorama->default) {
            $newDefault = MsPanorama::where('id_panorama', '!=', $request->id)
                ->orderBy('id_panorama', 'asc')
                ->first();

            if ($newDefault) {
                $newDefault->update(['default' => 1]);
            }
        }

        PanoramaHotspot::where('id_panorama', $request->id)
            ->orWhere('scene', $request->id)
            ->delete();

        $panorama->delete();

        return response()->json(['message' => 'Data berhasil dihapus'], 200);
    }
}
