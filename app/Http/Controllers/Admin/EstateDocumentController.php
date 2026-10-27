<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EstateDocument;
use App\Models\EstateMatter; // Add this
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class EstateDocumentController extends Controller
{
    public function index()
    {
        $documents = EstateDocument::latest()->paginate(10);
        $matters = EstateMatter::orderBy('estate_matter')->get(); // Fetch estates for the dropdown
        return view('admin.documents.index', compact('documents', 'matters'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'estate_matter_id' => 'required|exists:estate_matters,id',
            'document_type' => 'required|string',
            'title' => 'nullable|string|max:255',
            'file' => 'required|mimes:pdf|max:10000',
            'is_public' => 'boolean'
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();
            $size = $file->getSize();
            $assetId = Str::random(32); 
            
            $file->storeAs('documents', $assetId . '.pdf', 'public');

            EstateDocument::create([
                'estate_matter_id' => $request->estate_matter_id,
                'document_type' => $request->document_type,
                'asset_id' => $assetId,
                'title' => $request->title ?? $request->document_type, // Fallback to type if title is empty
                'description' => $request->description,
                'filename' => $filename,
                'size' => $size,
                'is_public' => $request->has('is_public') ? true : false,
            ]);

            return back()->with('success', 'Document uploaded successfully.');
        }

        return back()->with('error', 'File upload failed.');
    }

    public function update(Request $request, EstateDocument $document)
    {
        $request->validate([
            'estate_matter_id' => 'required|exists:estate_matters,id',
            'document_type' => 'required|string',
            'title' => 'nullable|string|max:255',
            'file' => 'nullable|mimes:pdf|max:10000',
        ]);

        $data = [
            'estate_matter_id' => $request->estate_matter_id,
            'document_type' => $request->document_type,
            'title' => $request->title ?? $request->document_type,
            'description' => $request->description,
            'is_public' => $request->has('is_public') ? true : false,
        ];

        if ($request->hasFile('file')) {
            Storage::disk('public')->delete('documents/' . $document->asset_id . '.pdf');
            $file = $request->file('file');
            $newAssetId = Str::random(32);
            $file->storeAs('documents', $newAssetId . '.pdf', 'public');
            $data['asset_id'] = $newAssetId;
            $data['filename'] = $file->getClientOriginalName();
            $data['size'] = $file->getSize();
        }

        $document->update($data);
        return back()->with('success', 'Document updated successfully.');
    }

    public function destroy(EstateDocument $document)
    {
        Storage::disk('public')->delete('documents/' . $document->asset_id . '.pdf');
        $document->delete();
        return back()->with('success', 'Document deleted successfully.');
    }
}