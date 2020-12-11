<?php

namespace App\Http\Controllers;

use JeroenDesloovere\VCard\VCard;
use Illuminate\Http\Request;
use App\ContactUs;
use App\User;
use App\ShareList;
use Auth;
use File;
use ZipArchive;

class ContactUsController extends Controller
{
    public function index()
    {  
        $userId = Auth::user()->id;
        $users = User::where('id', '!=', $userId)->pluck('name', 'id');
        
        $contacts = ContactUs::select('firstName','middleName','lastName', 'primaryPhone', 'emailId', 'id')->where('userId', $userId)->whereActive(1)->get();
        return view('contacts.list')->with(['contacts'=>$contacts,'users'=>$users]);
    }

    public function dlist()
    {
        $userId = Auth::user()->id;
        $users = User::where('id', '!=', $userId)->pluck('name', 'id');
       
        $contacts = ContactUs::where('userId', $userId)->whereActive(0)->paginate(10);
        return view('contacts.dlist')->with(['contacts'=>$contacts, 'users'=>$users]);
    }

    public function create()
    {
        $username = Auth::user()->email;        
        return view('contacts.create')->with(['username'=>$username]);
    }

    public function store(Request $request)
    {
        $userId = Auth::user()->id;
        $contact = new ContactUs;
        $contact->userId  = $userId;
        $contact->firstName  = $request->firstName;
        $contact->middleName  = $request->middleName;
        $contact->lastName  = $request->lastName;
        $contact->primaryPhone  = $request->primaryPhone;
        $contact->secondaryPhone  = $request->secondaryPhone;
        $contact->emailId  = $request->emailId;
        if(!empty($request->image))
        {
            $file = $request->image;
 
            $docName = str_replace(' ', '-', $request->input('firstName'));
            $originalImage= $request->file('image');
            $Image = $docName.'_'.date('dhis').'.'.$originalImage->getClientOriginalExtension();
            $file->move(base_path('public/images'), $Image);
            $contact->image = $Image; 
        }     
        
        $contact->updatedBy  = Auth::user()->email;  
        $contact->save();

        return redirect('/contacts')->with('success', 'New Contact added successfully!!!');
    }

    public function show($id)
    {
        $username = Auth::user()->email;  
        $userId = Auth::user()->id;  
        $contact = ContactUs::find($id);     
        return view('contacts.show')->with(['username'=>$username, 'contact'=>$contact, 'userId'=>$userId]);
    }
    
    public function shareList()
    {
        $userId = Auth::user()->id; 
        $contacts= ShareList::join('users', 'share_lists.shareUserId', 'users.id')
        ->join('contact_us', 'share_lists.contactId', 'contact_us.id')
        ->select('contact_us.*')
        ->where('share_lists.shareUserId', $userId)
        ->where('share_lists.active', 1)
        ->get();
        return view('contacts.shareList')->with(['contacts'=>$contacts]); 
    }

    public function showShareContact($id)
    {
        $userId = Auth::user()->id; 
        $contact= ShareList::join('users', 'share_lists.shareUserId', 'users.id')
        ->join('contact_us', 'share_lists.contactId', 'contact_us.id')
        ->select('contact_us.*', 'share_lists.updatedBy as sharedBy')
        ->where('contact_us.id', $id)
        ->where('share_lists.active', 1)
        ->first();
        return view('contacts.showSharedList')->with(['contact'=>$contact, 'userId'=>$userId]);
    }

    public function edit($id)
    {
        $username = Auth::user()->email;  
        $contact = ContactUs::find($id);     
        return view('contacts.edit')->with(['username'=>$username, 'contact'=>$contact]);
    }

    public function update(Request $request, $id)
    {
        $contact = ContactUs::find($id);
        $contact->firstName  = $request->firstName;
        $contact->middleName  = $request->middleName;
        $contact->lastName  = $request->lastName;
        $contact->primaryPhone  = $request->primaryPhone;
        $contact->secondaryPhone  = $request->secondaryPhone;
        $contact->emailId  = $request->emailId;
        if(!empty($request->image))
        {
            $file_path = base_path('public/images'.$contact->image);
            if(File::exists($file_path))
            {
                unlink($file_path);
            }          

            $file = $request->image; 
            $docName = str_replace(' ', '-', $request->input('firstName'));
            $originalImage= $request->file('image');
            $Image = $docName.'_'.date('dhis').'.'.$originalImage->getClientOriginalExtension();
            $file->move(base_path('public/images'), $Image);
            $contact->image = $Image; 
        }     

        $contact->updatedBy  = Auth::user()->email;  
        $contact->save();

        return redirect('/contacts')->with('success', 'Contact Updated successfully!!!');
    }

    public function deactivate($id)
    {
        $username = Auth::user()->email; 
        ContactUs::where('id', $id)->update(['active'=>0, 'updatedBy'=>$username]);
        ShareList::where('contactId', $id)->update(['active'=>0, 'updatedBy'=>$username]);
        return redirect('/contacts/dlist')->with('success', 'Contact Deactivated successfully!!!');
    }

    public function activate($id)
    {
        $username = Auth::user()->email; 
        ContactUs::where('id', $id)->update(['active'=>1, 'updatedBy'=>$username]);
        ShareList::where('contactId', $id)->update(['active'=>1, 'updatedBy'=>$username]);
        return redirect('/contacts')->with('success', 'Contact Activated successfully!!!');
    }

    public function userShare(Request $request)
    {
        // share to other user
        $curUserId = Auth::user()->id; 
        $username = Auth::user()->email; 

        $contacts = $request->select;
        if(empty($contacts))
            return redirect()->back()->withInput()->with("error","Select At least 1 contact for Share");

        $userId = $request->userId;
        $counts = count($contacts);
        for($i=0; $i<$counts; $i++)
        {
            $share = ShareList::where('userId', $curUserId)
            ->where('shareUserId', $userId)
            ->where('contactId', $contacts[$i])
            ->first();
            if(empty($share))
            {
                $newShare = new ShareList;
                $newShare->userId = $curUserId;
                $newShare->shareUserId = $userId;
                $newShare->contactId = $contacts[$i];
                $newShare->updatedBy = $username;
                $newShare->save();
            }
        }    

        return redirect('/contacts')->with('success', 'Contacts Shared successfully!!!');
    }

    public function downloadVCF($id)
    {    
        $contact = ContactUs::find($id);           
        if(!empty($contact))
        {
            $vcard = new VCard();
            $vcard->addName($contact->lastName, $contact->firstName, $contact->middleName);
            $vcard->addEmail($contact->emailId);
            $vcard->addPhoneNumber($contact->primaryPhone, 'PREF;WORK');
            $vcard->addPhoneNumber($contact->secondaryPhone, 'WORK');
            return $vcard->download($contact->lastName);
        }
        return redirect('/contacts')->with('success', 'There is some issue.');
    }
}
