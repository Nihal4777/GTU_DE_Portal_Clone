<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Team;
use App\Models\TeamGuide;
use App\Models\TeamMember;
class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $user=auth()->user();
        if(!$user->hasRole('Guide'))
            abort(403);
        $teams=$user->guides->where('status',2); //Fetch Accepted Requests
        return view('admin.team.index',['teams'=>$teams,'user'=>$user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user=auth()->user();
        if(Team::where('submitted_by',$user->id)->get()->count())
            return redirect('/dashboard')->withErrors("Already have one request");
        $guides=User::role('Guide')->get();
        return view('admin.team.create',['user'=>$user,'guides'=>$guides]);
    }  
    public function fetch(Request $request)
    {
        // $user=auth()->user();
        $request->validate(['id'=>'required|numeric']);
        if(!($user=User::role('Student')->find($request->id)))
            return response()->json(['success'=>false,]);
            return response()->json(['success'=>true,'id'=>$user->id,'name'=>$user->name,'email'=>$user->email]);
    }
    public function requests(Request $request)
    {
        $user=auth()->user();
        $teams=$user->guides->where('status',1); //Fetch Pending Requests
        return view('admin.team.requests',['user'=>$user,'teams'=>$teams]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user=auth()->user();
        //Validations
        $request->validate([
            'title'=>'required|string',
            'projectDesc'=>'required',
            'guides'=>'required|exists:Users,id',
            'memberId'=>'required|exists:Users,id'
        ]);
        // $req=new \App\Models\Request();
        // $req->type=1;
        // $req->submitted_by=$user->id;
        // $req->status=1;
        // $req->save();
        $team=new Team();
        $team->title=$request->title;
        $team->description=$request->projectDesc;
        $team->submitted_by=$user->id;
        $team->status=1;
        $team->save();
        foreach ($request->guides as $guide)
        {
            $reqGuide=new TeamGuide();
            $reqGuide->user_id=$guide;
            $reqGuide->team_id=$team->id;
            $reqGuide->save();
        } 
        foreach($request->memberId as $id)
        {
            $member=new TeamMember();
            $member->team_id=$team->id;
            $member->user_id=$id;
            $member->save();
        }
        return redirect('/dashboard')->with('status', 'Team Registration Request Submitted!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user=auth()->user();
        $isGuide=$user->hasRole("Guide");
        if($isGuide)
        {
            if(!$user->guides->where('id',$id)->count())
             abort(403);
            $team=Team::find($id);
            return view('admin.team.view',['team'=>$team,'user'=>$user]);
        }
    }
    public function action(Request $request)
    {
        $user=auth()->user();
        $request->validate([
            'teamid'=>'required|numeric',
            'remarks'=>'string|nullable',
            'submit'=>'required'
        ]);
        if(!$user->guides->where('id',$request->teamid)->count())
             abort(403);
         $team=Team::find($request->teamid);
         $team->remarks=$request->remarks;
         $team->status=$request->submit?2:3;
         $team->save();
        return redirect('/teamRegistrationRequests')->with('success',$request->submit?'Team Approved':'Team Rejected');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
