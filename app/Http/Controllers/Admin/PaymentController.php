<?php

namespace App\Http\Controllers\Admin;
use App\Models\Payment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PaymentRequest;
class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $payments=Payment::OrderBy('id','desc')->paginate(3);
        return view('admin.payments.index',compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         
         return view('admin.payments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PaymentRequest $request)
    {
         $payments=Payment::create($request->all());
        $file_name=time().'.'.$request->logo->extension();
        $upload=$request->logo->move(public_path('images/payments/'),$file_name);
        if($upload)
            {
                $payments->logo="images/payments/".$file_name;
            }
        $payments->save();
        return redirect()->route('backend.payments.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $payment=Payment::find($id);
        return view('admin.payments.edit',compact('payment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $payment=Payment::findOrFail($id);
        $request->validate([
            'name'=>'required',
            'logo'=>'nullable | logo|mimes:jpg,jpeg,png,webp|max:2048',
        ]);
        
        $payment->name=$request->name;
    
        if($request->hasFile('logo'))
            {
                if(!empty($request->old_logo)&& file_exists(public_path($request->old_logo)))
                    {
                        unlink(public_path($request->old_logo));

                    }
                    $file_name=time().'.'.$request->logo->extension();
                    $request->logo->move(public_path('images/payments'),$file_name);
                    $payment->logo="images/payments/".$file_name;
            }
            $payment->save();
            return redirect()->route('backend.payments.index')->with('success','Payment update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $payment=Payment::find($id);
        $payment->delete();
        return redirect()->route('backend.payments.index');
    }
}
