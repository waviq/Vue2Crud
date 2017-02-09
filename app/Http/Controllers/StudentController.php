<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class StudentController extends Controller
{
    public function index(){
        return view('student.index');
    }

    public function getData(Request $request){
        $query = $request->search_input;
        $students = Student::where('name','LIKE',"%{$query}%")->paginate(20);
        $column = Student::$columns;
        return response()->json([
            'model'     =>  $students,
            'columns'    => $column
        ]);
    }

    public function delete($id){
        $students = Student::findOrFail($id);
        $students->delete();
        return response()->json(['succes delete']);
    }

    public function simpan(Request $request){

        $this->validate($request,[
            'name'      => 'required',
            'nim'       => 'required',
            'address'   =>  'required'
        ]);

        $create = Student::create($request->all());
        return response()->json($create);
    }

    public function postSearch(Request $request){

        /*$query = $request->search_input;
        //dd($query);
        $column = Student::$columns;
        $students = Student::where('name','LIKE',"%{$query}%")->paginate(10);
        //dd($students);

        return response()->json([
           'model'      => $students,
            'columns'   =>  $column
        ]);*/

    }
}
