<?php

namespace App\Http\Controllers;

use App\Http\Resources\TicketResource;
use App\Http\Requests\TicketStoreRequest;
use App\Models\Ticket;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        try {

          $query = Ticket::query();
          $query->orderBy('created_at', 'desc');

          if($request->search){
            $query->where('code', 'like', '%' . $request->search . '%')
                  ->orWhere('title', 'like', '%' . $request->search . '%');
          }

          if($request->status){
            $query->where('status', $request->status);
          }

          if($request->priority){
            $query->where('priority', $request->priority);
          }

          if(Auth::user()->role !== 'user'){
            $query->where('user_id', Auth::user()->id);
          }

          $tickets = $query->get();

          return response()->json([
            'message' => 'list ticket',
            'role' => Auth::user()->role,
            'data' => TicketResource::collection($tickets),
          ]);

        }catch(\Exception $e){
            return response()->json([
                'message' => 'terjadi kesalahan',
                'error' => $e->getMessage()
            ]);
        }
    }

    public function create()
    {
        //
    }

    public function store(TicketStoreRequest $request)
    {
        $data = $request->validated();
        DB::beginTransaction();

        try {
            $ticket = new Ticket();
            $ticket->user_id = Auth::user()->id;
            $ticket->code = 'TIC-'.rand(10000, 90000);
            $ticket->title = $data['title'];
            $ticket->description = $data['description'];
            $ticket->priority = $data['priority'];
            $ticket->save();

            DB::commit();
            return response()->json([
                'message' => 'Ticket created succesfully.',
                'data' => new TicketResource($ticket)
            ]);
        }
        catch(\Exception $e){

            DB::rollBack();

            return response()->json([
                'message' => 'terjadi kesalahan',
                'error' => $e->getMessage(),
                'data' => null,
            ]);
        }
    }

    public function show(string $code)
    {
        try {
          $ticket = Ticket::where('code', $code)->first();

          if(!$ticket){
            return response()->json([
              'message' => 'ticket not found.'
            ], 404);
          }

          if(Auth::user()->role === 'user' && $ticket->user_id != Auth::user()->id){
            return response()->json([
              'message' => 'you are not alowed to access this ticket!',
            ], 403);
          }

          return response()->json([
            'message' => 'your ticket information.',
            'data' => new TicketResource($ticket),
          ], 201);

        }catch(\Exception $e){
          return response()->json([
            'message' => 'Terjadi kesalahan.',
            'error' => $e->getMessage(),
          ]);
        }
    }

    public function edit(string $id)
    {

    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
