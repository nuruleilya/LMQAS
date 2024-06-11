<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livestock;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Http;

class LivestockController extends Controller
{
    public function home()
    {
        $datas = Livestock::orderBy('created_at', 'desc')->get();
        return view('ManageLivestock.home', compact('datas'));
    }

    public function index()
    {
        if (Auth::user()->role == 'admin') {
            $datas = Livestock::orderBy('created_at', 'desc')->get();
        } elseif (Auth::user()->role == 'seller') {
            $datas = Livestock::where('publisher_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        }
        return view('ManageLivestock.index', compact('datas'));
    }

    public function view($id)
    {
        $data = Livestock::find($id);
        return view('ManageLivestock.view', compact('data'));
    }

    public function create()
    {
        return view('ManageLivestock.create');
    }

    public function show($id)
    {
        $data = Livestock::find($id);
        return view('ManageLivestock.show', compact('data'));
    }

    public function edit($id)
    {
        $data = Livestock::find($id);
        return view('ManageLivestock.edit', compact('data'));
    }

    private function fetchAndReturnPdf(Livestock $livestock)
    {
        $response = Http::get($livestock->file);

        if ($response->status() == 200) {
            return response($response->body(), 200, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="' . $livestock->file . '"',
            ]);
        } else {
            return back()->with('error', 'Failed to retrieve PDF. Please try again later');
        }
    }

    public function pdf($id)
    {
        $data = Livestock::find($id);
        if (!$data || !$data->file) {
            return back()->with('error', 'PDF is Not Viewable/Available.');
        }

        if (File::exists(public_path('files/' . $data->file))) {
            return response()->file(public_path('files/' . $data->file), [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="' . $data->file . '"',
            ]);
        } elseif (strpos($data->file, 'https') === 0) {
            return $this->fetchAndReturnPdf($data);
        }
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|max:255',
                'description' => 'required',
                'category' => 'required',
                'breed_type' => 'required',
                'price' => 'required',
                'age' => 'required',
                'weight' => 'required',
                'quantity' => 'required|integer|min:0', 
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ],
            [
                'category.required' => 'The category must be selected',
            ]
        );

        $uploadedImageUrl = $request->file('image')->store('public/images');

      //  $uploadedImageUrl = null;
       // $directoryPath = public_path('images');

        //if (!File::exists($directoryPath)) {
        //    File::makeDirectory($directoryPath, 0755, true);
       //}

       // if ($request->hasFile('image')) {
          //  try {
          //      $uploadedImage = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
           // } catch (\Exception $e) {
          //      Log::error('Image upload error: ' . $e->getMessage());
          //      return back()->with('error', 'Image upload failed. Please try again.');
          //  }
      //  }

            Livestock::create([
            'publisher_id' => Auth::user()->id,
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'breed_type' => $request->breed_type,
            'price' => $request->price,
            'age' => $request->age,
            'weight' => $request->weight,
            'quantity' => $request->quantity,
            'image' => $uploadedImageUrl,

            ]);

        return redirect()->route('livestocks-list')
            ->with('success', 'Livestock added successfully.');
    }

    public function update(Request $request, $id)
    {
        $livestock = Livestock::findOrFail($id);

        $request->validate(
            [
                'title' => 'required|max:255',
                'description' => 'required',
                'category' => 'required',
                'breed_type' => 'required',
                'price' => 'required',
                'age' => 'required',
                'weight' => 'required',
                'quantity' => 'required|integer|min:0',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
           ],
            [
                'category.required' => 'The category must be selected',
            ]
        );

        $directoryPath = public_path('images');

        if (!File::exists($directoryPath)) {
          File::makeDirectory($directoryPath, 0755, true);
        }

        $imageName = $livestock->image;

        if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
            try{
                $uploadedImageUrl = Cloudinary::upload($request->file('image')->getRealPath(), ['public_id' =>$imageName])->getSecurePath();
                if ($livestock->image && File::exists($directoryPath . '/' . $livestock->image)) {
                   File::delete($directoryPath. '/' . $livestock->file);
                }
            } catch (\Exception $e) {
                  Log::error('Image upload error: ' . $e->getMessage());
                return back()->with('error', 'Image upload failed. Please try again.');
            } 
        }  

        $livestock->update([
            'publisher_id' => Auth::user()->id,
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'breed_type' => $request->breed_type,
            'price' => $request->price,
            'age' => $request->age,
            'weight' => $request->weight,
            'quantity' => $request->quantity,
            'image' => $uploadedImageUrl ?? $imageName,

        ]);

        return redirect()->route('livestocks-list')
            ->with('success', 'Livestock updated successfully');
    }

    public function addToCart(Request $request, $id)
    {
    
        $livestock = Livestock::findOrFail($id);

        $cartItem = CartItem::create([
            'user_id' => Auth::user()->id,
            'livestock_id' => $livestock->id,
            'quantity' => $request->quantity,
        ]);

        $request->validate([
            'quantity' => 'required|integer|min:1', // Ensure quantity is provided and greater than zero
        ]);

        return redirect()->route('cart.index')->with('success', 'Livestock added to cart successfully.');
    }


    public function destroy($id)
    {
        Livestock::find($id)->delete();

        return redirect()->route('livestocks-list')
            ->with('success', 'Livestock deleted successfully');
    }
}
