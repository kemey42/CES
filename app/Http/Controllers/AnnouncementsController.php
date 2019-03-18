<?php

namespace App\Http\Controllers;

use App\Announcement;
use Illuminate\Http\Request;

class AnnouncementsController extends Controller
{


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Announcement  $Announcement
     * @return \Illuminate\Http\Response
     */
    public function edit(Announcement $Announcement)
    {
        if ($Announcement->id != 1){
            return redirect('/')->with('error','Wrong Announcement ID');
        }
        return view('setup.announcement.edit')->with('announcement', $Announcement);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Announcement  $Announcement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Announcement $Announcement)
    {
        //to make sure every field defined below is added
        $this->validate($request,[
            'message' => 'required'
        ]);

        //find object id and save into db
        $newAnnouncement = Announcement::find($Announcement->id);
        $newAnnouncement->message = $request->input('message');
        $newAnnouncement->save();

        return redirect('/')->with('success','Announcement Updated');
    }


}
