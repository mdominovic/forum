<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use Notification;
use App\User;
use App\Discussion;
use App\Reply;
use Illuminate\Http\Request;

class DiscussionsController extends Controller
{
    public function create()
    {
        return view('discuss');
    }

    public function store()
    {
        $r = request();

        $this->validate($r, [
            'channel_id' => 'required',
            'title' => 'required',
            'content' => 'required'
        ]);

        $discussion = Discussion::create([
            'title' => $r->title,
            'content' => $r->content,
            'channel_id' => $r->channel_id,
            'user_id' => Auth::id(),
            'slug' => str_slug($r->title)
        ]);

        Session::flash('success', 'Discussion successfully created.');

        return redirect()->route('discussion', ['slug' => $discussion->slug]);
    }

    public function show($slug)
    {
        $discussion = Discussion::where('slug', $slug)->first();

        $best_answer = $discussion->replies()->where('best_answer', 1)->first();

        return view('discussions.show')->with('d', $discussion)->with('best_answer', $best_answer);
    }

    public function reply($id)
    {
        $d = Discussion::find($id);

        $reply = Reply::create([
            'user_id' => Auth::id(),
            'discussion_id' => $id,
            'content' => request()->reply
        ]);

        $watchers = array();

        foreach ($d->watchers as $watcher) {
            array_push($watchers, User::find($watcher->user_id));
        }

        Notification::send($watchers, new \App\Notifications\NewReplyAdded($d));


        Session::flash('success', 'Replied to discussion.');

        return redirect()->back();
    }

    public function edit($slug)
    {
        return view('discussions.edit', ['discussion' => Discussion::where('slug', $slug)->first()]);
    }

    public function update($id)
    {
        $this->validate(request(), [
            'content' => 'required'
        ]);

        $d = Discussion::find($id);

        $d->content = request()->content;
        $d->save();

        Session::flash('success', 'Discussion updated.');

        return redirect()->route('discussion', ['slug' => $d->slug]);
    }
}
