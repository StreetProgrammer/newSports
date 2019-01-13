<?php

namespace App\Http\Controllers\Player;

use App\Http\Controllers\Controller ;
use Illuminate\Http\Request;
use App\Model\User;
use Illuminate\Support\Facades\Auth;
class FriendshipController extends Controller
{
    public function addFriend($id) 
	{
       $recipient = User::find($id);
        Auth::user()->befriend($recipient);
        return back();
    }
    public function unFriend($id) 
	{
        $friend = User::find($id);
        Auth::user()->unfriend($friend);
        return back();
    }
    public function rejectFriend($id) 
	{
        $sender = User::find($id);
        Auth::user()->denyFriendRequest($sender);
        return back();
    }
    public function blockFriend($friend) 
	{
        Auth::user()->blockFriend($friend);
    }
    public function unblockFriend($friend) 
	{
        Auth::user()->unblockFriend($friend);
    }
    public function acceptRequests($id) 
	{
        $sender = User::find($id);
        Auth::user()->acceptFriendRequest($sender);
        return back();
    }
    public function PendingFriendships() 
	{
        Auth::user()->getPendingFriendships();
    }
    public function FriendRequests() 
	{        
        Auth::user()->getFriendRequests();
    }
    public function BlockedFriendships($recipient) 
	{
        Auth::user()->getBlockedFriendships();
    }
    public function MutualFriendsCount($anotherUser) 
	{
        Auth::user()->getMutualFriendsCount($anotherUser);
    }
    
}

