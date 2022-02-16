<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Models\Task;
use App\Models\Taskpriority;
use Auth;
use Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use DB; 


class UserController extends Controller
{
    
    public function index(Request $request)
    {

        try{
            $taskPriorityDataByCategory = DB::select( DB::raw("SELECT `tp_category` FROM `task_priority` GROUP BY `tp_category` ORDER BY `tp_category` ASC "));


            return view('index', compact('taskPriorityDataByCategory'));
        }
        catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }  
    }

    public function getCategoryTaskList(Request $request)
    {
        $getCategoryName = $request->get('categoryName');

        $getByCategoriesName = DB::select( DB::raw("SELECT tp_name FROM `task_priority` WHERE tp_category='$getCategoryName' ORDER BY `tp_category` ASC "));
            
        return response()->json($getByCategoriesName, 200);
    }


    public function register()
    {

        try{
            return view('register');
        }
        catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
         
    }

    public function postRegister(Request $request)
    {  

        $rules = [
			'name' => 'required|string|min:3|max:255',
			'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:3'
		];

		$validator = Validator::make($request->all(),$rules);

		if ($validator->fails()) {
			return redirect('register')->withInput()->withErrors($validator);
		}
		else{
            $data = $request->input();
			try{
				$newUser = new User;
                $newUser->name = $data['name'];
				$newUser->email = $data['email'];
				$newUser->password = Hash::make($data['password']);
				$newUser->save();
				return redirect('register')->with('status',"Insert successfully");
			}
			catch(Exception $e){
                return redirect()->back()->withErrors($e->getMessage());
			}
		}
    }

    public function login()
    {

        try{
            return view('login');
        }
        catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
         
    }

    public function postLogin(Request $request)
    {
        $rules = [
			'email' => 'required|string|email',
            'password' => 'required|string',
		];

		$validator = Validator::make($request->all(),$rules);

		if ($validator->fails()) {
			return redirect('login')->withInput()->withErrors($validator);
		}

        else{

            if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) 
            {

                try{
                    if(Auth::user()->status == 'active')
                    {
                        return redirect()->intended('/admin/index');
                    }
                    else{
                        return redirect('login')->with('failed', 'Oppes! You account is not activated');
                    }
                }
                catch(Exception $e){
                    return redirect()->back()->withErrors($e->getMessage());
                }
               
            }

            return redirect('login')->with('failed', 'Oppes! You have entered invalid credentials');
			
		}

    }

    public function logout(Request $request) {
        try{

            $request->session()->flush();

            $request->session()->regenerate();
            Auth::logout();
            return Redirect('index');
        }
        catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
        
    }

     //admin panel 
    
     public function adminIndex()
     {
         try{
             return view('backend.index');
         }
         catch(Exception $e){
             return redirect()->back()->withErrors($e->getMessage());
         }
     
     }

    public function adminAddTask(Request $request)
    {
        try{
            return view('backend.add-task');
        }
        catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
        
    }

    public function adminAddTaskPost(Request $request)
    {

        $rules = [
			'name' => 'required|string|min:3|max:255',
			'description' => 'required|string',
		];

		$validator = Validator::make($request->all(),$rules);

		if ($validator->fails()) {
			return redirect('/admin/add-task')->withInput()->withErrors($validator);
		}
		else{
            $data = $request->input();
			try{
               
				$newTask = new Task;
                $newTask->taskname = $data['name'];
				$newTask->taskdescription = $data['description'];
				$newTask->save();
				return redirect('/admin/add-task')->with('status',"Insert successfully");
			}
			catch(Exception $e){
				return redirect()->back()->withErrors($e->getMessage());
			}
		}

    }

    public function adminTaskDetails()
    {
        try{
            $taskData = Task::get();

            return view('backend.task-details', compact('taskData'));

        }
        catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
        
    }

    public function taskEdit($id)
    {
        try{
            $task = Task::FindOrFail($id);

            return view('backend.edit-task',compact('task'));
        }
        catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
        
    }

    public function taskUpdate(Request $request,$id)
    {

        $rules = [
			'name' => 'required|string|min:3|max:255',
			'description' => 'required|string',
		];

		$validator = Validator::make($request->all(),$rules);

		if ($validator->fails()) {
			return back()->withInput()->withErrors($validator);
		}
		else{
            $data = $request->input();
			try{

                $updateTask = Task::find($id);
                $updateTask->taskname = $data['name'];
				$updateTask->taskdescription = $data['description'];
				$updateTask->save();
				return redirect('/admin/task-details')->with('status',"Update successfully");
			}
			catch(Exception $e){
				return redirect()->back()->withErrors($e->getMessage());
			}
		}

    }

    // admin and user profile

    public function profileAdmin()
    {
        try{
            return view('backend.profile-admin');
        }
        catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
        
    }

    //user details

    public function userDetails()
    {
        try{
            $userData = User::get();

            return view('backend.user-details', compact('userData'));
        }   
        catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
        
    }

    //changes status from active to inactive and vice versa

    public function changeStatusOfUser()
    {
        try{
            $id = $_POST['id'];

            $status = $_POST['status'];

            $updateStatus = User::where("id", $id)->update(["status" => $status]);
        }
        catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
        
    }

    
    // manage task menu

    public function manageTaskMenu()
    {
        try{
            $taskData = Task::get();

            return view('backend.manage-task-menu', compact('taskData'));

        }
        catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
        
    }

    

    public function saveTaskMenu()
    {
        $varId = $_POST['id'];

        $varInputCategoryName = $_POST['inputCategoryName'];

        $varCountSpanTag = $_POST['countSpanTag'];

       //get all the data that have same category name

       $taskPriorityDataByCategory = DB::select( DB::raw("SELECT * FROM task_priority WHERE tp_category='$varInputCategoryName' "));

       //count numbers of row that have same category name

       $countData = count($taskPriorityDataByCategory);

        try{

            if(!empty($varCountSpanTag))
            {
                $getTaskData = DB::table('task')->where('id', $varId)->first();

                $saveToTaskPriority = new Taskpriority;

                $saveToTaskPriority->tp_name = $getTaskData->taskname;

                $saveToTaskPriority->tp_desc = $getTaskData->taskdescription;

                $saveToTaskPriority->tp_category = $varInputCategoryName;

                $saveToTaskPriority->save();

            
                $taskDataDelete = DB::delete(DB::raw("DELETE FROM `task_priority`
                                                        WHERE id NOT IN (
                                                        SELECT id
                                                        FROM (
                                                            SELECT id
                                                            FROM `task_priority`
                                                            ORDER BY id DESC
                                                            LIMIT $varCountSpanTag
                                                        ) tp
                                                        ) AND `tp_category`='$varInputCategoryName' "));
                
                return redirect('/admin/manage-task-menu')->with('status',"Save successfully");

            }
            else{
                return redirect('/admin/manage-task-menu')->with('failed',"Failed to Save");
            }

            
            
        }
        catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }

    }

    //delete task

    public function taskDelete($taskId)
    {
        $deleteTaskById = Task::find($taskId);  

        $deleteTaskById->delete();  

        return redirect('/admin/task-details')->with('status',"Delete successfully");
    }



}
