<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Mail\NewContact;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class LeadController extends Controller
{
    public function store(Request $request){

        $data = $request->all();

        $validator = Validator::make($data, [
            "firstname" => ['required', 'max:150',],
            "surname" => ['required', 'max:150',],
            "email" => ['required', 'email'],
            "content" => ['required'],
        ]);

        if($validator->fails()){
            return response()->json([
                "success" => false,
                "errors" => $validator->errors(),
            ]);
        }else{
            $lead = new Lead();
            $lead->fill($data);
            $lead->save();
            Mail::to('test@test.com')->send(new NewContact($lead));
            return response()->json([
                "success" => true,
            ]);
        }
    }
}
