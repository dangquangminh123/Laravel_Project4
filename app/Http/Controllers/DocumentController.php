<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use File;
use Storage;

class DocumentController extends Controller
{
    public function create_folder(){
        Storage::cloud()->makeDirectory('document_new');   
    }

    public function create_document(){
        Storage::cloud()->put('test.txt','Hello World');
    }

    public function upload_file(){
        $filename = 'Anthony Robbins';
        $filePath = public_path('uploads/document/Đánh thức con người phi thường trong bạn45.pdf');
        $fileData = File::get($filePath);
        Storage::cloud()->put($filename, $fileData);
        return 'File PDF Uploaded';
    }

    public function upload_image(){
        $filename = 'Chapter4-567xdvc';
        $filePath = public_path('frontend/images/chapter/Chapter4-567xdvc.jpg');
        $fileData = File::get($filePath);
        Storage::cloud()->put($filename, $fileData);
        return 'Image Uploaded';
    }

    public function list_document(){
        $dir = '/';
        $recursive = true;
        $contents = collect(Storage::cloud()->listContents($dir, $recursive))->where('type','!=','dir');
        return $contents;
    }

    public function upload_video(){
        $filename = 'video1';
        $filePath = public_path('frontend/images/samplevideo.mp4');
        $fileData = File::get($filePath);
        Storage::cloud()->put($filename, $fileData);
        return 'Video Updated';
    }

    public function rename_folder(){
        $folderinfo = collect(Storage::cloud()->listContents('/', false))
        ->where('type','dir')
        ->where('name','document')
        ->fisrt();
        Storage::cloud()->move($folderinfo['path'],'Storage');
        alert('rename folder');
    }

    public function delete_folder(){
        $folderinfo = collect(Storage::cloud()->listContents('/', false))
        ->where('type','dir')
        ->where('name','Storage')
        ->fisrt();
        Storage::cloud()->delete($folderinfo['path'],'document');
        alert('rename folder');
    }

    public function read_data(){
        $dir = '/';
        $recursive = false;
        $contents = collect(Storage::cloud()->listContents($dir, $recursive))->where('type','!=','dir');
        return view('admin.document.read')->with(compact('contents'));
    }
}
