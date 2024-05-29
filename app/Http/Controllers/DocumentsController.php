<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\Task;
use App\Models\TeamGuide;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
class DocumentsController extends Controller
{
    public function timeline(Request $request)
    {
        $tasks=Task::all();
        $documents=Document::where('team_id',$request->get('team')->id)->get();
        $array=[];
        $documents_tasks=[];
        $success_documents_tasks=[];
        foreach($documents as $document)
        {
            $array[$document->document_id]=$document->status;
            $dtype=$document->document_type;
            if(array_key_exists($dtype->task_id,$documents_tasks) && count($documents_tasks[$dtype->task_id]))
                array_push($documents_tasks[$dtype->task_id],$document);
            else
                $documents_tasks[$dtype->task_id]=[$document];
            if($document->status==2)
                if(array_key_exists($dtype->task_id,$success_documents_tasks) && count($success_documents_tasks[$dtype->task_id]))
                    array_push($success_documents_tasks[$dtype->task_id],$document);
                else
                    $success_documents_tasks[$dtype->task_id]=[$document];
        }
        return view('admin.timeline',compact('documents','array','tasks','documents_tasks','success_documents_tasks'));
    }
    public function upload(Request $request)
    {
        $request->validate([
            'doc[]'=>'file|mimes:pdf,jpg,bmp,png,jpeg,webp'],[
                'doc[]'=>'Documents must be of type pdf, jpg, jpeg, webp, png'
            ]);
        foreach($request->doc as $key=>$file)
        {
            $doc=new Document();
            $doc->submitted_by=auth()->user()->id;
            $doc->status=1;
            $doc->team_id=$request->get('team')->id;
            $doc->document_id=$key;
            $filename = intval(microtime(true)).'_'. $file->getClientOriginalName();
            $doc->filename=$filename;
            $file->move("upload/documents/", $filename);
            $doc->save();
        }
        return redirect()->back()->with('success','Docments Uploaded');
    }
    public function requests(Request $request)
    {
        $user=auth()->user();
        $documents=Document::where('status',1)->get();
        return view('admin.requests',['documents'=>$documents,'user'=>$user]);
    }
    public function action(Request $request)
    {
        $user=auth()->user();
        $request->validate([
            'docid'=>'required|numeric',
            'remarks'=>'string|nullable',
            'submit'=>'required'
        ]);
        $doc=Document::find($request->docid);
        if(!$user->guides->where('id',$doc->team_id)->count())
             abort(403);
         $doc->remarks=$request->remarks;
         $doc->status=$request->submit?2:3;
         $doc->save();
        return redirect('/documentApprovals')->with('success',$request->submit?'Document Approved':'Document Rejected');
    }
    public function cert(Request $request)
    {  
        $user=$request->get('user');
        $team=$request->get('team');
        $guides=TeamGuide::where('team_id',$team->id)->get();
        $pdf = Pdf::loadView('cert', ['name'=>$user->name,'guide'=>User::find($guides[0]->user_id)->name]);
        return $pdf->stream();
    }
}
