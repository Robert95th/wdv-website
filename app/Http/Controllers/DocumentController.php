<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\EstateDocument;


class DocumentController extends Controller
{
    public function index()
    {
        // Fetch only public documents, ordered by newest first
        $documents = EstateDocument::where('is_public', true) // Changed here
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($doc) {
                return [
                    'id' => $doc->id,
                    'assetId' => $doc->asset_id,
                    'title' => $doc->title,
                    'description' => $doc->description,
                    'filename' => $doc->filename,
                    'size' => $doc->size,
                ];
            });

        return view('documents', compact('documents'));
    }
}
