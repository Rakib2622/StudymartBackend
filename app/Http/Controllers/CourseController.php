<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
class CourseController extends Controller
{
    public function getAllCourse() {
      $course = Course::get()->toJson(JSON_PRETTY_PRINT);
      return response($course, 200);

  }


public function getCourse($id) {
      if (Course::where('id', $id)->exists()) {
        $course = Course::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
        return response($course, 200);
      } else {
        return response()->json([
          "message" => "not found"
        ], 404);
      }
    }

     public function createCourse(Request $request)
   {
    $course = new Course();
    $course->name = $request->input('name');



   $course->save();
   return response()->json([
        "message" => "record created"
      ], 201);
    }



public function updateCourse(Request $request, $id) {
      if (Course::where('id', $id)->exists()) {
        $course= Course::find($id);

        $course->name = is_null($request->name) ? $course->name : $request->name;


        $course->save();

        return response()->json([
          "message" => "records updated successfully"
        ], 200);
      } else {
        return response()->json([
          "message" => "not found"
        ], 404);
      }
    }


   public function deleteCourse ($id) {
      if(Course::where('id', $id)->exists()) {
        $course = Course::find($id);
        $course->delete();

        return response()->json([
          "message" => "records deleted"
        ], 202);
      } else {
        return response()->json([
          "message" => "not found"
        ], 404);
      }
    }
}
