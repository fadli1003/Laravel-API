<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketStoreRequest;
use App\Http\Resources\TicketResource;
use App\Models\Ticket;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function index()
    {
        return response()->json([
            'message' => 'ini pesan dari backend',
        ]);
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
        catch(Exception $e){

            DB::rollBack();

            return response()->json([
                'message' => 'terjadi kesalahan',
                'error' => $e->getMessage(),
                'data' => null,
            ]);
        }
    }

    public function show($code)
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
}
