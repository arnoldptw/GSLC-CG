<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function index()
    {
        return view('upload');
    }

    public function process(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg',
            'filter' => 'required|in:grayscale,blur',
        ]);

        // Simpan gambar asli
        $image = $request->file('image');
        $path = $image->store('images');

        // Manipulasi pixel by pixel
        $imagePath = Storage::path($path);
        $originalImage = imagecreatefromstring(file_get_contents($imagePath));

        // Tentukan filter
        $width = imagesx($originalImage);
        $height = imagesy($originalImage);
        $newImage = imagecreatetruecolor($width, $height);

        if ($request->filter === 'grayscale') {
            for ($x = 0; $x < $width; $x++) {
                for ($y = 0; $y < $height; $y++) {
                    $rgb = imagecolorat($originalImage, $x, $y);
                    $colors = imagecolorsforindex($originalImage, $rgb);
                    $gray = ($colors['red'] + $colors['green'] + $colors['blue']) / 3;
                    $color = imagecolorallocate($newImage, $gray, $gray, $gray);
                    imagesetpixel($newImage, $x, $y, $color);
                }
            }
        } elseif ($request->filter === 'blur') {
            // Implementasikan algoritma blur sederhana (misalnya average dari tetangga pixel)
            for ($x = 1; $x < $width - 1; $x++) {
                for ($y = 1; $y < $height - 1; $y++) {
                    $sumR = $sumG = $sumB = 0;
                    for ($dx = -1; $dx <= 1; $dx++) {
                        for ($dy = -1; $dy <= 1; $dy++) {
                            $rgb = imagecolorat($originalImage, $x + $dx, $y + $dy);
                            $colors = imagecolorsforindex($originalImage, $rgb);
                            $sumR += $colors['red'];
                            $sumG += $colors['green'];
                            $sumB += $colors['blue'];
                        }
                    }
                    $avgR = $sumR / 9;
                    $avgG = $sumG / 9;
                    $avgB = $sumB / 9;
                    $color = imagecolorallocate($newImage, $avgR, $avgG, $avgB);
                    imagesetpixel($newImage, $x, $y, $color);
                }
            }
        }

        // Simpan gambar hasil
        $outputPath = str_replace('.jpg', '_edited.jpg', $path);
        imagejpeg($newImage, Storage::path($outputPath));
        imagedestroy($originalImage);
        imagedestroy($newImage);

        return view('result', [
            'original' => Storage::url($path),
            'edited' => Storage::url($outputPath),
        ]);
    }
}
