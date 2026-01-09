<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketReplyRequest;
use App\Http\Resources\TicketReplyResource;
use App\Models\Ticket;
use App\Models\TicketReply;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use function Symfony\Component\Clock\now;

class TicketReplyController extends Controller
{
  public function index()
  {
    $onproccess = Ticket::where('status', 'onprogress')->count();
    return response()->json([
      'message' => 'There is '.$onproccess.' ticket waiting for reply.',
      'data' => Ticket::all(),
    ]);
  }

  public function store(TicketReplyRequest $request, $code)
  {
    $data = $request->validated();
    DB::beginTransaction();

    try {
      $ticket = Ticket::where('code', $code)->first();
      if(!$ticket){
        return response([
          'message' => 'Ticket not found',

        ], 404);
      }
      if(Auth::user()->role === 'user' && $ticket->user_id !== Auth::user()->id){
        return response()->json([
          'message' => 'You are not allowed to access this ticket information.'
        ], 403);
      }

      $ticketReply = new TicketReply();
      $ticketReply->ticket_id = $ticket->id;
      $ticketReply->user_id = Auth::user()->id;
      $ticketReply->content = $data['content'];
      $ticketReply->save();

      if(Auth::user()->id){
        $ticket->status = $data['status'];
        if($data['status'] == 'resolved'){
          $ticket->completed_at = now();
        }
        $ticket->save();
      }

      DB::commit();
      return response()->json([
        'message' => 'Reply added successfuly.',
        'data' => new TicketReplyResource($ticketReply),
      ]);

    }catch(\Exception $e){
      DB::rollBack();

      return response()->json([
        'message' => 'Somethings wrong is happend.',
        'error' => $e->getMessage(),
      ]);
    }
  }
}
