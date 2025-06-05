<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\MemberFee;
use App\Models\Service;
use App\Models\Trainer;
use App\Events\MemberCreated;
use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Notifications\WelcomeNotification;
use App\Notifications\SendSmsNotification;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
 
class MemberController extends Controller
{
    public function __construct() {
        /* $this->middleware(['permission:member index, web'])->only('index');
        $this->middleware(['permission:member create, web'])->only(['create','store']);
        $this->middleware(['permission:member update, web'])->only(['edit','update']);
        $this->middleware(['permission:member create, web'])->only(['edit','destroy']); */

        $this->middleware('permission:member index')->only('index');
        $this->middleware('permission:member create')->only(['create','store']);
        $this->middleware('permission:member update')->only(['edit','update']);
        $this->middleware('permission:member delete')->only('destroy');
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    { 
        $members = Member::with('memberFees')->latest()->paginate(10);        
        return view('members/index', ['members' => $members]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = Service::all();
        $trainers = Trainer::where('status', 'Active')->get();

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
        try {
            $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'registration_date' => 'required|date', 
                'phone' => 'required|string|max:15',
                'address' => 'required|string|max:255',
                'services' => 'required|array'
            ]);

            $filename = null;
            if($request->hasFile('profile_photo')){
                $path = $request->file('profile_photo')->store('profile_photos', 'public');             
                //$path = $request->file('image')->storeAs('public/uploads', 'newfile.jpg');
                $filename = basename($path);
            }

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
                'service_ids' => $request->services, // Store service IDs
                'plan' => $request->plan,
                'fee' => $request->amount,
                'profile_photo' => $filename??null,
            ]);

            // Dispatch the event
            event(new MemberCreated($member));

            // Send the welcome email
            Mail::to($member->email)->queue(new WelcomeEmail($member));

            // Send welcome notification
            //$member->notify(new WelcomeNotification($member));

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
    public function show(string $id): View
    {        
        $member = Member::with(['MemberFees', 'trainer'])->findOrFail($id);
        
        $services = Service::all();
        $trainers = Trainer::all();     

        return view('members.view', compact('member', 'services', 'trainers'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
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
                'services' => 'required|array',
                //'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5148',
            ]);

            $member = Member::findOrFail($id);            
            \Log::info('profile_photo input:', ['type' => gettype($request->file('profile_photo')), 'value' => $request->file('profile_photo')]);

            $filename = $member->profile_photo;
            if ($request->hasFile('profile_photo')) {
                $uploadedFile = $request->file('profile_photo');
            
                if ($uploadedFile->isValid()) {
                    if ($member->profile_photo && Storage::disk('public')->exists('profile_photos/' . $member->profile_photo)) {
                        Storage::disk('public')->delete('profile_photos/' . $member->profile_photo);
                    }
            
                    $path = $uploadedFile->store('profile_photos', 'public');
                    $filename = basename($path);
                }
            }          
             
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
                'profile_photo' => $filename??null,
            ]);

            return redirect()->back()->with('success', 'Successs! Member updated successfully.');

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
        try {
            $member = Member::findOrFail($id);
            $member->delete();
    
            return redirect()->back()->with('success', 'Member deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete member: ' . $e->getMessage());
        }
    }

    public function search(Request $request){
        try {            
            if ($request->has('q') && $request->q !== '') {
                $members = Member::with('memberFees')->where('first_name', 'LIKE', "%{$request->q}%")
                    ->orWhere('last_name', 'LIKE', "%{$request->q}%")
                    ->orWhere('phone', 'LIKE', "%{$request->q}%")
                    ->orWhere('email', 'LIKE', "%{$request->q}%")
                    ->orWhere('status', $request->q)
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

    public function updateFee(Request $request){
        try {
            /* $request->validate([
                'member_id' => 'required|exists:members,id',
                'original_amount' => 'required|numeric',
                'discount_amount' => 'required|numeric',
                'final_amount' => 'required|numeric',
                'payment_status' => 'required|string|max:255',
            ]); */

            

            $memberFee = MemberFee::where('member_id', $request->id)->first();
            
           /*  echo "<pre>";
            var_dump($memberFee);
            die();
            
            if (!$memberFee) {
                return redirect()->back()->with('error', 'Member fee not found');
            } */

           if ($memberFee) {               
               $updated = $memberFee->update([
                   'original_amount' => $request->original_amount,
                   'discount_amount' => $request->discount_amount??0.00,
                   'final_amount' => $request->final_amount,
                   'payment_status' => $request->payment_status,
                   'payment_date' => now(),
                   'payment_method' => $request->payment_method,
                ]);                
            
                if ($updated) {
                    return redirect()->back()->with('success', 'Member fee updated');
                } else {
                    return redirect()->back()->with('error', 'Update failed');
                }
            } else {
                return redirect()->back()->with('error', 'Member fee not found');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Error throw: ' . $th->getMessage()); 
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage()); 
        } 
    }

    public function sendNotification(Request $request)
    {
        try {
            $id = $request->input('member_id');
            $member = Member::findOrFail($id);           
            
            if (!$member) {
                return redirect()->back()->with('error', 'Member fee not found');
            }
             
            \Log::info('send notification sms:', ['type' => gettype($member), 'value' => $member]);
             
            $member->notify(new SendSmsNotification("Hello {$member->fullname}! This is a gentle reminder that your membership is expired. Please contact us for renewal. Thank you!"));
            $member->notify(new WelcomeNotification($member));
            $member->increment('reminder');

            return response()->json(['status' => true, 'message' => 'Notification sent successfully']);
        } catch (\Throwable $th) {
            \Log::error('send notification sms throwable:', ['type' => gettype($th->getMessage()), 'value' => $th->getMessage()]);
            return response()->json(['status' => false, 'message' => 'Error: ' . $th->getMessage()], 500);
        } catch (\Exception $e) {
            \Log::error('send notification sms exception:', ['type' => gettype($e->getMessage()), 'value' => $e->getMessage()]); 
            return response()->json(['status' => false, 'message' => 'Something went wrong: ' . $e->getMessage()], 500);
        } 
    }

    public function test(Request $request){
        //$ipAddress = $request->ips();
       // $token = $request->bearerToken();
       //$name = $request->input('name', 'Sally'); 
       //$name = $request->query('name', 'Helen');

        /* $collection = collect(['taylor', 'abigail', null])->map(function (?string $name) {
            return strtoupper($name) . '_' . random_int(100, 999);
        })->reject(function (string $name) {
            return empty($name);
        }); */

        $collection = collect([1, 2, 3, 4, 5, 6, 7, 8, 9]);

        return view('members.test', [           
            'collection' => $collection,
        ]);

        //return $collection->all();
        
    }
}
