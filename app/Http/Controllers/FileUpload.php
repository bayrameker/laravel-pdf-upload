<?php

namespace App\Http\Controllers;

use App\Models\FileUploads;
use Illuminate\Http\Request;

class FileUpload extends Controller {

    function index() {
        $allfiles = FileUploads::orderBy('id', 'desc')->limit(10)->get();
        return view('fileUpload', compact('allfiles'));
    }

    function upload_pdf(Request $request) {
        if ($request->hasFile('pdfFile')) {

            $this->validate($request, [
                'pdfFile' => 'required|mimes:pdf|max:10000',
            ]);


            $path = public_path('pdf');
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }


            $pdfFile = $request->file('pdfFile');
            $fullName = uniqid('pdfFile_');
            $filename = $fullName . '_' . time() . '.' . $pdfFile->getClientOriginalExtension();
            $pdfFile->move(public_path() . '/pdf', $filename);


            $fileUploads = new \App\Models\FileUploads();
            $fileUploads->file_name = $filename;
            $fileUploads->save();

            return redirect()->back()->with('success', 'Successfully Uploaded');
        }

        return redirect()->back()->with('error', 'Something went wrong');
    }

    function getView(Request $request) {
        $res = new \stdClass();
        $res->message = "success";
        $res->flag = 1;

        if ($request->has('id')) {

            $document_name = FileUploads::where('id', $request->input('id'))->first();

            if ($document_name) {
                $file = public_path() . '/pdf/' . $document_name->file_name;
                if (file_exists($file)) {
                    $res->file_url = url('pdf/' . $document_name->file_name);
                } else {
                    $res->message = "File not exist";
                    $res->flag = 0;
                }
            } else {
                $res->message = "Something went wrong";
                $res->flag = 0;
            }
        }
        
        return $res;
    }

}
