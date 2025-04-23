<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\MemberFee;
use App\Models\Service;
use App\Models\Trainer;
use App\Events\MemberCreated;
use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Mail;
use App\Notifications\WelcomeNotification;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    { 
        $members = Member::with('memberFees')->latest()->paginate(10);

        //return $members;
        
        return view('members/index', ['members' => $members]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = Service::all();
        $trainers = Trainer::all();

        return view('members.create', [
            'services' => $services,
            'trainers' => $trainers,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {       
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'registration_date' => 'required|date', 
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'services' => 'required|array'
        ]); 
        
        //return $request;

        try {
            $member = Member::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email??null,
                'phone' => $request->phone,
                'emergency_contact_number' => $request->emergency_contact_number??null,
                'gender' => $request->gender,
                'date_of_birth' => $request->date_of_birth, 
                'address' => $request->address,
                'registration_date' => $request->registration_date, 
                'status' => $request->status,
                'medical_conditions' => $request->medical_conditions??'', 
                'need_trainer' => $request->need_trainer??0, 
                'trainer_id' => $request->trainer_id??null, 
                'service_ids' => json_encode($request->services), // Store service IDs
                'plan' => $request->plan,
                'fee' => $request->amount,
                'profile_photo' => $request->profile_photo??null,
            ]);

            // Dispatch the event
            event(new MemberCreated($member));

            // Send the welcome email
            //Mail::to($member->email)->queue(new WelcomeEmail($member));

            // Send welcome notification
            $member->notify(new WelcomeNotification($member));

            return redirect()->back()->with('success', 'Member added successfully');

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Error throw: ' . $th->getMessage()); 
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage()); 
        }        
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
        $member = Member::with('MemberFees')->findOrFail($id);       
        
        $services = Service::all();
        $trainers = Trainer::all();

        return view('members.edit', [
            'member' => $member,
            'services' => $services,
            'trainers' => $trainers,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'registration_date' => 'required|date', 
                'phone' => 'required|string|max:15',
                'address' => 'required|string|max:255',
                'services' => 'required|array'
            ]);

            $member = Member::findOrFail($id);            
             
            $member->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email??null,
                'phone' => $request->phone,
                'emergency_contact_number' => $request->emergency_contact_number??null,
                'gender' => $request->gender,
                'date_of_birth' => $request->date_of_birth, 
                'address' => $request->address,
                'registration_date' => $request->registration_date, 
                'status' => $request->status,
                'medical_conditions' => $request->medical_conditions??'', 
                'need_trainer' => $request->need_trainer??0, 
                'trainer_id' => $request->trainer_id??null, 
                'service_ids' => $request->services, // Store service IDs
                'plan' => $request->plan,
                'fee' => $request->amount,
                'profile_photo' => $request->profile_photo??null,
            ]);

            return redirect()->back()->with('success', 'Member updated successfully');

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Error throw: ' . $th->getMessage()); 
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage()); 
        } 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function search(Request $request){
        try {
            if ($request->has('q') && $request->q !== '') {
                $members = Member::with('memberFees')->where('first_name', 'LIKE', "%{$request->q}%")
                    ->orWhere('last_name', 'LIKE', "%{$request->q}%")
                    ->orWhere('phone', 'LIKE', "%{$request->q}%")
                    ->orWhere('email', 'LIKE', "%{$request->q}%")
                    ->latest()
                    ->paginate(10); 
            } else {
                $members = Member::with('memberFees')->latest()->paginate(10);
            }       
    
            // Return partial view for AJAX
            if ($request->ajax()) {
                return view('members.partials.table', ['members' => $members, 'search' => $request->q])->render();
            }
    
            // Return full view for non-AJAX
            return view('members.index', ['members' => $members, 'search' => $request->q]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Error throw: ' . $th->getMessage()); 
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage()); 
        } 
    }
}
