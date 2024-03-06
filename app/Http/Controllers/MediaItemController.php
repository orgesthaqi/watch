<?php

namespace App\Http\Controllers;

use App\Models\MediaItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;

class MediaItemController extends Controller
{
    public function index()
    {
        $media_items = MediaItem::orderBy('created_at', 'DESC')->paginate(25);

        return view('media_items.index', compact('media_items'));
    }

    public function create()
    {
        return view('media_items.create');
    }

    public function edit($id)
    {
        $mediaItem = MediaItem::find($id);

        return view('media_items.edit', compact('mediaItem'));
    }

    public function store(Request $request)
    {
        $mediaItemId = $request->media_item_id;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = str_replace('.'.$extension, '', $file->getClientOriginalName()); //file name without extenstion
            $fileName .= '_' . md5($mediaItemId) . '.' . $extension; // a unique file name

            $disk = Storage::disk(config('filesystems.default'));
            $path = $disk->putFileAs('media/' . $mediaItemId, $file, $fileName);
        }

        $mediaItem = new MediaItem();
        $mediaItem->sort = MediaItem::max('sort') + 1;
        $mediaItem->uuid = $mediaItemId;
        $mediaItem->featured = $request->featured;
        $mediaItem->title = $request->title;
        $mediaItem->path = $request->media_path;
        $mediaItem->image = $fileName;
        $mediaItem->save();

        return redirect()->route('home');
    }

    public function uploadMedia(Request $request) {
        $receiver = new FileReceiver('file', $request, HandlerFactory::classFromRequest($request));

        if (!$receiver->isUploaded()) {
            // file not uploaded
        }

        $fileReceived = $receiver->receive(); // receive file
        if ($fileReceived->isFinished()) { // file uploading is complete / all chunks are uploaded
            $file = $fileReceived->getFile(); // get file
            $extension = $file->getClientOriginalExtension();
            $fileName = str_replace('.'.$extension, '', $file->getClientOriginalName()); //file name without extenstion
            $mediaItemId = time(); // This will give you a Unix timestamp
            $fileName .= '_' . md5($mediaItemId) . '.' . $extension; // a unique file name

            $disk = Storage::disk(config('filesystems.default'));
            $path = $disk->putFileAs('media/' . $mediaItemId, $file, $fileName);

            // delete chunked file
            unlink($file->getPathname());
            return [
                'path' => asset('storage/' . $path),
                'filename' => $fileName,
                'mediaItemId' => $mediaItemId
            ];
        }

        // otherwise return percentage informatoin
        $handler = $fileReceived->handler();
        return [
            'done' => $handler->getPercentageDone(),
            'status' => true
        ];
    }

    public function show($id, $filename)
    {
        $filePath = storage_path('app/private/media/'.$id.'/'. $filename);

        return response()->file($filePath);
    }

    public function destroy($id)
    {
        $mediaItem = MediaItem::find($id);
        $mediaItem->delete();

        // delete the file from the storage based on uuid
        $disk = Storage::disk(config('filesystems.default'));
        $disk->deleteDirectory('media/' . $mediaItem->uuid);

        return redirect()->route('media_items.index');
    }

    public function updateFeatured(Request $request)
    {
        $mediaItem = MediaItem::find($request->id);
        $mediaItem->featured = $request->featured;
        $mediaItem->save();

        return response()->json(['success' => true]);
    }
}
