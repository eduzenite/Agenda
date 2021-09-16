<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $contacts = Contact::where('user_id', $request->id)->where(function (Builder $query) use ($request) {
            if(!empty($request->q)){
                $query->orWhere('name', 'like', '%'.$request->q.'%');
                $query->orWhere('email', 'like', '%'.$request->q.'%');
                $query->orWhere('phone', 'like', '%'.$request->q.'%');
            }
            return $query;
        })->paginate(12);
        return response()->json(array('contacts' => $contacts));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $contact = new Contact();
        $contact->user_id = $request->user_id;;
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->save();
        return response()->json(['contact' => $contact, 'message' => "Contato criado com sucesso!", 'status' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $contact = Contact::find($id);
        return response()->json(array('contact' => $contact));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $contact = Contact::find($request->id);
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->save();
        return response()->json(['contact' => $contact, 'message' => "Contato atualizado com sucesso!", 'status' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $contact = Contact::find($id);
        $contact->delete();
        return response()->json(['message' => "Contato deletado com sucesso!", 'status' => 'success']);
    }
}
